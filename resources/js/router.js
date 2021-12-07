import VueRouter from 'vue-router'
import Login from './views/Login'
import Items from './views/Items'
import Alerts from './views/Alerts'
import RoutesAPI from './views/RoutesAPI'
// import Register from './views/Register'
import store from './services/store'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/items',
            name: 'items',
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
            name: 'alerts',
            component: Alerts,
            meta: { requiresAuth: true }
        },
        {
            path: '/routes',
            name: 'routes',
            component: RoutesAPI,
            meta: { requiresAuth: true }
        }
    ],
})

router.beforeEach((to, _, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) && !store.user.isAuthenticated) {
        next({ name: 'login' })
    } else if (!to.name) {
        next({ name: 'items' })
    } else {
        next()
    }
})


export default router

