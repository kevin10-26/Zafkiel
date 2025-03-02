/**
 * @file ui-elements.js
 * @description A module to manage UI elements, including profile form validation, warnings, and snackbar notifications.
 * @license MIT
 */

'use strict';

/**
 * Watches for changes in the profile form and triggers appropriate warnings and updates.
 */
const profileFormContainer = '#change-admin-data';
const watchWarning = '#watcher-warning';
let changesWatcher = {};

/**
 * Stores modifications to the profile data.
 */
const profileModifications = {
    'user_data': {},
    'fields': {}
};

/**
 * Handles "Enter" key press for saving profile data.
 * @param {KeyboardEvent} event - The keyboard event triggered by pressing a key.
 */
const handleEnterKeySave = (event) => {
    if (event.which === 13) {
        const selectedInput = event.target;
        if (selectedInput.name !== 'password' || (selectedInput.name === 'password' && checkPasswordInputs(selectedInput))) {
            pushProfileUpdate([selectedInput]);
        } else {
            console.warn('Something went wrong while updating your information.');
        }
    }
};

/**
 * Listens for input changes and triggers warnings.
 * @param {InputEvent} event - The input event triggered by any change in the form.
 */
const handleInputChange = (event) => {
    console.log('here');
    changesWatcher[event.target.id] = event.target.value;
    toggleChangesWarning(true);
    toggleProfileWarningIcon(true);
};

/**
 * Updates the profile with new data.
 * @param {Array} data - The data to update.
 * @param {string} adminName - The name of the admin updating the data.
 * @param {string} apiKey - The API key for authentication.
 */
const pushProfileUpdate = async (data, adminName, apiKey) => {
    const fd = new FormData();
    const snackbarData = manageSnackbar({
        msg: 'Your data is being processed. Please wait...',
        state: 'info'
    }, 'init');

    fd.append('data', data);
    fd.append('user_data', JSON.stringify(getUserData('upload-slideshow-picture', adminName, apiKey)));

    try {
        await pushRequests(fd, true);
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
    console.log('here');
    toggleElementDisplay(warningIcon, 'inline', keepAlive);
};

// Event listeners for the profile form
document.querySelector(profileFormContainer).addEventListener('keyup', handleEnterKeySave);
document.querySelector(profileFormContainer).addEventListener('input', handleInputChange);
