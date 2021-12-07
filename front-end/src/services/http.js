import axios from 'axios'

const instance = axios.create({
    baseURL: process.env.VUE_APP_API_URL
})

const http = {
    login(email, password) {
        return instance
            .post("/oauth/token", {
                client_id: "2",
                grant_type: "password",
                username: email,
                password: password,
                client_secret: "7BLSkwTZL3ydEQlQZDjfTvuHPyrOjFeHJNZkt0ZP",
            })
    },
    getAuthUser() {
        return instance.get('api/users/current')
    },
    getApiRoutes() {
        return instance.get("api/routes")
    },
    getItems(params) {
        return instance
            .get("api/items", {
                params,
            })
    },
    createAlert(data) {
        return instance.post("api/alerts", data)
    },
    updateAlert(alertId, data) {
        return instance
            .patch(`api/alerts/${alertId}`, data)
    },
    deleteAlert(alertId) {
        return instance.delete(`api/alerts/${alertId}`)
    },
    getAlerts() {
        return instance.get("api/alerts")
    },
    setAuthorizationHeader() {
        const token = localStorage.getItem("token")
        instance.defaults.headers["Authorization"] = token
    }
}

http.setAuthorizationHeader()

export default http
