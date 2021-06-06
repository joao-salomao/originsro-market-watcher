import Vue from 'vue'
export default new Vue({
    data: {
        user: {
            isAuthenticated: localStorage.getItem('token') !== null
        }
    }
})
