'use strict'

const startSlideshow = (id, slideId) => {
    const diaporama = document.getElementById(id);
    const slides = diaporama.getElementsByClassName(slideId);

    if (slides.length === 0) return; // Si aucune image, ne rien faire

    let currentIndex = 0;

    const showNextSlide = () => {
        const currentSlide = slides[currentIndex];
        const nextIndex = (currentIndex + 1) % slides.length; // Calcul de l'index suivant
        const nextSlide = slides[nextIndex];

        // Préparer la prochaine image (déjà visible mais avec `opacity-0`)
        nextSlide.classList.remove("hidden");
        nextSlide.classList.add("opacity-0");

        // Déclencher simultanément le fade-out de l'actuelle et le fade-in de la prochaine
        setTimeout(() => {
            currentSlide.classList.remove("opacity-100");
            currentSlide.classList.add("opacity-0");

            nextSlide.classList.remove("opacity-0");
            nextSlide.classList.add("opacity-100");
        }, 0); // Pas de délai, chevauchement immédiat

        // Masquer complètement l'image actuelle après la transition
        setTimeout(() => {
            currentSlide.classList.add("hidden");
        }, 1000); // Durée égale à la transition CSS (1 seconde)

        // Met à jour l'index actuel
        currentIndex = nextIndex;
    };

    // Affiche immédiatement la première image
    slides[currentIndex].classList.remove("opacity-0", "hidden");
    slides[currentIndex].classList.add("opacity-100");

    // Démarrer le défilement automatique
    setInterval(showNextSlide, 5000); // Change toutes les 5 secondes
};

document.addEventListener("DOMContentLoaded", () => {
    startSlideshow('slideshow-settings-container', 'slides-settings');
    startSlideshow('slideshow-desktop-container', 'slides-desktop');
});

const manageSnackbar = (data, mode) => {
    let snackbar = new ZafkielSnackbar();

    return (mode === 'alter') ? snackbar.alter(data) : snackbar.init(data);
}

const displayResults = (e) => {
    e.preventDefault();

    let input = (e.target.name === 'form') ? e.target[0] : e.target,
        modulesList = document.getElementById('services-list'),
        modulesContainer = document.getElementById('services-container');

    clearNode(document.querySelector('#services-container'));

    for (let i = 0; i < modulesList.children.length; i++)
    {
        if (modulesList.children[i].value.toLowerCase().indexOf(input.value.toLowerCase()) > -1 || modulesList.children[i].textContent.toLowerCase().indexOf(input.value.toLowerCase()) > -1)
        {
            let module = {
                "alias": modulesList.children[i].value,
                "name": modulesList.children[i].textContent,
                "path": modulesList.children[i].dataset.path
            }

            modulesContainer.appendChild(createModuleNode(module));

        }
    }

}

const clearNode = node => {
    while (node.firstChild) {
        node.removeChild(node.lastChild);
    }
}

const createModuleNode = (module) => {

    let div = document.createElement('div'),
        img = document.createElement('img'),
        p   = document.createElement('p');
    
    div.classList.add('p-4');
    div.onclick = function(evt) {
        displayModule(evt, module['alias']);
    }

    img.classList.add('block', 'w-28', 'h-28', 'mx-auto', 'rounded-full');
    img.src = module['path'];
    img.alt = "Icon for service: " + module['name'];

    p.classList.add('font-semibold', 'text-center', 'mt-2', 'text-lg');
    p.textContent = module['name'];

    div.appendChild(img);
    div.appendChild(p);

    return div;
}

const displayModule = (e, module) => {
    let modules = document.getElementsByClassName('module'),
        i;

    for (i = 0; i < modules.length; i++)
    {
        modules[i].style.display = 'none';
    }

    document.getElementById(module).style.display = 'block';
}

const displayTab = (e, tabType, tab) => {
    console.log('Tab opened: ' + tab);
    let tabContent = document.getElementsByClassName(tabType + '-tab-content'),
        i;

    for (i = 0; i < tabContent.length; i++)
    {
        tabContent[i].style.display = 'none';
    }

    document.getElementById(tab).style.display = 'block';
}

const toggleElementDisplay = (el, display) => {
    console.log('here', el, display);
    el.style.display = (el.style.display === display) ? 'none' : display;
}

const openModal  = (modalName, option, adminName, apiKey) => {
    let modal    = document.getElementById(modalName),
    closeModal   = document.getElementById('close-' + modalName),
    requestBody  = "options=" + option + "&admin=" + adminName + "&api_key=" + apiKey,
    modalBoxName = modalName + '-content';
    
    // data-field would be used for if it's admins, or admins-settings, profile, etc.
    fillContainer(modalBoxName, requestBody, 'fill');

    modal.style.display = 'flex';

    closeModal.onclick = function() {
        modal.style.display = 'none';
        modalOpened = false;
    }
}

const fillContainer = async (containerName, requestBody, fillMode) => {
    let url = 'admin/api/fetch';

    console.log(fillMode, containerName);

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
        return { success: true };
    }
};