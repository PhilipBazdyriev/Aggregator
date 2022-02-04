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
            } else if (event === "setupPopup") {
                this.setupPopup(data)
            } else if (event === "statusError") {
                this.view.error(data)
            } else {
                console.warn("Undefined event", sender, event, data)
            }
        } else {
            console.warn("Undefined sender")
        }
    }

    setupPopup(data) {
        if (data.status === "start") {
            this.view.setExecutionMode()
        } else if (data.status === "stop") {
            this.view.setIdleMode()
        }
        if (data.stats) {
            this.view.updateSourceStats(data.stats)
        }

        $('#source option[value=' + data.source + ']').prop('selected', true);
        $('#action option[value=' + data.action + ']').prop('selected', true);
    }

}