/**
 * @file slideshow.conf.js
 * @description A module to handle slideshow functionality (image transition, automatic slideshow, slideshow preferences update, etc.)
 * @license LGPL2-1
 */

'use strict'

/**
 * Object to store user data and selected pictures for slideshow.
 
var picturesSrc = {
    'pictures' : [],
    'options'  : ''
};

var modalOpened = false;

/**
 * Starts the slideshow by iterating through the slides.
 * @param {string} containerId - The ID of the container holding the slideshow.
 * @param {string} slideClass - The class name of the slides.
 */
const startSlideshow = (containerId, slideClass) => {
    console.log(containerId, document.getElementById(containerId));

    
    const slideshowContainer = document.getElementById(containerId);
    const slides = slideshowContainer.getElementsByClassName(slideClass);

    if (slides.length === 0) return; // Exit if no slides exist.

    let currentIndex = 0;

    /**
     * Displays the next slide with a fade-in and fade-out transition.
     */
    const showNextSlide = () => {
        const currentSlide = slides[currentIndex];
        const nextIndex = (currentIndex + 1) % slides.length;
        const nextSlide = slides[nextIndex];

        // Show the next slide
        nextSlide.classList.remove("hidden");
        nextSlide.classList.add("opacity-0");

        // Transition the current slide out and the next slide in with opacity property
        setTimeout(() => {
            currentSlide.classList.remove("opacity-100");
            currentSlide.classList.add("opacity-0");

            nextSlide.classList.remove("opacity-0");
            nextSlide.classList.add("opacity-100");
        }, 0);

        // Hide the current slide after the transition
        setTimeout(() => {
            currentSlide.classList.add("hidden");
        }, 1000); // Matching CSS transition duration

        // Update the current index
        currentIndex = nextIndex;
    };

    // Initially display the first slide
    slides[currentIndex].classList.remove("opacity-0", "hidden");
    slides[currentIndex].classList.add("opacity-100");

    // Start the slideshow with automatic interval
    setInterval(showNextSlide, 5000); // Transition every 5 seconds
};

// Initialize slideshows when the DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    startSlideshow('slideshow-settings-container', 'slides-settings');
    startSlideshow('slideshow-desktop-container', 'slides-desktop');
});

/**
 * Selects an image for the slideshow and adds/removes it from selection.
 * 
 * @param {Event} e - The click event of the image.
 */
const selectImageForSlideshow = e => {
    const { classList } = e.currentTarget;

    let imgPath = e.currentTarget.getElementsByTagName('img')[0],
        preview = document.getElementById('slideshow-preview-image-thumbnail');
    
    preview.src = imgPath.src;

    if (classList.contains('selected-picture-slideshow')) {

        classList.remove('selected-picture-slideshow');
        managePictureSelection('remove', imgPath);
        preview.style.display = 'none';
        document.getElementById('slideshow-preview-image').open = false;

    } else {

        classList.add('selected-picture-slideshow');
        managePictureSelection('add', imgPath);
        preview.style.display = 'block';
        document.getElementById('slideshow-preview-image').open = true;

    }
}

/**
 * Deletes a user picture from the server.
 * 
 * @param {Event} e - The click event of the image.
 * @param {string} path - The image path.
 
const deleteUserPicture = async (e, path) => {
    let requestBody = {
        'options': 'delete-user-pictures',
        'picture': path,
        'callerType': 'delete',
        'update-admin': true
    },
        
        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being deleted. Please wait...',
            'state': 'info'
        }, 'init');

    try {
        await deleteElement(requestBody);

        picturesSrc['pictures'].hasOwnProperty(path) ? delete picturesSrc['pictures'][path] : null;

        let pictureContainer = (e.target.tagName === 'I') ? e.target.parentElement.parentElement : e.target.parentElement;
        pictureContainer.remove();

        manageSnackbar({
            msg   : 'Picture successfully deleted.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error) {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot delete your Picture.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}*/

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
 */
const initPicturesContainer = async () => {
    if (picturesSrc['pictures'].length > 0) {
        document.getElementById('admin-slideshow-modal').style.display = 'block';
        return;
    }

    let response = await openModal('admin-slideshow-modal', 'slideshow-pictures', 'slideshow/fetchPictures/');

    if (response['error'] !== undefined) {

        document.getElementById('slideshow-loading-spinner').style.display = 'none';
        document.getElementById('slideshow-loading-text').textContent = response['error'];
        
    }

    const picturesNodes = document.querySelectorAll('.selected-picture-slideshow');
    
    if (picturesNodes.length === 0) {
        console.warn("No elements found");
        return;
    }

    picturesSrc['pictures'] = Array.from(picturesNodes, element => 
        element.children[0].dataset.picturePath
    );

    console.info("Pictures stored:", picturesSrc['pictures']);

    document.getElementById('slideshow-waiting-screen').style.display = 'none';
};

/**
 * Adds or removes a picture from the selection.
 * 
 * @param {string} mode - 'add' to add the picture, 'remove' to remove it.
 * @param {HTMLElement} node - The image element.
 
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
 * Refreshes user pictures by making an API request.
 * 
 * @param {Event} e - The event triggering the refresh.
 * @param {string} adminName - The admin name.
 * @param {string} apiKey - The API key.
 */
const refreshUserPictures = async (e, adminName, apiKey) => {
    let requestBody = {
            'options': 'user-pictures',
            'pictures': `${getUserPictures()}`,
            'callerType': 'fetch'
        },

        container = 'user-pictures-container',
        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being updated. Please wait...',
            'state': 'info'
        }, 'init');

    try {
        await fillContainer(container, requestBody, 'fill');
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
        if (picturesElements[i].classList.contains('selected-picture-slideshow')) userPictures.push(picturesElements[i].children[0]?.dataset.picturePath);
    }

    return JSON.stringify(userPictures);
};

/**
 * Updates the slideshow pictures preferences for an admin.
 */
const updateSlideshowPictures = async () => {
    picturesSrc['options'] = 'update-slideshow-pictures';
    picturesSrc['update-admin'] = true;
    picturesSrc['callerType'] = 'push';

    let snackbarData = manageSnackbar({
            'msg'  : 'Your slideshow preferences are being updated. Please wait...',
            'state': 'info'
        }, 'init');
    
    try {
        let response = await pushRequests(picturesSrc, false);

        console.info('Slideshow pictures preferences successfully updated: ' + response.adminName);
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
    // document.querySelector(uploadPictureBtn).style.display = 'block';
}



/**
 * Selects all pictures in the gallery for slideshow.
 
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
 
const unselectAllPictures = () => {
    let pictures = document.querySelectorAll('.picture-element');

    for (let item of pictures) {
        item.classList.remove('selected-picture-slideshow');
    }

    picturesSrc['pictures'] = [];
}*/
