require('./bootstrap');
import Vue from 'vue'
import vuetify from './plugins/vuetify'
import router from './routes/index'
import App from './App.vue'
import store from './store'


import Main from './layouts/Main.vue'

Vue.config.productionTip = false
Vue.component('main-layout', Main)
new Vue({
  vuetify,
  store,
  router,
  render: h => h(App)
}).$mount('#app')