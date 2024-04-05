import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";

import App from './App.vue'
import router from './router'
import './echo.js';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import 'animate.css';

const app = createApp(App)


const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

app.use(autoAnimatePlugin)
app.use(pinia)
app.use(router)

app.mount('#app')
