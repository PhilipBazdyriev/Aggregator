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

    setStatus(data, elementClass = '') {
        $(".status-bar").html('<span class="' + elementClass + '"><b>Error</b> ' + JSON.stringify(data) + '</span>')
    }

    error(data) {
        this.setStatus(data, 'error')
    }

    warning(data) {
        this.setStatus(data, 'warning')
    }

    log(data) {
        this.setStatus(data, 'log')
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

}