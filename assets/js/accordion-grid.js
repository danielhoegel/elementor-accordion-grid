jQuery(document).ready(function($){

    // CONFIG
    var duration = 400;
    var tabSelector = '.accordion-grid__tab';
    var selectors = {
        tab: tabSelector,
        activeTab: tabSelector + '.active',
        preview: tabSelector + '__preview',
        content: tabSelector + '__content'
    };

    // SETUP TABS
    var tabPreviews = document.querySelectorAll(selectors.preview);
    for (let i = 0; i < tabPreviews.length; i++) {
        const tabPreview = tabPreviews[i];
        const tab = tabPreview.parentNode;
        
        // set tab default size
        tab.style.height = tab.scrollHeight + 'px';
        // add tab preview click event listener
        tabPreview.addEventListener('click', function() { tabClickHandler(tab) });
    }

    /**
     * Delegate the click event
     * @param {element} tab - clicked accordion-grid__item
     */
    function tabClickHandler(tab) {
        if (tab.classList.contains('active')) {
            hideTabContent(tab);
            
        } else {
            hideTabContent(document.querySelector(selectors.activeTab));
            showTabContent(tab);
        }
    }

    /**
     * Show the content of the clicked tab
     * @param {element} tab - clicked accordion-grid__item
     */
    function showTabContent(tab) {
        if (tab) {
            tab.classList.add('active');
            var content = tab.querySelector(selectors.content);
            var contentHeight = content.scrollHeight;
            var previewHeight = tab.querySelector(selectors.preview).scrollHeight;
    
            tab.style.height = (previewHeight + contentHeight) + 'px';
            content.style.height = contentHeight + 'px';
        }
    }

    /**
     * Hie the content of the clicked tab
     * @param {element} tab - clicked accordion-grid__item
     */
    function hideTabContent(tab) {
        if (tab) {
            tab.classList.remove('active');
    
            var content = tab.querySelector(selectors.content);
            var previewHeight = tab.querySelector(selectors.preview).scrollHeight;
    
            tab.style.height = previewHeight + 'px';
            content.style.height = 0;
        }
    }
}); 