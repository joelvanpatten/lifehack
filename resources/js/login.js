import { createApp } from 'vue'
import axios from 'axios'
import LoginForm from './components/LoginForm.vue'

// CSRF token setup
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true // Required for Sanctum session auth

const app = createApp({})
app.component('login-form', LoginForm)
app.mount('#app')
