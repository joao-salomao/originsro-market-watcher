import VueRouter from 'vue-router'
import Login from './views/Login'
import Items from './views/Items'
import Alerts from './views/Alerts'
import store from './services/store'

const router = new VueRouter({
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

router.beforeEach((to, _, next) => {
    if (to.name !== 'Login' && !store.user.isAuthenticated) {
        next({ name: 'Login' })
    } else {
        next()
    }
})


export default router

