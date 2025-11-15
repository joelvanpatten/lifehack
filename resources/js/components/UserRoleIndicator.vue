<script setup>
import { defineProps, computed } from 'vue';
import { useSidebar } from '@/components/ui/sidebar/utils';

const props = defineProps({
    userRoleIndicator: {
        type: String,
        default: null,
    },
});
const { state, isMobile } = useSidebar();

const isVisible = computed(() => {
    return state.value !== 'collapsed' && !isMobile.value;
});
</script>

<template>
    <div
        v-if="isVisible && userRoleIndicator"
        class="inline-block px-2 py-0.5 text-xs font-semibold text-gesa-white bg-gesa-olive rounded-full mt-1 self-start"
    >
        {{ userRoleIndicator }}
    </div>
</template>