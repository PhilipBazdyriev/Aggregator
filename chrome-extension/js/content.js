/*
let pages = $(".pagination li[data-pos]").last().text();

console.log("start")
var port = chrome.runtime.connect({name: "knockknock"});
port.postMessage({pages: pages});
port.onMessage.addListener(function(msg) {
    console.log("onMessage", msg)
    if (msg.question === "Who's there?")
        port.postMessage({answer: "Madame"});
    else if (msg.question === "Madame who?")
        port.postMessage({answer: "Madame... Bovary"});
});
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
            sender: "content",
            event: event,
            data: data
        });
    }

}

const port = new Port()

console.log("inited")
*/

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
            sender: "content",
            event: event,
            data: data
        });
    }

}

class Content {

    constructor() {

    }

    onEvent(sender, event, data) {
        console.log("onMessage", sender, event, data)
        if (sender === "background") {
            if (event === "contentCall") {
                console.log("==contentCall")
                if (data.defaultAction == 'yummyanime_listing') {
                    yummyanime_listing()
                }
            }
        } else {
            console.warn("Undefined sender")
        }
    }

}


const content = new Content();

const messaging = new Messaging(content)
var port = chrome.runtime.connect({name: "knockknock"});
port.onMessage.addListener(function(msg) {
    messaging.onMessage(msg)
});
messaging.setPort(port)
