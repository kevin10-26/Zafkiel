'use strict'

/**
 * Variables declaration
 */

const desktopEventsTrigger = {
    'open-slideshow-btn': document.getElementById('open-admin-slideshow'),
    'refresh-user-pictures': document.getElementById('slideshow-refresh-user-pictures')
};

var modalsOpened = {
    'admin-slideshow': false
};

var picturesSrc = [];

let frontend = new ZafkielFrontend(),
    authManager = new AuthManager();

/**
 * Intermediate functions definition
 */

/**
 * Adds or removes a picture from the selection.
 * 
 * @param {string} mode - 'add' to add the picture, 'remove' to remove it.
 * @param {HTMLElement} node - The image element.
 */
const managePictureSelection = (mode, node) => {
    if (mode === 'add') {
        picturesSrc.push(node.dataset.picturePath);
    } else {
        const index = picturesSrc.indexOf(node.dataset.picturePath);
        if (index > -1) {
            picturesSrc.splice(index, 1);
        }
    }
}

/**
 * Selects all pictures in the slideshow
 */
const selectAllPictures = () => {
    const picturesNodes = document.querySelectorAll('.picture-element');
    picturesNodes.forEach(node => {
        node.classList.add('selected-picture-slideshow');
        managePictureSelection('add', node.querySelector('img'));
    });
}

/**
 * Unselects all pictures in the slideshow
 */
const unselectAllPictures = () => {
    const picturesNodes = document.querySelectorAll('.picture-element');
    picturesNodes.forEach(node => {
        node.classList.remove('selected-picture-slideshow');
        managePictureSelection('remove', node.querySelector('img'));
    });
}

/**
 * Submits the selected pictures for the slideshow
 */
const submitSlideshowPictures = async () => {
    let snackbarData = manageSnackbar({
        'msg'  : 'Your slideshow preferences are being updated. Please wait...',
        'state': 'info'
    }, 'init');

    try {
        const requestBody = {"pictures": picturesSrc};

        let response = await authManager.makeAuthenticatedRequest('./slideshow/updateSlideshowPictures',
        {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json();

        if (responseData.status === 'error') {
            throw new Error(responseData.message);
        }

        manageSnackbar({
            msg   : responseData.message,
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');

    } catch (error) {
        console.error('Error updating slideshow:', error);
        manageSnackbar({
            msg   : error.message || 'Something went wrong while updating your slideshow preferences. Please contact your administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

/**
 * Uploads a selected picture for the slideshow.
 * 
 * @param {Event} e - The form submission event.
 */
const uploadSlideshowPicture = async (e) => {
    e.preventDefault();

    console.info('Picture selected : ' + e.target[0].files[0]['name']);

    let fd = new FormData(),
        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being uploaded. Please wait...',
            'state': 'info'
        }, 'init');

    fd.append('picture', e.target[0].files[0]);

    try {
        let response = await authManager.makeAuthenticatedRequest('./slideshow/uploadNewPicture',
        {
            method: 'POST',
            body: fd
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json();

        if (responseData.status === 'error') {
            throw new Error(responseData.message);
        }

        manageSnackbar({
            msg   : 'Picture successfully uploaded.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot upload your picture. Please contact the administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

const deleteUserPicture = async (e, picturePath) => {
    e.preventDefault();

    console.info('Picture to be deleted : ' + picturePath);

    let snackbarData = manageSnackbar({
        'msg'  : 'Your picture is being deleted. Please wait...',
        'state': 'info'
    }, 'init');

    try {
        let response = await authManager.makeAuthenticatedRequest('./slideshow/deletePicture',
        {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({picture: picturePath})
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json();
        
        let pictureContainer = (e.target.tagName === 'I') ? e.target.parentElement.parentElement : e.target.parentElement;
        pictureContainer.remove();

        if (responseData.status === 'error') {
            throw new Error(responseData.message);
        }

        manageSnackbar({
            msg   : 'Picture successfully deleted.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot delete your picture. Please contact the administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

/**
 * Events trigger definition
 */

// Triggers slideshow-settings modal
desktopEventsTrigger['open-slideshow-btn'].addEventListener('click', async () => {

    let openSlideshowSettings = manageSnackbar({
        'msg'  : 'Processing...',
        'state': 'info'
    }, 'init');
    
    let slideshowModal = frontend.openModal('admin-slideshow-modal');

    if (modalsOpened['admin-slideshow'])
    {
        return false;
    }

    modalsOpened['admin-slideshow'] = true;

    let getPictures = await authManager.makeAuthenticatedRequest('./slideshow/fetchPictures',
        {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            }
        }
    );

    let picturesRender = await getPictures.text();

    slideshowModal.obj.fill('admin-slideshow-modal-content', picturesRender);

    const picturesNodes = document.querySelectorAll('.selected-picture-slideshow');
    picturesSrc = Array.from(picturesNodes, element => 
        element.children[1].dataset.picturePath
    );
    
    document.getElementById('slideshow-waiting-screen').style.display = 'none';

    manageSnackbar({
        'msg'  : 'All pictures are loaded!',
        'state': 'success',
        'ttl': 5000,
        'origin': openSlideshowSettings.id
    }, 'alter');
});

// Triggers the button refreshing the user's personal gallery in the slideshow modal.
desktopEventsTrigger['refresh-user-pictures'].addEventListener('click', async (e) => {
    
    let refreshInfo = manageSnackbar({
        'msg'  : 'Processing...',
        'state': 'info'
    }, 'init');

    let slideshowTab = frontend.openTab('slideshow-tab-link', 'slideshow-tab-content', 'user-pictures');

    let getPictures = await authManager.makeAuthenticatedRequest('./slideshow/fetchPictures',
        {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({"onlyUserPictures": true})
        });

    let picturesRender = await getPictures.text();

    slideshowTab.obj.fill('user-pictures-container', picturesRender);
    e.target.classList.add("slideshow-tab-active");

    manageSnackbar({
        'msg'  : 'Your personal gallery is refreshed!',
        'state': 'success',
        'ttl': 5000,
        origin: refreshInfo.id
    }, 'alter');
});