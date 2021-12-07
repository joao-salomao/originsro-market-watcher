import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueRouter from 'vue-router'
import CompositionAPI from '@vue/composition-api'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'


Vue.config.productionTip = false

Vue.use(VueRouter)
Vue.use(CompositionAPI)
Vue.use(BootstrapVueIcons)
Vue.use(BootstrapVue, {
  BToast: {
    solid: true,
    toaster: "b-toaster-top-right",
  }
})

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
