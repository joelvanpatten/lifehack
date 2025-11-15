<template>
  <div
    :class="[
      'group pointer-events-auto relative flex w-full items-center justify-between space-x-4 overflow-hidden rounded-md border p-6 pr-8 shadow-lg transition-all',
      'data-[swipe=move]:transition-none data-[swipe=cancel]:transition-all data-[swipe=end]:transition-all',
      'data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-80 data-[state=closed]:slide-out-to-right-full data-[state=open]:slide-in-from-top-full',
      variantClasses[variant]
    ]"
    :data-state="isVisible ? 'open' : 'closed'"
    :data-swipe="swipeDirection"
    @pointerenter="pauseTimer"
    @pointerleave="resumeTimer"
  >
    <div class="grid gap-1">
      <slot />
    </div>
    <ToastClose 
      @click="close" 
      class="absolute right-2 top-2 rounded-md opacity-0 transition-opacity hover:text-foreground focus:opacity-100 focus:outline-none focus:ring-2 group-hover:opacity-100 group-[.destructive]:text-red-300 group-[.destructive]:hover:text-red-50 group-[.destructive]:focus:ring-red-400 group-[.destructive]:focus:ring-offset-red-600"
    />
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from 'vue'
import ToastClose from './ToastClose.vue'

interface Props {
  variant?: 'default' | 'destructive' | 'success' | 'warning' | 'info'
  duration?: number
  autoClose?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'default',
  duration: 45000, // 45 seconds
  autoClose: true
})

const emit = defineEmits<{
  close: []
}>()

const isVisible = ref(true)
const swipeDirection = ref('')
let timer: NodeJS.Timeout | null = null

const variantClasses = {
  default: 'border-border bg-background text-foreground',
  destructive: 'destructive border-destructive bg-destructive text-destructive-foreground',
  success: 'border-green-200 bg-green-50 text-green-900',
  warning: 'border-yellow-200 bg-yellow-50 text-yellow-900',
  info: 'border-blue-200 bg-blue-50 text-blue-900'
}

const startTimer = () => {
  if (!props.autoClose) return
  
  timer = setTimeout(() => {
    close()
  }, props.duration)
}

const pauseTimer = () => {
  if (timer) {
    clearTimeout(timer)
    timer = null
  }
}

const resumeTimer = () => {
  if (props.autoClose) {
    startTimer()
  }
}

const close = () => {
  isVisible.value = false
  emit('close')
}

onMounted(() => {
  startTimer()
})

onUnmounted(() => {
  if (timer) {
    clearTimeout(timer)
  }
})
</script>
