/**
 * @file admin_profile.conf.ts
 * @description A module to manage admin profile form validation, warnings, and snackbar notifications.
 * @license LGPL2-1
 */

'use strict';

interface FieldMapping {
    [key: string]: string;
    getKeyByValue: (fieldId: string) => string | null;
}

interface ChangesWatcher {
    [key: string]: string;
}

interface SnackbarData {
    msg: string;
    state: 'info' | 'success' | 'error';
    ttl?: number;
    origin?: string;
}

/**
 * Watches for changes in the profile form and triggers appropriate warnings and updates.
 */
let changesWatcher: ChangesWatcher = {};

const profileFormContainer: string = '#change-admin-data';
const watchWarning: string = '#watcher-warning';

/**
 * Maps HTML fields to matching JSON
 */
const fieldMapping: FieldMapping = {
    'admin-first-name': 'firstName',
    'admin-last-name': 'lastName',
    'admin-username': 'name',
    'admin-email': 'email_addr',
    'admin-new-password': 'password_hash',
    'admin-address': 'physical_addr.street',
    'admin-city-code': 'physical_addr.code',
    'admin-city': 'physical_addr.city',

    getKeyByValue: function(fieldId: string): string | null {
        return Object.keys(this).find(key => this[key] === fieldId) || null;
    }
};

/**
 * Finds and returns the label element associated with the specified input field ID.
 * 
 * @param {string} ref - The ID of the input field to find the matching label for.
 * @returns {HTMLElement|null} The matching label element if found, null otherwise.
 */
const getMatchingLabel = (ref: string): HTMLLabelElement | null => {
    const labels: HTMLCollectionOf<HTMLLabelElement> = document.getElementsByTagName('label');

    for (let i = 0; i < labels.length; i++) {
        if (labels[i].htmlFor === ref) return labels[i];
    }
    return null;
}

/**
 * Creates and appends a warning icon element to the specified input field.
 * 
 * @param {string} fieldId - The input id to find the matching label, in order to add the warning icon.
 * @returns {void}
 */
const createWarningElement = (fieldId: string): void => {
    const iconId: string = 'warn-icon-' + fieldId;

    if (document.getElementById(iconId)) return;

    const matchingLabel: HTMLLabelElement | null = getMatchingLabel(fieldId);
    if (!matchingLabel) return;

    const warnNode: HTMLElement = document.createElement('i');
    warnNode.classList.add('fa-solid', 'fa-triangle-exclamation', 'text-yellow-600', 'ml-4');
    warnNode.id = iconId;
    matchingLabel.appendChild(warnNode);
}

const updateAdminProfilePicture = (e: Event): void => {
    // Implementation to be added
}

/**
 * Handles "Enter" key press for saving profile data.
 * @param {KeyboardEvent} event - The keyboard event triggered by pressing a key.
 */
const handleEnterKeySave = (event: KeyboardEvent): void => {
    event.preventDefault();

    if (event.key === 'Enter') {
        const selectedInput: HTMLInputElement = event.target as HTMLInputElement;

        if (selectedInput.name !== 'password' || (selectedInput.name === 'password' && checkPasswordInputs(selectedInput))) {
            const inputId: string = (selectedInput.name === 'password') ? 'admin-password' : selectedInput.id;
            const inputValue: string = (selectedInput.name === 'password') ? 
                (document.getElementById('admin-new-password') as HTMLInputElement).value : 
                selectedInput.value;

            const changes: ChangesWatcher = (event.ctrlKey) ? changesWatcher : {[fieldMapping[inputId]]: inputValue};

            pushProfileUpdate(changes);
        } else {
            console.warn('Something went wrong while updating your data.');
        }
    }
};

const checkPasswordInputs = (targetedPasswordInput: HTMLInputElement): boolean => {
    const password2: HTMLInputElement = (targetedPasswordInput.id === 'admin-confirm-password') ? 
        document.getElementById('admin-new-password') as HTMLInputElement : 
        document.getElementById('admin-confirm-password') as HTMLInputElement;
    
    const passwordIssue: HTMLElement = document.getElementById('profile-password-issue') as HTMLElement;

    if (password2.value.length === 0 && targetedPasswordInput.value.length === 0) {
        console.error('Your password can\'t be empty. Cannot save your data.');
        passwordIssue.textContent = 'Your password can\'t be empty.';
        passwordIssue.style.display = 'block';
        return false;
    }
    else if (password2.value === targetedPasswordInput.value) {
        passwordIssue.style.display = 'none';
        return true;
    }
    else {
        console.error('Passwords don\'t match. Cannot save your data.');
        passwordIssue.textContent = 'Passwords don\'t match.';
        passwordIssue.style.display = 'block';
        return false;
    }
}

