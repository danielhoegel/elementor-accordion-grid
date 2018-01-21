jQuery(document).ready(function($){

    var duration = 400;
    var tabSelector = '.accordion-grid__tab';
    var selectors = {
        tab: tabSelector,
        activeTab: tabSelector + '.active',
        preview: tabSelector + '__preview',
        content: tabSelector + '__content'
    };

    var tabPreviews = document.querySelectorAll(selectors.preview);
    for (let i = 0; i < tabPreviews.length; i++) {
        const tabPreview = tabPreviews[i];
        const tab = tabPreview.parentNode;
        tabPreview.addEventListener('click', function() { tabClickHandler(tab) });
        tab.addEventListener('on', function() { showTabContent(tab) });
        tab.addEventListener('off', function() { hideTabContent(tab) });
    }

    function tabClickHandler(tab) {
        if (tab.classList.contains('active')) {
            tab.dispatchEvent(new Event('off'));
            tab.classList.remove('active');
        } else {
            var activeTab = document.querySelector(selectors.activeTab);
            if (activeTab) {
                activeTab.dispatchEvent(new Event('off'));
                activeTab.classList.remove('active');
            }
            tab.classList.add('active');
            tab.dispatchEvent(new Event('on'));
        }
    }

    function showTabContent(tab) {
        var content = tab.querySelector(selectors.content);
        var contentHeight = content.scrollHeight;
        var previewHeight = tab.querySelector(selectors.preview).scrollHeight;
    
        $(content).animate({
            height: contentHeight
        }, duration);
        $(tab).animate({
            height:  previewHeight + contentHeight
        }, duration);
    }

    function hideTabContent(tab) {
        var content = tab.querySelector(selectors.content);
        var previewHeight = tab.querySelector(selectors.preview).scrollHeight;

        $(tab).animate({
            height: previewHeight
        }, duration, function() {
            tab.style.height = 'auto';
        });
        $(content).animate({
            height: 0
        }, duration
        );
    }
}); 