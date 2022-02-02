class PopupPort extends Port {

    constructor() {
        super();
        let that = this;

        chrome.runtime.onConnect.addListener(function(port) {
            console.assert(port.name === "aggregator")
            that.port = port
            port.onMessage.addListener(function(message) {
                that.onEvent(message.event, message.data)
            });
        });
    }

    onEvent(event, data) {
        console.log("onEvent [Popup > Background]", event, data)
    }

    send(event, data) {
        this.port.postMessage({
            event: event,
            data: data
        });
    }

}