const saveAllProfileChanges = (): void => {
    console.info("Saving all changes...");
    pushProfileUpdate(changesWatcher);
}

const discardChangesIndicators = (element: string): void => {
    console.info('Removing changes indicators...');

    const warningIcon: HTMLElement | null = document.getElementById('warn-icon-' + fieldMapping.getKeyByValue(element));
    if (warningIcon) warningIcon.remove();

    delete changesWatcher[element];

    if (Object.keys(changesWatcher).length === 0) {
        toggleChangesWarning(false);
        toggleProfileWarningIcon(false);
    }
}

const discardProfileChanges = (): void => {
    console.info("Discarding profile changes...");
    const form: HTMLFormElement = document.querySelector(profileFormContainer) as HTMLFormElement;
    const inputs: HTMLCollectionOf<HTMLInputElement> = form.getElementsByTagName('input');
    
    const passwordIssue: HTMLElement = document.getElementById('profile-password-issue') as HTMLElement;
    passwordIssue.style.display = 'none';

    for (let i = 0; i < inputs.length; i++) {
        if (changesWatcher[fieldMapping[inputs[i].id]]) {
            console.info(inputs[i].value, inputs[i].dataset.value);
            inputs[i].value = inputs[i].dataset.value ?? '';
            discardChangesIndicators(fieldMapping[inputs[i].id]);
        }
    }
    console.info("Successfully discarded profile changes.");
}

/**
 * Listens for input changes and triggers warnings.
 * @param {InputEvent} event - The input event triggered by any change in the form.
 */
const handleInputChange = (event: Event): void => {
    const target: HTMLInputElement = event.target as HTMLInputElement;
    const fieldId: string = (target.id === 'admin-new-password' || target.id === 'admin-confirm-password') ? 
        'admin-new-password' : 
        target.id;

    if (fieldMapping[fieldId]) {
        changesWatcher[fieldMapping[fieldId]] = target.value;
        toggleChangesWarning(true);
        toggleProfileWarningIcon(true);
        createWarningElement(fieldId);
    }
};

/**
 * Updates the profile with new data.
 * @param {ChangesWatcher} data - The data to update.
 */
const pushProfileUpdate = async (data: ChangesWatcher): Promise<void> => {
    const snackbarData: SnackbarData = manageSnackbar({
        msg: 'Your data is being processed. Please wait...',
        state: 'info'
    }, 'init');

    const requestBody = getAsyncData('push-profile-update', false, 'push');
    requestBody['fields'] = data;
    requestBody['update-admin'] = true;

    console.info(data);

    try {
        await pushRequests(requestBody, false);
        for (const i in requestBody['fields']) {
            discardChangesIndicators(i);
        }

        manageSnackbar({
            msg: 'Data successfully updated.',
            state: 'success',
            ttl: 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg: 'Cannot update your data. Please contact the administrator.',
            state: 'error',
            ttl: 5000,
            origin: snackbarData.id
        }, 'alter');
    }
};

/**
 * Toggles the warning message visibility based on whether the user is making changes.
 * @param {boolean} keepAlive - Whether to keep the warning message displayed.
 */
const toggleChangesWarning = (keepAlive: boolean): void => {
    const warningMessageContainer: HTMLElement | null = document.querySelector('#warning-profile-message');
    if (warningMessageContainer) {
        toggleElementDisplay(warningMessageContainer, 'flex', keepAlive);
    }
};

/**
 * Toggles the profile warning icon visibility.
 * @param {boolean} keepAlive - Whether to keep the icon displayed.
 */
const toggleProfileWarningIcon = (keepAlive: boolean): void => {
    const warningIcon: HTMLElement | null = document.querySelector('#warning-profile-icon');
    if (warningIcon) {
        toggleElementDisplay(warningIcon, 'inline', keepAlive);
    }
};

/**
 * Toggle password visibility with its icon
 * @param {string} inputId - Password input's id
 * @param {HTMLElement} icon - Icon element
 */
const togglePasswordVisibility = (inputId: string, icon: HTMLElement): void => {
    const input: HTMLInputElement = document.getElementById(inputId) as HTMLInputElement;
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Event listeners for the profile form
document.querySelector(profileFormContainer)?.addEventListener('keyup', handleEnterKeySave);
document.querySelector(profileFormContainer)?.addEventListener('input', handleInputChange);
document.querySelector(profileFormContainer)?.addEventListener('submit', (e: Event) => e.preventDefault()); 