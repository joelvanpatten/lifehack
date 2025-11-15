<template>
  <ToastViewport>
    <Toast
      v-for="toast in toasts"
      :key="toast.id"
      :variant="toast.variant"
      :duration="toast.duration"
      :auto-close="toast.autoClose"
      @close="removeToast(toast.id)"
    >
      <ToastTitle v-if="toast.title">{{ toast.title }}</ToastTitle>
      <ToastDescription v-if="toast.description">{{ toast.description }}</ToastDescription>
    </Toast>
  </ToastViewport>
</template>

<script setup lang="ts">
import { watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useFlashMessages } from '@/composables/useFlashMessages'
import Toast from './Toast.vue'
import ToastViewport from './ToastViewport.vue'
import ToastTitle from './ToastTitle.vue'
import ToastDescription from './ToastDescription.vue'

const { toasts, removeToast, addToast } = useFlashMessages()
const page = usePage()

const showFlashMessage = (flash: any) => {
  if (!flash) return

  // Handle different flash message types
  if (flash.success) {
    addToast({
      title: 'Success',
      description: flash.success,
      variant: 'success',
      duration: 45000,
      autoClose: true
    })
  }

  if (flash.error) {
    addToast({
      title: 'Error',
      description: flash.error,
      variant: 'destructive',
      duration: 45000,
      autoClose: true
    })
  }

  if (flash.warning) {
    addToast({
      title: 'Warning',
      description: flash.warning,
      variant: 'warning',
      duration: 45000,
      autoClose: true
    })
  }

  if (flash.info) {
    addToast({
      title: 'Info',
      description: flash.info,
      variant: 'info',
      duration: 45000,
      autoClose: true
    })
  }

  if (flash.message) {
    addToast({
      title: 'Message',
      description: flash.message,
      variant: 'default',
      duration: 45000,
      autoClose: true
    })
  }

  if (flash.status) {
    addToast({
      title: 'Status',
      description: flash.status,
      variant: 'info',
      duration: 45000,
      autoClose: true
    })
  }
}

// Watch for flash messages from the server
watch(() => page.props.flash, (newFlash) => {
  if (newFlash) {
    showFlashMessage(newFlash)
  }
}, { immediate: true })
</script>
