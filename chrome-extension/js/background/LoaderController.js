class LoaderController {

    constructor() {
        let that = this;
        /*
        $("#loadFrame").on("load", function () {
            alert('on load');
            that.onPageLoad()
        });
        */
        /*
        chrome.tabs.onCreated.addListener(function (event) {
            console.log("chrome.tabs.onCreated.addListener", event)
            view.log('tab loaded: ' + event.id)
            chrome.tabs.executeScript(event.id, {file: '/js/jquery-3.1.1.min.js'})
            chrome.tabs.executeScript(event.id, {file: '/js/content/yummyanime_listing.js'})
        })
        */
    }

    createTab(url, callback) {
        let that = this
        /*
        chrome.tabs.create({url: "/my-page.html"}).then(() => {
            browser.tabs.executeScript({
                code: `console.log('location:', window.location.href);`
            });
        });
        */
        chrome.tabs.create({url: url, selected: false}).then((tab) => {

            view.warning("New tab id: " + tab.id)

            chrome.scripting.executeScript({
                target: {tabId: tab.id},
                files: ['/js/jquery-3.1.1.min.js', '/js/content/yummyanime_listing.js']
            });

            chrome.tabs.executeScript({
                target: {tabId: tab.id},
                code: `alert('location:', window.location.href);`
            });

        });
    }

    loadPage(url, callback) {
        //this.onLoadCallback = callback;

        this.createTab(url, callback)
    }
/*
    onPageLoad() {
        view.log("Url loaded: " + $("#loadFrame").attr("src"))
        if (this.onLoadCallback) {
            this.onLoadCallback();
            this.onLoadCallback = null;
        }
    }
*/
    run() {

    }

    loadListing(source) {
        source.loadListing();
    }

    loadContent(source) {
        source.loadContent();
    }

    select(query) {
        return $("#loadFrame").contents().find(query);
    }

}