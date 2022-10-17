import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './routes/routes.js'
import store from './store/store.js'

import 'bootstrap'
import './assets/scss/app.scss'
import toastr  from 'toastr' 
window.toastr = toastr

createApp(App).use(router).use(store).mount('#app')
