/*
console.log("start")
var port = chrome.runtime.connect({name: "knockknock"});
port.onMessage.addListener(function(msg) {
    console.log("onMessage", msg)
    if (msg.question === "Who's there?")
        port.postMessage({answer: "Madame"});
    else if (msg.question === "Madame who?")
        port.postMessage({answer: "Madame... Bovary"});
});
port.postMessage({answer: "Madame"});
console.log("inited")
*/

/*
class Port {

    constructor() {
        this.connect()
    }

    connect() {
        let that = this
        this.port = chrome.runtime.connect({name: "knockknock"});
        this.port.onMessage.addListener(function(msg) {
            that.onMessage(msg.sender, msg.event, msg.data)
        });
    }

    onMessage(sender, event, data) {
        console.log("onMessage", sender, event, data)
    }

    send(event, data) {
        this.port.postMessage({
            sender: "popup",
            event: event,
            data: data
        });
    }

}
*/


const popup = new Popup()

class Messaging {

    constructor(onEventListener) {
        this.onEventListener = onEventListener
    }

    onMessage(msg) {
        this.onEvent(msg.sender, msg.event, msg.data)
    }

    setPort(port) {
        this.port = port
    }

    onEvent(sender, event, data) {
        console.warn("onEvent:", [sender, event, data])
        if (this.onEventListener) {
            this.onEventListener.onEvent(sender, event, data)
        }
    }

    send(event, data) {
        this.port.postMessage({
            sender: "popup",
            event: event,
            data: data
        });
    }
}

const messaging = new Messaging(popup)
var port = chrome.runtime.connect({name: "knockknock"});
port.onMessage.addListener(function(msg) {
    messaging.onMessage(msg)
});
messaging.setPort(port)

popup.start()