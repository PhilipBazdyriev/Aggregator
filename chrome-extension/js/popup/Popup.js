class Popup {

    constructor() {
        this.view = new View()
    }

    start() {
        messaging.send("inited")
    }

    onEvent(sender, event, data) {
        console.log("onMessage", sender, event, data)
        if (sender === "background") {
            if (event === "updateSourceStats") {
                this.view.updateSourceStats(data)
            } else {
                console.warn("Undefined event", sender, event, data)
            }
        } else {
            console.warn("Undefined sender")
        }
    }

}