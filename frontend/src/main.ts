import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'
import ToastPlugin from 'vue-toast-notification';
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.css'
import './style.css'
import 'vue-toast-notification/dist/theme-bootstrap.css';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const app = createApp(App)
const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia);
app.use(router)
app.use(ToastPlugin)
app.mount('#app')
