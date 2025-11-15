<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
defineOptions({ layout: AppLayout })
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import axios from 'axios'

const notifications = ref([])
const loading       = ref(true)
const error         = ref(null)

onMounted(async () => {
    try {
        const response = await axios.get('/api/notifications')
        // pull out the `data` array from the paginator
        notifications.value = response.data.data
    } catch (err) {
        error.value = err.response?.data?.message || err.message
    } finally {
        loading.value = false
    }
})
</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-semibold mb-4">Your Notifications</h1>

        <div v-if="loading" class="text-gray-500">Loading…</div>
        <div v-else-if="error" class="text-red-500">{{ error }}</div>
        <ul v-else>
            <li
                v-for="note in notifications"
                :key="note.id"
                class="border-b py-2"
            >
                <!-- use `subject` instead of `message` -->
                <div class="font-medium">{{ note.subject }}</div>
                <div class="text-xs text-gray-400 mt-1">
                    <!-- use `sent_at` instead of `created_at` -->
                    {{ new Date(note.sent_at).toLocaleString() }}
                </div>
            </li>
            <li v-if="notifications.length === 0" class="text-gray-500">
                No notifications yet.
            </li>
        </ul>
    </div>
</template>
