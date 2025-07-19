/**
 * @file admin_profile.conf.js
 * @description A module to manage admin profile form validation, warnings, and snackbar notifications.
 * @license LGPL2-1
 */

'use strict';

/**
 * Watches for changes in the profile form and triggers appropriate warnings and updates.
 */
let changesWatcher = {};

const profileFormContainer = '#change-admin-data';
const watchWarning = '#watcher-warning';

/**
 * Maps HTML fields to matching JSON
 */
const fieldMapping = {
    'admin-first-name': 'firstName',
    'admin-last-name': 'lastName',
    'admin-username': 'name',
    'admin-email': 'email_addr',
    'admin-new-password': 'password_hash',
    'admin-address': 'physical_addr.street',
    'admin-city-code': 'physical_addr.code',
    'admin-city': 'physical_addr.city',

    getKeyByValue: function(fieldId)
    {
        return Object.keys(this).find(key => this[key] === fieldId) || null;
    }
};

/**
 * Finds and returns the label element associated with the specified input field ID.
 * 
 * @param {string} ref - The ID of the input field to find the matching label for.
 * @returns {HTMLElement|null} The matching label element if found, null otherwise.
 */
const getMatchingLabel = ref => {
    let labels = document.getElementsByTagName('label');

    for (let i = 0; i < Object.keys(labels).length; i++)
    {
        if (labels[i]['htmlFor'] === ref) return labels[i];
    }
}

/**
 * Creates and appends a warning icon element to the specified input field.
 * 
 * @param {string} fieldId - The input id to find the matching label, in order to add the warning icon.
 * @returns {void}
 */
const createWarningElement = fieldId => {
    let iconId = 'warn-icon-' + fieldId;

    if (document.getElementById(iconId)) return;

    let matchingLabel = getMatchingLabel(fieldId),
        warnNode = document.createElement('i');

    warnNode.classList.add('fa-solid', 'fa-triangle-exclamation', 'text-yellow-600', 'ml-4');
    warnNode.dataset.warnIcon = true;
    warnNode.id = iconId;
    matchingLabel.appendChild(warnNode);
}

