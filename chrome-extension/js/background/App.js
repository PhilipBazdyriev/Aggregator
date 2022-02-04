class App {

    lastPopupStats;

    constructor() {
        this.api = new Api()
        this.loaderConroller = new LoaderController()

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
                this.setupPopup()
            } else if (event === "startApp") {
                this.startApp()
            } else if (event === "stopApp") {
                this.stopApp()
            } else {
                console.warn("Undefined event", sender, event, data)
            }
        } else if (sender === "content") {
            if (event === "spyYummyAnimeListing") {
                app.yummyanime.handleListing(data)
            } else {
                console.warn("Undefined event", sender, event, data)
            }
        } else {
            console.warn("Undefined sender")
        }
    }

    startApp() {
        this.loaderConroller.start(this.yummyanime, "listing")
    }

    stopApp() {
        this.loaderConroller.stop()
    }

    getArticleSourcePageStats() {
        let that = this;
        this.api.get('articleSourcePage/stats', function (response) {
            if (response && response.ok) {
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
                that.lastPopupStats = that.stats
            } else {
                that.error('Not loaded stats');
            }
        });
    }

    setupPopup() {
        let source = ""
        if (this.loaderConroller.source) {
            source = this.loaderConroller.source.alias
        }
        messaging.send("setupPopup", {
            status: this.loaderConroller.status,
            action: this.loaderConroller.action,
            source: source,
            stats: this.lastPopupStats
        })
    }

}