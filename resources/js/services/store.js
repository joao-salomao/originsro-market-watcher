import Vue from 'vue'
import http from './http'

export default new Vue({
    data: {
        user: {
            data: null,
            isLoading: true,
            isAuthenticated: localStorage.getItem('token') !== null
        }
    },
    created() {
        if (this.user.isAuthenticated) {
            this.getUser()
        }
    },
    methods: {
        clearUser() {
            this.user.data = null
            this.user.isAuthenticated = null
            localStorage.clear()
        },
        getUser() {
            this.user.isLoading = true
            http.get('api/user/current').then(resp => {
                this.user = {
                    ...this.user,
                    data: resp.data
                }
            })
                .finally(() => {
                    this.user.isLoading = false
                })
        }
    }
})