const updateAdminProfilePicture = async (e) => {
    console.info('Profile picture selected : ' + e.target.files[0]['name']);

    let fd = new FormData(),
        snackbarData = manageSnackbar({
            'msg'  : 'Your profile picture is being uploaded. Please wait...',
            'state': 'info'
        }, 'init');

    fd.append('picture', e.target.files[0]);

    try {
        let response = await authManager.makeAuthenticatedRequest('./admin/uploadProfilePicture',
        {
            method: 'POST',
            body: fd
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json();

        changeProfilePicture(responseData);

        manageSnackbar({
            msg   : 'Profile picture successfully uploaded.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot upload your profile picture. Please contact the administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

const changeProfilePicture = res => {
    let profilePictureElements = document.querySelectorAll('[data-profile-picture="currentAdmin"]');

    for (let i = 0; i < profilePictureElements.length; i++)
    {
        console.assert(profilePictureElements[i]);
        profilePictureElements[i].src = res['data']['picture'];
    }
}

/**
 * Handles "Enter" key press for saving profile data.
 * @param {KeyboardEvent} event - The keyboard event triggered by pressing a key.
 */
const handleEnterKeySave = event => {
    event.preventDefault();

    if (event.key === 'Enter') {
        const selectedInput = event.target;

        let inputId = (selectedInput.name === 'password') ? 'admin-new-password' : selectedInput.id,

            inputValue = (selectedInput.name === 'password') ? document.getElementById('admin-new-password').value : selectedInput.value;

        let changes = (event.ctrlKey) ? changesWatcher : {[fieldMapping[inputId]]: inputValue};

        pushProfileUpdate(changes);
    }
};

const checkPasswordInputs = targetedPasswordInput => {
    let password2 = (targetedPasswordInput.id === 'admin-confirm-password') ? document.getElementById('admin-new-password') : document.getElementById('admin-confirm-password');
    
    let passwordIssue = document.getElementById('profile-password-issue');

    if (password2.value.length === 0 && targetedPasswordInput.value.length === 0)
    {
        console.error('Your password can\'t be empty. Cannot save your data.');

        passwordIssue.textContent = 'Your password can\'t be empty.'
        passwordIssue.style.display = 'block';

        return false;
    }
    else if (password2.value === targetedPasswordInput.value)
    {
        passwordIssue.style.display = 'none';

        return true;
    }
    else
    {
        console.error('Passwords don\'t match. Cannot save your data.');

        passwordIssue.textContent = 'Passwords don\'t match.'
        passwordIssue.style.display = 'block';

        return false;
    }
}

const saveAllProfileChanges = () => {
    console.info("Saving all changes...");

    pushProfileUpdate(changesWatcher);
}

const discardChangesIndicators = element => {
    console.info('Removing changes indicators...');

    delete changesWatcher[element];

    if (Object.keys(changesWatcher).length === 0)
    {
        toggleChangesWarning(false);
        toggleProfileWarningIcon(false);

    }

    if (element) {
        
        document.getElementById('warn-icon-' + fieldMapping.getKeyByValue(element)).remove()

    } else {
        inputWarningIcons = document.querySelector(profileFormContainer).querySelectorAll('[data-warn-icon="true"]');

        for (let i = 0; i < inputWarningIcons.length; i++)
        {
            inputWarningIcons[i].remove();
        }
    }
}

const discardProfileChanges = () => {
    console.info("Discarding profile changes...");
    let form = document.querySelector(profileFormContainer),
        inputs = form.getElementsByTagName('input');
    
    document.getElementById('profile-password-issue').style.display = 'none';

    for (let i = 0; i < inputs.length; i++)
    {
        if (changesWatcher[fieldMapping[inputs[i].id]])
        {
            console.info(inputs[i].value, inputs[i].dataset.value);
            inputs[i].value = inputs[i].dataset.value;
            discardChangesIndicators(fieldMapping[inputs[i].id])
        }
    }
    console.info("Successfully discarded profile changes.");
}

/**
 * Listens for input changes and triggers warnings.
 * @param {InputEvent} event - The input event triggered by any change in the form.
 */
const handleInputChange = (event) => {

    const fieldId = (event.target.name === 'password') ? 'admin-new-password' : event.target.id;

    (fieldId === 'admin-new-password') ? checkPasswordInputs : null;

    if (fieldMapping[fieldId]) {
        changesWatcher[fieldMapping[fieldId]] = event.target.value;

        toggleChangesWarning(true);
        toggleProfileWarningIcon(true);
        createWarningElement(fieldId);
    }
};

/**
 * Updates the profile with new data.
 * @param {Array} data - The data to update.
 */
const pushProfileUpdate = async (data) => {

    if('password_hash' in data && !checkPasswordInputs(document.getElementById('admin-new-password'))) return;

    const snackbarData = manageSnackbar({
            msg: 'Your data is being processed. Please wait...',
            state: 'info'
        }, 'init');

    try {
        let response = await authManager.makeAuthenticatedRequest('./admin/updateAdminProfile',
        {
            method: 'PUT',
            body: JSON.stringify(data)
        });
        
        // Delete corresponding entry in changesWatcher.
        for (let i in data)
        {
            let currentFieldKey = Object.keys(data)[0];

            let currentField = document.getElementById(fieldMapping.getKeyByValue(currentFieldKey));
            currentField.dataset.value = currentField.value;
            discardChangesIndicators(i);

            delete data[currentFieldKey];
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
const toggleChangesWarning = (keepAlive) => {
    const warningMessageContainer = document.querySelector('#warning-profile-message');
    toggleElementDisplay(warningMessageContainer, 'flex', keepAlive);
};

/**
 * Toggles the profile warning icon visibility.
 * @param {boolean} keepAlive - Whether to keep the icon displayed.
 */
const toggleProfileWarningIcon = (keepAlive) => {
    const warningIcon = document.querySelector('#warning-profile-icon');
    
    toggleElementDisplay(warningIcon, 'inline', keepAlive);
};

/**
 * Toggle password visibility with its icon
 * @param {string} inputId - Password input's id
 * @param {HTMLElement} icon - Icon element
 */
const togglePasswordVisibility = (inputId, icon) => {
    const input = document.getElementById(inputId);
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
document.querySelector(profileFormContainer).addEventListener('keyup', handleEnterKeySave);
document.querySelector(profileFormContainer).addEventListener('input', handleInputChange);
document.querySelector(profileFormContainer).addEventListener('submit', (e) => e.preventDefault());
