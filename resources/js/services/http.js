import axios from 'axios'

const instance = axios.create()

export function setAuthorizationHeader() {
    const token = localStorage.getItem("token")
    instance.defaults.headers["Authorization"] = token
}


setAuthorizationHeader()

export default instance
