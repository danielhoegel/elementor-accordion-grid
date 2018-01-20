jQuery(document).ready(function($){

    var duration = 400;
    var tabSelector = '.accordion-grid__tab';
    var selectors = {
        tab: tabSelector,
        activeTab: tabSelector + '.active',
        preview: tabSelector + '__preview',
        content: tabSelector + '__content'
    };


    $(document).on('click', selectors.tab, function() {
        if (this.classList.contains('active')) {
            // $(this).trigger('off');
            this.dispatchEvent(new Event('off'));
            this.classList.remove('active');
        } else {
            // $(selectors.activeTab).trigger('off');
            var activeTab = document.querySelector(selectors.activeTab);
            if (activeTab) {
                activeTab.dispatchEvent(new Event('off'));
                activeTab.addEventListener('off', function() { hideTabContent(tab) });
                activeTab.classList.remove('active');
            }
            this.classList.add('active');
            this.dispatchEvent(new Event('on'));
            // $(this).trigger('on');
        }
        });

        var tabs = document.querySelectorAll(selectors.tab);
        for (let i = 0; i < tabs.length; i++) {
            const tab = tabs[i];
            tab.addEventListener('on', function() { showTabContent(tab) });
            tab.addEventListener('off', function() { hideTabContent(tab) });
            
        }

        function showTabContent(tab) {
            console.log(tab);
            var contentHeight = tab.querySelector(selectors.content).scrollHeight;
            var previewHeight = tab.querySelector(selectors.preview).scrollHeight;
        
            $(tab.querySelector(selectors.content)).animate({
                height: contentHeight
            }, duration);
            $(tab).animate({
                height:  previewHeight + contentHeight
            }, duration);
        }

        function hideTabContent() {
            var contentHeight = tab.querySelector(selectors.content).scrollHeight;
            var previewHeight = tab.querySelector(selectors.preview).scrollHeight;

            $(tab).animate({
                height: previewHeight
            }, duration);
            $(tab.querySelector(selectors.content)).animate({
                height: 0}, duration
            );
        }
}); 