<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { Leaf } from 'lucide-vue-next';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div :class="className" v-bind="$attrs" class="w-8 h-8 bg-[#4CAF50] rounded-lg flex items-center justify-center">
        <Leaf class="w-5 h-5 text-white" />
    </div>
</template>
