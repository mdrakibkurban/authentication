import { createWebHistory, createRouter } from 'vue-router'

import store from '../store/store.js'

import Home from '../blog/Home.vue'
import About from '../blog/About.vue'
import Login from '../blog/Login.vue'
import Register from '../blog/Register.vue'
import Logout from '../blog/Logout.vue'

const routes = [
    { path: '/', name:'home', component: Home, meta: { requiresAuth: true } },
    { path: '/about', name:'about', component: About, meta: { requiresAuth: true } },
    { path: '/login', name:'login', component: Login, meta: { visitor: true } },
    { path: '/register', name:'register', component: Register, meta: { visitor: true } },
    { path: '/logout', name:'logout', component: Logout , meta: { requiresAuth: true } },
  ]
  

  const router =createRouter({
    history: createWebHistory(),
    routes, 
  })


  router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !store.getters.loggedIn) {
      return {
        name : 'login',
      }
    }else if (to.meta.visitor && store.getters.loggedIn) {
      return {
        name : 'home',
      }
    }
  })


  export default router;
  
 
