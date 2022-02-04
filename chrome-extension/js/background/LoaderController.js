class LoaderController {

    constructor() {
        this.status = "stop"
    }

    createTab(url, defaultAction) {
        let that = this

        let tabProp = {url: url, selected: false}
        console.warn("createTab:", tabProp)
         chrome.tabs.create(tabProp).then((tab) => {
            console.warn("New tab id: " + tab.id)

             setTimeout(function () {
                 messaging.send('contentCall', {defaultAction: 'yummyanime_listing'})
             }, 3000)
        })
    }

    start(source, action) {
        this.status = "start"
        this.source = source
        this.action = action
        //this.doNextLoading()
    }

    stop() {
        this.status = "stop"
    }

    loadNextListing(source) {
        source.loadNextListing();
    }

    loadNextContent(source) {
        source.loadNextContent();
    }

    doNextLoading() {
        if (this.status === "start") {
            if (this.source) {
                if (this.action === "listing") {
                    this.loadNextListing(this.source)
                }
                if (this.action === "content") {
                    this.loadNextContent(this.source)
                }
            }
        }
    }

    onLoadEnded() {
        app.getArticleSourcePageStats()
        this.doNextLoading()
    }


}