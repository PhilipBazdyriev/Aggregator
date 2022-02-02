/*
let mport = null;
console.log("start")
chrome.runtime.onConnect.addListener(function(port) {
    console.assert(port.name === "knockknock");
    mport = port
    port.onMessage.addListener(function(msg) {
        console.log("onMessage", msg)
        if (msg.joke === "Knock knock")
            port.postMessage({question: "Who's there?"});
        else if (msg.answer === "Madame")
            port.postMessage({question: "Madame who?"});
        else if (msg.answer === "Madame... Bovary")
            port.postMessage({question: "I don't get it."});
    });
});
console.log("inited")
*/

try {
    importScripts('/js/background/Api.js')
    importScripts('/js/background/App.js')
    importScripts('/js/background/LoaderController.js')
    importScripts('/js/background/Source.js')
    importScripts('/js/background/Shikimori.js')
    importScripts('/js/background/YummyAnime.js')
} catch (error) {
    console.error(error);
}

/*
class Port {

    constructor() {
        this.connect()
        this.port = "na"
    }

    connect() {
        console.warn("connect")
        let that = this
        chrome.runtime.onConnect.addListener(function(port2) {
            console.warn("onConnect.addListener")
            console.assert(port.name === "knockknock");
            port2.onMessage.addListener(function(msg) {
                that.onMessage(msg.sender, msg.event, msg.data)
            });
            that.port3 = port2
        });
    }

    onMessage(sender, event, data) {
        console.log("onMessage", sender, event, data)
    }

    send(event, data) {
        console.warn("send")
        console.log("this.port", this.port)
        this.port.postMessage({
            sender: "background",
            event: event,
            data: data
        });
    }

}
 */


class Messaging {

    constructor(onEventListener) {
        this.onEventListener = onEventListener
        this.ports = []
    }

    onMessage(msg) {
        console.log("onMessage", msg)
        this.onEvent(msg.sender, msg.event, msg.data)
    }

    addPort(port) {
        this.ports.push(port)
    }

    onEvent(sender, event, data) {
        console.log("onEvent", sender, event, data)
        this.send("feedback", "i see you " + sender)
        if (this.onEventListener) {
            console.log("onEvent this.onEventListener", this.onEventListener)
            this.onEventListener.onEvent(sender, event, data)
        }
    }

    send(event, data) {
        for (let key in this.ports) {
            let port = this.ports[key]
            port.postMessage({
                sender: "background",
                event: event,
                data: data
            });
        }
    }

}

const app = new App()

const messaging = new Messaging(app)
chrome.runtime.onConnect.addListener(function(port) {
    port.onMessage.addListener(function(msg) {
        messaging.onMessage(msg)
    });
    messaging.addPort(port)
});