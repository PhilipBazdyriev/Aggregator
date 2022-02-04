class Source {

    constructor(alias, name) {
        this.alias = alias;
        this.name = name;
    }

    loadNextListing() {
        console.warn("NOT IMPLEMENTED: loadNextListing() for " + this.name)
    }

    loadNextContent() {
        console.warn("NOT IMPLEMENTED: loadNextContent() for " + this.name)
    }

    handleListing(data) {
        console.warn("NOT IMPLEMENTED: handleListing() for " + this.name)
    }

    handleContent(data) {
        console.warn("NOT IMPLEMENTED: handleContent() for " + this.name)
    }

}