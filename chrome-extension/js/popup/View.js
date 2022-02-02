class View {

    constructor() {
        this.bindListeners()
        //this.showLoadFrame()
        this.setIdleMode()
    }

    bindListeners() {
        let that = this;
        $("#btn-start").click(function() {
            that.startApp();
        });
        $("#btn-stop").click(function() {
            that.stopApp();
        });
        $("#test1").click(function() {

        });
        $("#test2").click(function() {

        });
    }

    startApp() {
        this.setExecutionMode()
        messaging.send("startApp")
    }

    stopApp() {
        this.setIdleMode()
        messaging.send("stopApp")
    }

    setStatus(data) {
        $(".status-bar").html(JSON.stringify(data));
    }

    error(data) {
        this.setStatus('<span class="error"><b>Error</b> ' + data + '</span>')
    }

    warning(data) {
        this.setStatus('<span class="warning"><b>Warning</b> ' + data + '</span>')
    }

    log(data) {
        this.setStatus('<span class="log">' + data + '</span>')
    }

    setExecutionMode() {
        $("#btn-start").hide();
        $("#btn-stop").show();
    }

    setIdleMode() {
        $("#btn-start").show();
        $("#btn-stop").hide();
    }

    updateSourceStats(stats) {
        $("#source-table").find("tbody").text("");
        for (let source in stats) {
            let data = stats[source];
            let trHtml = "";
            for (let key in data) {
                trHtml += "<td id='" + key + "'>" + data[key] + "</td>";
            }
            trHtml = "<tr>" + trHtml + "</tr>";
            $("#source-table").find("tbody").append(trHtml);
        }
    }

    showLoadFrame()
    {
        $("#loadFrame").show()
    }

}