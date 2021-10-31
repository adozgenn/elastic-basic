import axios from 'axios'
import store from '../store'
// import router from '../routes'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

axios.interceptors.request.use(request => {
    if(store.getters.authToken){
        request.headers.common['Authorization'] = `Bearer ${store.getters.authToken}`
    }

    return request
})
// the main point is in the loop
// once login ==>take token ==> save it ==> return user ==>
// save both user and token ==> all done with axios

// vuex
// vuex-persistedstate
// js-cookie