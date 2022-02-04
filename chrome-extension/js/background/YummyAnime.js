class YummyAnime extends Source {

    constructor() {
        super("yummyanime", "YummyAnime");
        this.listLastPage = 0;
    }

    loadNextListing() {
        let page = this.getListingNextPage();
        let url = this.getListingUrl(page)
        app.loaderConroller.createTab(url, "yummyanime_listing")
    }

    loadNextContent() {

    }

    handleListing(data) {
        console.log("UPLOAD URLS", data.urls)
        chrome.storage.yummyanime.pageCount = data.pageCount
        let request = [];
        for (let key in data.urls) {
            let url = "https://yummyanime.club" + data.urls[key]
            request.push({
                source_alias: this.alias,
                type: "anime",
                url: url
            })
        }
        api.post('articleSourcePage/list', request, function (reponse) {
            console.log("reponse from articleSourcePage/list", reponse)
            if (reponse.ok) {
                app.loaderConroller.onLoadEnded()
            }
        })
    }

    handleContent(data) {

    }

    //---------------------------

    getListingUrl(page) {
        return "https://yummyanime.club/filter?status=-1&season=0&from_year=&to_year=&from_num_episodes=&to_num_episodes=&selected_age=0&sort=5&sort_order=0&page=" + page;
    }

    getListingNextPage() {
        if (!chrome.storage.yummyanime) {
            chrome.storage.yummyanime = {
                lastPage: 0,
                pageCount: 0
            }
        }
        chrome.storage.yummyanime.lastPage++
        if (chrome.storage.yummyanime.lastPage > chrome.storage.yummyanime.pageCount) {
            chrome.storage.yummyanime.lastPage = 1
        }
        return chrome.storage.yummyanime.lastPage
    }

}