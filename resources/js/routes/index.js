import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../pages/Home.vue'

Vue.use(VueRouter)


let routes = [
  {
    path: '/',
    name: 'Home',
    meta:{
      layout:'main'
    },
    component: Home
  }
]

let router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})


export default router
