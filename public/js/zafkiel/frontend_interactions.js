/**
 * @file frontend_interactions.js
 * @description A module to handle basic frontend interactions (snackbar init, fetch requests, etc.)
 * @license LGPL2-1
 */

'use strict';

const modalMapping = {
    'admin-status-modal': {
        modalId: 'admin-status-modal',
        contentId: 'admin-status-modal-content',
        loaderId: 'status-waiting-screen',
        loaderTextId: 'status-loading-text',
        loaderSpinnerId: 'status-loading-spinner',
        closeButtonId: 'close-admin-status-modal'
    },
    'admin-slideshow-modal': {
        modalId: 'admin-slideshow-modal',
        contentId: 'admin-slideshow-modal-content',
        loaderId: 'slideshow-waiting-screen',
        loaderTextId: 'slideshow-loading-text',
        loaderSpinnerId: 'slideshow-loading-spinner',
        closeButtonId: 'close-admin-slideshow-modal'
    }
};

const updateClock = () => {
    const now = new Date();

    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    const year = now.getFullYear();

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    const dateString = `${day}/${month}/${year}`;
    const timeString = `${hours}H${minutes}`;

    document.getElementById('zafkiel-taskbar-clock').textContent = timeString;
    document.getElementById('zafkiel-taskbar-date').textContent = dateString;
}

// Updates clock every minute
setInterval(updateClock, 1000);

// Launches clock from desktop init.
updateClock();

const getAsyncData = (option, hasFile, mode) => {
    return {
        options: option,
        file: hasFile,
        callerType: mode
    };
}

/**
 * Manages the display and updates of a snackbar notification.
 * @param {Object} data - Data for the snackbar notification.
 * @param {string} mode - Mode to either initialize or alter the snackbar.
 * @returns {Object} The snackbar instance.
 */
const manageSnackbar = (data, mode) => {
    let snackbar = new ZafkielSnackbar();
    return mode === 'alter' ? snackbar.alter(data) : snackbar.init(data);
};

/**
 * Filters and displays the search results based on the input value.
 * @param {Event} e - The event triggered by the form input.
 */
const displayResults = (e) => {
    e.preventDefault();

    let input = e.target.name === 'form' ? e.target[0] : e.target;
    let modulesList = document.getElementById('services-list');
    let modulesContainer = document.getElementById('services-container');

    // Clear current module list.
    clearNode(modulesContainer);

    // Filter and display matching services.
    for (let i = 0; i < modulesList.children.length; i++) {
        if (modulesList.children[i].value.toLowerCase().includes(input.value.toLowerCase()) ||
            modulesList.children[i].textContent.toLowerCase().includes(input.value.toLowerCase())) {
            let module = {
                "alias": modulesList.children[i].value,
                "name": modulesList.children[i].textContent,
                "path": modulesList.children[i].dataset.path
            };
            modulesContainer.appendChild(createModuleNode(module));
        }
    }
};

/**
 * Clears all child elements of a given node.
 * @param {HTMLElement} node - The DOM element to clear.
 */
const clearNode = (node) => {
    while (node.firstChild) {
        node.removeChild(node.lastChild);
    }
};

/**
 * Creates and returns a module element for display.
 * @param {Object} module - The module data.
 * @returns {HTMLElement} The generated module node.
 */
const createModuleNode = (module) => {
    let div = document.createElement('div');
    let img = document.createElement('img');
    let p = document.createElement('p');

    div.classList.add('p-4');
    div.onclick = () => displayModule(module['alias']);

    img.classList.add('block', 'w-28', 'h-28', 'mx-auto', 'rounded-full', 'object-cover');
    img.src = module['path'];
    img.alt = "Icon for service: " + module['name'];

    p.classList.add('font-semibold', 'text-center', 'mt-2', 'text-lg');
    p.textContent = module['name'];

    div.appendChild(img);
    div.appendChild(p);

    return div;
};

/**
 * Displays the selected module by hiding other modules.
 * @param {string} module - The alias of the module to display.
 */
const displayModule = (module) => {
    let modules = document.getElementsByClassName('module');

    for (let i = 0; i < modules.length; i++) {
        modules[i].style.display = 'none';
    }

    document.getElementById(module).style.display = 'block';
};

