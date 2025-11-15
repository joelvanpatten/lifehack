<template>
    <div class="login-box">
        <h2>Login to Notifish</h2>
        <form @submit.prevent="handleLogin">
            <div>
                <label>Email:</label>
                <input v-model="email" type="email" required />
            </div>
            <div>
                <label>Password:</label>
                <input v-model="password" type="password" required />
            </div>
            <button type="submit" :disabled="loading">
                {{ loading ? 'Logging in...' : 'Login' }}
            </button>
            <p v-if="error" style="color:red;">{{ error }}</p>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref(null)
const loading = ref(false)

const handleLogin = async () => {
    error.value = null
    loading.value = true

    try {
        await axios.get('/sanctum/csrf-cookie') // Required for session-based Sanctum
        await axios.post('/api/login', { email: email.value, password: password.value })

        window.location.href = '/notifications'
    } catch (err) {
        error.value = 'Invalid login credentials'
    } finally {
        loading.value = false
    }
}
</script>
