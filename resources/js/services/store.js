import Vue from 'vue'
import api from './api'

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
        getUser() {
            this.user.isLoading = true
            api.get('api/user/current').then(resp => {
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
