class ZafkielFrontend
{
    openModal(modalId)
    {
        let targetedModal = document.getElementById(modalId);
        targetedModal.style.display = 'block';

        document.getElementById('close-' + modalId).onclick = () => targetedModal.style.display = 'none';
        
        return {
            'openedAt': Date.now(),
            'obj': this,
            'state': this.#getState(modalId)
        }
    }

    openTab(tablinks, tabcontent, tabName)
    {
        let tablinksNodes = document.getElementsByClassName(tablinks),
            tabcontentNodes = document.getElementsByClassName(tabcontent),
            i;

        for(i = 0; i < tablinksNodes.length; i++)
        {
            tablinksNodes[i].classList.remove("slideshow-tab-active");
        }

        for(i = 0; i < tabcontentNodes.length; i++)
        {
            tabcontentNodes[i].style.display = 'none';
        }

        let targetedTab = document.getElementById(tabName);
        console.log(targetedTab);
        targetedTab.style.display = 'block';

        return {
            'tab': targetedTab,
            'obj': this
        };
    }
    
    fill(nodeId, data)
    {
        document.getElementById(nodeId).innerHTML = data;
    }

    #getState(nodeId)
    {
        return {
            'open': () => document.getElementById(nodeId).style.display = 'block',
            'close': () => document.getElementById(nodeId).style.display = 'none'
        }
    }
}