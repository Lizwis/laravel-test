import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'


import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

import "element-plus/dist/index.css";
import "@element-plus/theme-chalk/dist/index.css";      

const pinia = createPinia()

pinia.use(piniaPluginPersistedstate)


const app = createApp(App)
app.use(router)
app.use(pinia)


app.mount('#app')
