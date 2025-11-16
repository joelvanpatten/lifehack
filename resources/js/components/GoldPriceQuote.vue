<script setup>
import { ref, onMounted } from 'vue';

const goldPrice = ref(null);
const error = ref(null);

const fetchGoldPrice = async () => {
    try {
        const response = await fetch(route('quote.get', { provider: 'goldapi', symbol: 'XAU' }));
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (data.error) {
            throw new Error(data.error);
        }
        goldPrice.value = data.price;
    } catch (e) {
        error.value = e.message;
        console.error("Failed to fetch Gold price from GoldAPI.io:", e);
    }
};

onMounted(() => {
    fetchGoldPrice();
});
</script>

<template>
    <div class="p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-2">Gold Spot Price (XAU/USD)</h3>
        <div v-if="goldPrice" class="text-2xl font-bold text-green-700 dark:text-green-400">
            ${{ goldPrice.toFixed(2) }}
        </div>
        <div v-else-if="error" class="text-red-500">
            Error: {{ error }}
        </div>
        <div v-else class="text-gray-500">
            Loading...
        </div>
    </div>
</template>