import Vue from 'vue'
import api from "./api";

export default new Vue({
    data() {
        const token = localStorage.getItem('token')
        return {
            user: {
                token,
                isAuthenticated: token !== null
            }
        }
    },
    watch: {
        'user.token': function (newValue) {
            localStorage.setItem("token", newValue);
            api.defaults.headers.common["Authorization"] = newValue;
            this.user.isAuthenticated = newValue !== null;
        }
    }
})
