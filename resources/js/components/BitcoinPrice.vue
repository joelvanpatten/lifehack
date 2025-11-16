<script setup>
import { ref, onMounted } from 'vue';

const bitcoinPrice = ref(null);
const error = ref(null);

const fetchBitcoinPrice = async () => {
    try {
        const response = await fetch(route('quote.get', { provider: 'finnhub', symbol: 'BINANCE:BTCUSDT' }));
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        bitcoinPrice.value = data.price;
    } catch (e) {
        error.value = e.message;
        console.error("Failed to fetch Bitcoin price:", e);
    }
};

onMounted(() => {
    fetchBitcoinPrice();
    // setInterval(fetchBitcoinPrice, 60000); // Refresh every 60 seconds
});
</script>

<template>
    <div class="p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-2">Bitcoin Price (BTC/USDT)</h3>
        <div v-if="bitcoinPrice" class="text-2xl font-bold text-green-600">
            ${{ bitcoinPrice.toFixed(2) }}
        </div>
        <div v-else-if="error" class="text-red-500">
            Error: {{ error }}
        </div>
        <div v-else class="text-gray-500">
            Loading...
        </div>
    </div>
</template>