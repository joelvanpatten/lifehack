<script setup>
import { ref, onMounted } from 'vue';

const sp500Price = ref(null);
const error = ref(null);

const fetchSp500Price = async () => {
    try {
        const response = await fetch(route('quote.get', { provider: 'fmp', symbol: '^GSPC' }));
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (data.error) {
            throw new Error(data.error);
        }
        sp500Price.value = data.price;
    } catch (e) {
        error.value = e.message;
        console.error("Failed to fetch S&P 500 price from FMP:", e);
    }
};

onMounted(() => {
    fetchSp500Price();
});
</script>

<template>
    <div class="p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-2">S&P 500 Index</h3>
        <div v-if="sp500Price" class="text-2xl font-bold text-green-700 dark:text-green-400">
            ${{ sp500Price.toFixed(2) }}
        </div>
        <div v-else-if="error" class="text-red-500">
            Error: {{ error }}
        </div>
        <div v-else class="text-gray-500">
            Loading...
        </div>
    </div>
</template>