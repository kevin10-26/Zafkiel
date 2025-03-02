'use strict'

var picturesSrc = {
    'user_data': {},
    'pictures' : []
};

var modalOpened = false;

const getUserData = (option, adminName, apiKey) => {
    return {
        'options': option,
        'admin'  : adminName,
        'api_key': apiKey
    };
}

const uploadPictureBtn = '#upload-picture-btn';

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

const toggleSlideshowGallery = mode => {
    document.getElementById('toggle-pictures-slideshow').style.display = (mode === 'on') ? 'block' : 'none';
}

const initPicturesContainer = (adminName, apiKey) => {
    if (picturesSrc['pictures'].length > 0) {
        // The close events are already set
        // This condition is the case when the modal has already been closed
        // So the pictures are already generated.
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

const addPictureToSelection = (mode, node) => {
    if (mode === 'add')
    {
        picturesSrc['pictures'].push(node.dataset.picturePath);

    } else
    {
        const index = picturesSrc['pictures'].indexOf(node.dataset.picturePath);

        if (index > -1)
        {
            picturesSrc['pictures'].splice(index, 1);
        }
    }
}

const refreshUserPictures = async (e, adminName, apiKey) => {
    
    let request   = "options=user-pictures&admin=" + adminName + "&api_key=" + apiKey + "&pictures=" + getUserPictures(),
        container = 'user-pictures-container',

        snackbarData = manageSnackbar({
            'msg'  : 'Your picture is being updated. Please wait...',
            'state': 'info'
        }, 'init');

    try
    {
        await fillContainer(container, request, 'append');
        manageSnackbar({
            msg   : 'Gallery successfully refreshed.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error)
    {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot refresh your gallery.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
    
};

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


const showPicturePreview = (e, targetedContainer) => {
    let imgPreview = document.getElementById(targetedContainer);

    imgPreview.src = URL.createObjectURL(e.target.files[0]);
    imgPreview.style.display = 'block';

    document.querySelector(uploadPictureBtn).style.display = 'block';
}

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

    try
    {
        await pushRequests(fd, true);
        manageSnackbar({
            msg   : 'Picture successfully uploaded.',
            state : 'success',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    } catch (error)
    {
        console.error(error);
        manageSnackbar({
            msg   : 'Cannot upload your picture. Please contact the administrator.',
            state : 'error',
            ttl   : 5000,
            origin: snackbarData.id
        }, 'alter');
    }
}

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

const unselectAllPictures = () => {
    let pictures = document.querySelectorAll('.picture-element');

    for (let item of pictures) {
        item.classList.remove('selected-picture-slideshow');
    }

    picturesSrc['pictures'] = [];
}
