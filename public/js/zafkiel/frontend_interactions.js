'use strict';

/**
 * @file slideshow.js
 * @description A module to handle slideshow functionality (image transition and automatic slideshow)
 * @license MIT
 */

'use strict';

/**
 * Starts the slideshow by iterating through the slides.
 * @param {string} containerId - The ID of the container holding the slideshow.
 * @param {string} slideClass - The class name of the slides.
 */
const startSlideshow = (containerId, slideClass) => {
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

        // Transition the current slide out and the next slide in
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

    img.classList.add('block', 'w-28', 'h-28', 'mx-auto', 'rounded-full');
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
    console.log('Tab opened: ' + tab);
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
 * @param {string} adminName - The administrator's name.
 * @param {string} apiKey - The API key for authentication.
 */
const openModal = (modalName, option, adminName, apiKey) => {
    let modal = document.getElementById(modalName);
    let closeModal = document.getElementById('close-' + modalName);
    let requestBody = `options=${option}&admin=${adminName}&api_key=${apiKey}`;
    let modalBoxName = modalName + '-content';

    fillContainer(modalBoxName, requestBody, 'fill');

    modal.style.display = 'flex';

    closeModal.onclick = () => {
        modal.style.display = 'none';
    };
};

/**
 * Fetches data from the server and fills the container with the response.
 * @param {string} containerName - The ID of the container to update.
 * @param {string} requestBody - The request body to send to the server.
 * @param {string} fillMode - The mode to fill or append the content ('fill' or 'append').
 */
const fillContainer = async (containerName, requestBody, fillMode) => {
    let url = 'admin/api/fetch';

    try {
        let response = await fetch(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: requestBody
        });

        let textResponse = await response.text();
        let container = document.getElementById(containerName);
        
        if (!container) {
            console.warn(`⚠️ fillContainer: ${containerName} not found.`);
            return;
        }

        if (fillMode === 'fill') {
            container.innerHTML = textResponse;
        } else {
            container.innerHTML += textResponse;
        }

        console.log(`✅ fillContainer: Content updated for ${containerName}`);
    } catch (error) {
        console.error("❌ fillContainer error:", error);
    }
};

/**
 * Sends data to the server using a POST request.
 * @param {string|FormData} content - The data to send to the server.
 * @param {boolean} [formData=false] - Whether the data is FormData or not.
 * @returns {Object} The response data from the server.
 * @throws Will throw an error if the request fails.
 */
const pushRequests = async (content, formData = false) => {
    let response = await fetch('/admin/api/push', {
        method: 'POST',
        headers: formData ? {} : { 'Content-Type': 'application/json' },
        body: content
    });

    if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

    try {
        return await response.json();
    } catch {
        return { success: true }; // Return a default success object if no JSON is returned.
    }
};
