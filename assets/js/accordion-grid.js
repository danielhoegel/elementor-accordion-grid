document.addEventListener("DOMContentLoaded", function() {

    // CONFIG
    var duration = 400;
    var tabSelector = '.accordion-grid__tab';
    var selectors = {
        grid: '.accordion-grid',
        tab: tabSelector,
        activeTab: tabSelector + '.active',
        preview: tabSelector + '__preview',
        previewInside: tabSelector + '__preview__inside',
        content: tabSelector + '__content'
    };

    // SETUP GRIDS
    var initAccordionGrid = (function() {
        var grids = document.querySelectorAll(selectors.grid);
        if (grids.length > 0) {
            for (var i = 0; i < grids.length; i++) {
                setupGrid(grids[i]);  
            }
        }
    })();


    /**
     * Setup a grid
     * @param {element} grid 
     */
    function setupGrid(grid) {
        var tabs = grid.children;
        if (tabs.length > 0) {
            var previewHeight = maxPreviewHeight(tabs[0]);
            var tabHeight = getTabAutoHeight(tabs[0], previewHeight);
            
            for (var i = 0; i < tabs.length; i++) {
                setupTab(tabs[i], previewHeight, tabHeight)
            }
        }
    }


    /**
     * Setup a tab
     * @param {element} tab
     * @param {number} previewHeight 
     * @param {number} tabHeight 
     */
    function setupTab(tab, previewHeight, tabHeight) {
        var tabPreview = tab.querySelector(selectors.preview);
        // set tab default size
        tab.style.height = numToPx(tabHeight);
        tabPreview.style.height = numToPx(previewHeight);
        // add tab preview click event listener
        tabPreview.addEventListener('click', tabClickHandler);
        tabPreview.tab = tab;
    }


    /**
     * Delegate the click event
     * @param {element} tab - clicked accordion-grid__tab
     */
    function tabClickHandler() {
        var tab = this.tab;
        if (tab.classList.contains('active')) {
            hideTabContent(tab);
            
        } else {
            hideTabContent(document.querySelector(selectors.activeTab));
            showTabContent(tab);
        }
    }


    /**
     * Show the content of the clicked tab
     * @param {element} tab - clicked accordion-grid__tab
     */
    function showTabContent(tab) {
        if (tab) {
            tab.classList.add('active');

            var content = tab.querySelector(selectors.content);
            var contentHeight = content.scrollHeight;
            var previewHeight = maxPreviewHeight(tab);
            
            content.style.height = numToPx(contentHeight);
            tab.style.height = numToPx(previewHeight + contentHeight);
        }
    }


    /**
     * Hide the content of the clicked tab
     * @param {element} tab - clicked accordion-grid__tab
     */
    function hideTabContent(tab) {
        if (tab) {
            // reset tab height and class
            tab.classList.remove('active');
            tab.style.height = numToPx(getTabAutoHeight(tab));
            
            // set content height to 0
            var content = tab.querySelector(selectors.content);
            content.style.height = 0;
            
        }
    }


    /**
     * Adjust heights on window resize
     */
    window.addEventListener('resize', function() {
        var grids = document.querySelectorAll(selectors.grid);
        if (grids.length > 0) {
            for (var i = 0; i < grids.length; i++) {
                var tabs = grids[i].querySelectorAll(selectors.tab);
                if (tabs.length > 0) {
                    var previewHeight = maxPreviewHeight(tabs[0]);
                    var tabHeight = getTabAutoHeight(tabs[0], previewHeight);
            
                    for (var j = 0; j < tabs.length; j++) {
                        var tab = tabs[j];
            
                        // tab preview height
                        // tab.querySelector(selectors.preview)
                        //    .style.height = numToPx(previewHeight);
            
                        if (tab.classList.contains('active')) {
                            var content = tab.querySelector(selectors.content);
                            var contentHeight = content.scrollHeight;
                        
                            // active tabs height
                            content.style.height = numToPx(contentHeight);
                            tab.style.height = numToPx(tabHeight + contentHeight);
                        } else {
                            // inactive tabs height
                        tab.style.height = numToPx(tabHeight);
                        }
                    }
                }
            }
        }
    })


    /**
     * Get default/auto height of the tab
     * @param {element} tab - target to get the padding
     */
    function getTabAutoHeight(tab, previewHeight) {
        var compStyle = window.getComputedStyle(tab);
        var paddingTop = parseInt(compStyle.getPropertyValue('padding-top').split('px')[0]);
        var paddingBottom = parseInt(compStyle.getPropertyValue('padding-bottom').split('px')[0]);
        var previewHeight = previewHeight ? previewHeight : maxPreviewHeight(tab);

        return previewHeight + paddingTop + paddingBottom;
    }


    /**
     * Get default/auto height of the tab
     * @param {element} tab - target to get the parent accordion grid
     */
    function maxPreviewHeight(tab) {
        var maxPreviewHeight = 0;
        var allTabs = tab.parentNode.querySelectorAll(selectors.tab);
        for(var i = 0; i < allTabs.length; i++) {
            var previewHeight = allTabs[i].querySelector(selectors.previewInside).scrollHeight; // clientHeight ignores :after
            if (previewHeight > maxPreviewHeight) {
                maxPreviewHeight = previewHeight;
            }
        };
        return maxPreviewHeight;
    }


    /**
     * Return the number as a string with the px unit at the end
     * @param {int} number 
     */
    function numToPx(number) {
        return number + 'px';
    }

}); 
