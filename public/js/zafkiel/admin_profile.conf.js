'use strict'

const profileFormContainer = '#change-admin-data',
      watchWarning         = '#watcher-warning';

var changesWatcher = {};

var profileModifications = {
    'user_data': {},
    'fields'   : {}
}

// This listener is for 'Enter' key, when the users wants to save his data.
document.querySelector(profileFormContainer).addEventListener('keyup', event => {
    
    // 13 = "Enter" key code
    if (event.which === 13)
    {
        let selectedInput = event.target;

        // If the target = password and is empty, prevent the user from saving his changes.
        // OR condition: if it is any other changes, no matter if it is empty or not
        if (selectedInput.name !== 'password' || selectedInput.name === 'password' && checkPasswordInputs(selectedInput))
        {
            // Add input action
            pushProfileUpdate([selectedInput]);
        } else
        {
            console.warn('Something went wrong while updating your information.');
        }
    }
});

// This listener is for any input detected on the targets
// This will remind the user to save his change
document.querySelector(profileFormContainer).addEventListener('input', event => {
    changesWatcher[event.target.id] = event.target.value;

    toggleChangesWarning(true);
    toggleProfileWarningIcon(true);
});


const pushProfileUpdate = async (data, adminName, apiKey) => {
    e.preventDefault();

    console.log('Data to update : ' + data);

    let fd = new FormData(),

        snackbarData = manageSnackbar({
            'msg'  : 'Your data is being processed. Please wait...',
            'state': 'info'
        }, 'init');

    fd.append('data', data);
    fd.append('user_data', JSON.stringify(getUserData('upload-slideshow-picture', adminName, apiKey)));

    try
    {
        await pushRequests(fd, true);
        manageSnackbar({
            msg   : 'Data successfully updated.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error)
    {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot update your data. Please contact the administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

const toggleChangesWarning = keepAlive => {
    let warningMessageContainer = document.querySelector('#warning-profile-message');
    
    (keepAlive && warningMessageContainer.style.display === 'flex') ? '' :toggleElementDisplay(warningMessageContainer, 'flex');
}

const toggleProfileWarningIcon = keepAlive => {
    let warningIcon = document.querySelector('#warning-profile-icon');

    (keepAlive && warningIcon.style.display === 'inline') ? '' : toggleElementDisplay(warningIcon, 'inline');
}