import { ref } from 'vue'

interface FlashMessage {
  title?: string
  description: string
  variant?: 'default' | 'destructive' | 'success' | 'warning' | 'info'
  duration?: number
  autoClose?: boolean
}

const toasts = ref<Array<FlashMessage & { id: string }>>([])

export function useFlashMessages() {
  const addToast = (message: FlashMessage) => {
    const id = Math.random().toString(36).substr(2, 9)
    const toast = {
      ...message,
      id,
      variant: message.variant || 'default',
      duration: message.duration || 45000,
      autoClose: message.autoClose !== false
    }
    
    toasts.value.push(toast)
    
    // Auto-remove after duration
    if (toast.autoClose) {
      setTimeout(() => {
        removeToast(id)
      }, toast.duration)
    }
    
    return id
  }

  const removeToast = (id: string) => {
    const index = toasts.value.findIndex(toast => toast.id === id)
    if (index > -1) {
      toasts.value.splice(index, 1)
    }
  }

  const success = (description: string, title?: string) => {
    return addToast({ title: title || 'Success', description, variant: 'success' })
  }

  const error = (description: string, title?: string) => {
    return addToast({ title: title || 'Error', description, variant: 'destructive' })
  }

  const warning = (description: string, title?: string) => {
    return addToast({ title: title || 'Warning', description, variant: 'warning' })
  }

  const info = (description: string, title?: string) => {
    return addToast({ title: title || 'Info', description, variant: 'info' })
  }

  const message = (description: string, title?: string) => {
    return addToast({ title: title || 'Message', description, variant: 'default' })
  }

  const clearAll = () => {
    toasts.value = []
  }

  return {
    toasts,
    addToast,
    removeToast,
    success,
    error,
    warning,
    info,
    message,
    clearAll
  }
}
