class YummyAnime extends Source {

    constructor() {
        super("yummyanime", "YummyAnime");
        this.listLastPage = 0;
    }

    loadListing() {
        view.log("loadListing")
        let page = 1;
        let url = this.getListingUrl(page)
        // view.log("url: " + url)
        app.loaderConroller.loadPage(url, function () {
            // this.listLastPage = background.loaderConroller.select(".pagination li[data-pos]").last().text()
            // view.log(this.listLastPage)
        })
    }

    loadContent() {

    }

    getListingUrl(page) {
        return "https://yummyanime.club/filter?status=-1&season=0&from_year=&to_year=&from_num_episodes=&to_num_episodes=&selected_age=0&sort=5&sort_order=0&page=" + page;
    }

}