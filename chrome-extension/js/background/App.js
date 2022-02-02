class App {

    constructor() {
        this.api = new Api()
/*
        this.loaderConroller = new LoaderController()
*/

        this.yummyanime = new YummyAnime();
        this.shikimori = new Shikimori();
        this.sources = [this.yummyanime, this.shikimori];

        this.stats = {}
        for (let key in this.sources) {
            let source = this.sources[key]
            this.stats[source.alias] = {
                name: source.name,
                asp_scanned: 0,
                asp_not_scanned: 0,
                new_listing: 0,
                new_content: 0,
            }
        }

    }

    onEvent(sender, event, data) {
        if (sender === "popup") {
            if (event === "inited") {
                this.getArticleSourcePageStats()
            } else if (event === "startApp") {

            } else if (event === "stopApp") {

            } else {
                console.warn("Undefined event", sender, event, data)
            }
        } else if (sender === "content") {
            /*
            if (event == "updateSourceStats") {

            } else {
                console.warn("Undefined event", sender, event, data)
            }
            */
        } else {
            console.warn("Undefined sender")
        }
    }

/*
    start() {
        this.view.setExecutionMode()
        this.loaderConroller.loadListing(this.yummyanime)
    }

    stop() {
        this.view.setIdleMode()
    }*/


    getArticleSourcePageStats() {
        let that = this;
        this.api.get('articleSourcePage/stats', function (response) {
            if (response.ok) {
                for (let source in response.sources) {
                    if (that.stats[source]) {
                        let data = response.sources[source]
                        that.stats[source].asp_scanned = data.scanned
                        that.stats[source].asp_not_scanned = data.not_scanned
                    } else {
                        that.error('Undefined source: ' + source);
                    }
                }
                messaging.send("updateSourceStats", that.stats)
            } else {
                that.error('Not loaded stats');
            }
        });
    }

}