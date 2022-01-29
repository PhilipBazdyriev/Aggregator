class RestApi {

    constructor() {

    }

    get(method, callback) {
        this.request('GET', method, false, callback);
    }

    post(method, data, callback) {
        this.request('POST', method, data, callback);
    }

    put(method, data, callback) {
        this.request('PUT', method, data, callback);
    }

    delete(method, callback) {
        this.request('DELETE', method, false, callback);
    }

    async request(http_method, api_method, data, callback) {

        let url = '/api/' + api_method;
        let init = {
            method: http_method,
            //body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };
        if (data) {
            init.body = JSON.stringify(data)
        }

        try {
            const response = await fetch(url, init);
            const json = await response.json();
            if (callback) {
                callback(json);
            }
        } catch (error) {
            console.error('Ошибка:', error);
            callback(error);
        }

    }

}

const restApi = new RestApi();