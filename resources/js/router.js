import VueRouter from 'vue-router'
import Login from './views/Login'
import Items from './views/Items'
import Alerts from './views/Alerts'
// import Register from './views/Register'
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
            path: '/items',
            name: 'Items',
            component: Items,
            meta: { requiresAuth: true }
        },
        // {
        //     path: '/register',
        //     name: 'Register',
        //     component: Register
        // },
        {
            path: '/alerts',
            name: 'Alerts',
            component: Alerts,
            meta: { requiresAuth: true }
        }
    ],
})

router.beforeEach((to, _, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) && !store.user.isAuthenticated) {
        next({ name: 'Login' })
    } else if (!to.name) {
        next({ name: 'Items' })
    } else {
        next()
    }
})


export default router