/**
 * Displays the selected tab's content.
 * @param {Event} e - The event triggered by tab selection.
 * @param {string} tabType - The type of tab (e.g., settings).
 * @param {string} tab - The ID of the tab content to display.
 */
const displayTab = (e, tabType, tab) => {
    console.info('Tab opened: ' + tab);
    let tabContent = document.getElementsByClassName(tabType + '-tab-content');

    for (let i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = 'none';
    }

    document.getElementById(tab).style.display = 'block';
};

/**
 * Toggles the display of an element between 'none' and the given display style.
 * @param {HTMLElement} el - The element to toggle.
 * @param {string} display - The display style to toggle between.
 * @param {boolean} keepAlive - Whether to keep the element displayed.
 */
const toggleElementDisplay = (el, display, keepAlive) => {
    if (keepAlive && el.style.display === display) return;
    el.style.display = (el.style.display === display) ? 'none' : display;
};

/**
 * Opens a modal and fills it with content.
 * @param {string} modalName - The ID of the modal to open.
 * @param {string} option - The option for the modal (e.g., admin-settings).
 */
const openModal = async (modalName, option, url) => {
    console.time('openModal');

    const modalConfig = modalMapping[modalName];
    if (!modalConfig) {
        console.error(`❌ Unable to find "${modalName}" conf.`);
        return;
    }

    const modal = document.getElementById(modalConfig.modalId);
    const closeModal = document.getElementById(modalConfig.closeButtonId);
    const loader = document.getElementById(modalConfig.loaderId);
    const loaderText = document.getElementById(modalConfig.loaderTextId);
    const loaderSpinner = document.getElementById(modalConfig.loaderSpinnerId);
    const content = document.getElementById(modalConfig.contentId);

    if (!modal || !closeModal || !loader || !loaderText || !loaderSpinner || !content) {
        console.error("❌ Unable to find one or more elements.");
        return;
    }

    // Afficher le modal et le loader
    modal.style.display = 'flex';
    loader.style.display = 'flex';

    closeModal.onclick = () => {
        modal.style.display = 'none';
    };

    let requestBody = {
        'options': option,
        'callerType': 'fetch'
    };

    try {
        let response = await fillContainer(modalConfig.contentId, requestBody, url);
        if (response && response.error) {
            loaderText.textContent = response.error;
        } else {
            loader.style.display = 'none'; // Cacher le loader après le chargement
        }
    } catch (error) {
        console.error("❌ Error while opening modal:", error);
        loaderText.textContent = "Error while loading data.";
    }

    console.timeEnd('openModal');
};

/**
 * Fetches data from the server and fills the container with the response.
 * @param {string} containerName - The ID of the container to update.
 * @param {string} requestBody - The request body to send to the server.
 * @param {string} url - The URL to send the request to.
 */
const fillContainer = async (containerName, requestBody, url) => {
    try {
        let response = await AuthManager.makeAuthenticatedRequest(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            // Récupérer le texte de l'erreur
            let errorText = await response.text();
            console.error(`❌ HTTP error : ${response.status} - ${errorText}`);
            return { error: JSON.parse(errorText)['error'] };
        }

        let textResponse = await response.text();
        let container = document.getElementById(containerName);

        if (!container) {
            console.warn(`⚠️ fillContainer: ${containerName} not found.`);
            return;
        }

        container.innerHTML = textResponse;

        console.info(`✅ fillContainer: Content updated for ${containerName}`);

        return [];

    } catch (error) {
        console.error("❌ fillContainer error:", error);
    }
};

/**
 * Sends a POST request to the server.
 * @param {Object} content - The content to send.
 * @param {boolean} formData - Whether the content is FormData.
 * @returns {Promise<Object>} The server response.
 */
const pushRequests = async (content, formData = false) => {
    try {
        const response = await AuthManager.makeAuthenticatedRequest(content.url, {
            method: 'POST',
            headers: formData ? {} : {
                'Content-Type': 'application/json'
            },
            body: formData ? content.data : JSON.stringify(content.data)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Erreur lors de la requête:', error);
        throw error;
    }
};

/**
 * Deletes an element from the server.
 * @param {Object} content - The content containing the element to delete.
 * @returns {Promise<Object>} The server response.
 */
const deleteElement = async (content) => {
    try {
        const response = await AuthManager.makeAuthenticatedRequest(content.url, {
            method: 'DELETE'
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Erreur lors de la suppression:', error);
        throw error;
    }
};
