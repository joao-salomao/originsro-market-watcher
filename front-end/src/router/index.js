import VueRouter from 'vue-router'
import store from '../services/store'

const Login = () => import('../views/Login')
const Items = () => import('../views/Items/List')
const Alerts = () => import('../views/Alerts')
const RoutesAPI = () => import('../views/RoutesAPI')

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/items',
            name: 'items',
            meta: { requiresAuth: true },
            component: Items,
        },
        // {
        //     path: '/register',
        //     name: 'Register',
        //     component: Register
        // },
        {
            path: '/alerts',
            name: 'alerts',
            meta: { requiresAuth: true },
            component: Alerts,
        },
        {
            path: '/routes',
            name: 'routes',
            meta: { requiresAuth: true },
            component: RoutesAPI,
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

