import Vue from 'vue'
import api from './api'

export default new Vue({
    data: {
        user: {
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
        getUser() {
            this.user.isLoading = true
            api.get('api/user/current').then(resp => {
                this.user = {
                    ...this.user,
                    ...resp.data
                }
            })
                .finally(() => {
                    this.user.isLoading = false
                })
        }
    }
})
