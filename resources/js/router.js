import VueRouter from 'vue-router'
import Login from './views/Login'
import Items from './views/Items'
import Alerts from './views/Alerts'

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            name: 'Items',
            component: Items
        },
        {
            path: '/alerts',
            name: 'Alerts',
            component: Alerts
        }
    ],
})
