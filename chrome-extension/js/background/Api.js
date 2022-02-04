class Api {

    get(action, callback) {
        this.request("GET", action, null, callback)
    }

    post(action, data, callback) {
        this.request("POST", action, data, callback)
    }

    /*
    request(method, action, data, callback) {
        let url = 'http://aggregator.local/api/' + action;
        $.ajax(url, {
            data : JSON.stringify(data),
            contentType : 'application/json',
            type : method,
            //url: 'username:password@link to the server/update',
            dataType: 'json',
            async: true,
            success: function (response) {
                callback(response)
            }
        })
    }
    */

    async request(method, action, data, callback) {
        console.warn("API request:", method, action, data)
        let url = 'http://aggregator.local/api/' + action;

        try {
            let init = null;
            if (data) {
                init = {
                    method: method,
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            }
            const response = await fetch(url, init);
            const json = await response.json();
            console.warn("API response:", json)
            callback(json);
        } catch (error) {
            console.error('API error:', error);
            if (error.message === 'Failed to fetch') {
                messaging.send('statusError', "Server not accessible")
            }
            callback();
        }
    }

}