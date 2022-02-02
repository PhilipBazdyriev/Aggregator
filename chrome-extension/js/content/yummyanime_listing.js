
alert(123);

var port = chrome.runtime.connect({name: "knockknock"});
port.postMessage({joke: "Im tab"});
port.onMessage.addListener(function(msg) {
    console.log("onMessage", msg);
});