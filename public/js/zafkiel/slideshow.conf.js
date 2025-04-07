'use strict'

/**
 * Object to store user data and selected pictures for slideshow.
 */
var picturesSrc = {
    'user_data': {},
    'pictures' : []
};

var modalOpened = false;

/**
 * Creates user data object for API requests.
 * 
 * @param {string} option - The option related to the request (e.g., 'push-slideshow-pictures').
 * @param {string} adminName - The admin name for which the data is being handled.
 * @param {string} apiKey - The API key for authentication.
 * @returns {object} - The user data object.
 */
const getUserData = (option, adminName, apiKey) => {
    return {
        'options': option,
        'admin'  : adminName,
        'api_key': apiKey
    };
}

/**
 * Selects an image for the slideshow and adds/removes it from selection.
 * 
 * @param {Event} e - The click event of the image.
 */
const selectImageForSlideshow = e => {
    const { classList } = e.currentTarget;

    if (classList.contains('selected-picture-slideshow')) {
        classList.remove('selected-picture-slideshow');
        addPictureToSelection('remove', e.currentTarget.getElementsByTagName('img')[0]);
    } else {
        classList.add('selected-picture-slideshow');
        addPictureToSelection('add', e.currentTarget.getElementsByTagName('img')[0]);
    }
}

/**
 * Toggles the visibility of the slideshow gallery modal.
 * 
 * @param {string} mode - The mode to set ('on' to show, any other value to hide).
 */
const toggleSlideshowGallery = mode => {
    document.getElementById('toggle-pictures-slideshow').style.display = (mode === 'on') ? 'block' : 'none';
}

/**
 * Initializes the pictures container by fetching selected pictures or reopening the modal.
 * 
 * @param {string} adminName - The name of the admin.
 * @param {string} apiKey - The API key for authentication.
 */
const initPicturesContainer = (adminName, apiKey) => {
    if (picturesSrc['pictures'].length > 0) {
        // Modal is already open and pictures are already selected
        document.getElementById('admin-slideshow-modal').style.display = 'block';
        return;
    }

    if (!modalOpened) {
        openModal('admin-slideshow-modal', 'slideshow-pictures', adminName, apiKey);
        modalOpened = true;
    }

    let picturesNodes = document.getElementsByClassName('selected-picture-slideshow'),
        pictures = [];

    if (picturesNodes.length === 0) {
        console.warn("No elements. Restarting...");
        setTimeout(() => initPicturesContainer(adminName, apiKey), 500);
        return;
    }

    let items = Array.from(picturesNodes);
    items.forEach(element => {
        pictures.push(element.children[0].dataset.picturePath);
    });

    picturesSrc['pictures'] = pictures;
    console.log("Pictures stored:", picturesSrc['pictures']);

    document.getElementById('loading-spinner').style.display = 'none';
};

/**
 * Adds or removes a picture from the selection.
 * 
 * @param {string} mode - 'add' to add the picture, 'remove' to remove it.
 * @param {HTMLElement} node - The image element.
 */
const addPictureToSelection = (mode, node) => {
    if (mode === 'add') {
        picturesSrc['pictures'].push(node.dataset.picturePath);
    } else {
        const index = picturesSrc['pictures'].indexOf(node.dataset.picturePath);
        if (index > -1) {
            picturesSrc['pictures'].splice(index, 1);
        }
    }
}

/**
 * Refreshes user pictures by making an API request.
 * 
 * @param {Event} e - The event triggering the refresh.
 * @param {string} adminName - The admin name.
 * @param {string} apiKey - The API key.
 */
const refreshUserPictures = async (e, adminName, apiKey) => {
    let request = `options=user-pictures&admin=${adminName}&api_key=${apiKey}&pictures=${getUserPictures()}`,
        container = 'user-pictures-container',
        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being updated. Please wait...',
            'state': 'info'
        }, 'init');

    try {
        await fillContainer(container, request, 'append');
        manageSnackbar({
            msg   : 'Gallery successfully refreshed.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot refresh your gallery.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
};

/**
 * Retrieves the paths of all user pictures from the DOM.
 * 
 * @returns {string} - A JSON string of picture paths.
 */
const getUserPictures = () => {
    let containerId = document.querySelector('#user-pictures-container');
    
    if (!containerId) {
        console.warn('Container #user-pictures-container is not found');
        return JSON.stringify([]);
    }

    let picturesElements = containerId.children;
    let userPictures = [];

    for (let i = 0; i < picturesElements.length; i++) {
        userPictures.push(picturesElements[i].children[0]?.dataset.picturePath);
    }

    return JSON.stringify(userPictures);
};

/**
 * Updates the slideshow pictures preferences for an admin.
 * 
 * @param {string} adminName - The admin name.
 * @param {string} apiKey - The API key.
 */
const updateSlideshowPictures = async (adminName, apiKey) => {
    picturesSrc['user_data'] = getUserData('push-slideshow-pictures', adminName, apiKey);

    let pictures = JSON.stringify(picturesSrc),
        snackbarData = manageSnackbar({
            'msg'  : 'Your slideshow preferences are being updated. Please wait...',
            'state': 'info'
        }, 'init');
    
    try {
        let response = await pushRequests(pictures, false);

        console.log('Slideshow pictures preferences successfully updated: ' + response.id);
        manageSnackbar({
            msg   : 'Preferences successfully updated.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Something went wrong while updating your preferences. Please contact your administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
};

/**
 * Shows a picture preview when a file is selected for upload.
 * 
 * @param {Event} e - The file input change event.
 * @param {string} targetedContainer - The ID of the container to display the preview.
 */
const showPicturePreview = (e, targetedContainer) => {
    let imgPreview = document.getElementById(targetedContainer);
    imgPreview.src = URL.createObjectURL(e.target.files[0]);
    imgPreview.style.display = 'block';
    document.querySelector(uploadPictureBtn).style.display = 'block';
}

/**
 * Uploads a selected picture for the slideshow.
 * 
 * @param {Event} e - The form submission event.
 * @param {string} adminName - The admin name.
 * @param {string} apiKey - The API key.
 */
const uploadSlideshowPicture = async (e, adminName, apiKey) => {
    e.preventDefault();

    console.log('Pictures selected : ' + e.target[0].files[0]);

    let fd = new FormData(),
        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being uploaded. Please wait...',
            'state': 'info'
        }, 'init');

    fd.append('pictures', e.target[0].files[0]);
    fd.append('user_data', JSON.stringify(getUserData('upload-slideshow-picture', adminName, apiKey)));

    try {
        await pushRequests(fd, true);
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

/**
 * Selects all pictures in the gallery for slideshow.
 */
const selectAllPictures = () => {
    let pictures = document.querySelectorAll('.picture-element'),
        paths = [];

    picturesSrc['pictures'] = [];

    for (let item of pictures) {
        item.classList.add('selected-picture-slideshow');
        paths.push(item.children[0].dataset.picturePath);
    }

    picturesSrc['pictures'] = paths;
}

/**
 * Unselects all selected pictures in the gallery.
 */
const unselectAllPictures = () => {
    let pictures = document.querySelectorAll('.picture-element');

    for (let item of pictures) {
        item.classList.remove('selected-picture-slideshow');
    }

    picturesSrc['pictures'] = [];
}
