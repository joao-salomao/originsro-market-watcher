import VueRouter from 'vue-router'
import Items from './views/Items'
import Alerts from './views/Alerts'

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Items
        },
        {
            path: '/alerts',
            component: Alerts
        }
    ],
})
