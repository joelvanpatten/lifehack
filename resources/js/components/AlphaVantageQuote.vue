<script setup>
import { ref, onMounted } from 'vue';

const stockSymbol = ref('IBM'); // Default stock symbol for AlphaVantage
const stockPrice = ref(null);
const error = ref(null);

const fetchStockPrice = async () => {
    try {
        const response = await fetch(route('quote.get', { provider: 'alphavantage', symbol: stockSymbol.value }));
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (data.error) {
            throw new Error(data.error);
        }
        stockPrice.value = data.price;
    } catch (e) {
        error.value = e.message;
        console.error(`Failed to fetch stock price for ${stockSymbol.value} from AlphaVantage:`, e);
    }
};

onMounted(() => {
    fetchStockPrice();
    // setInterval(fetchStockPrice, 60000); // Refresh every 60 seconds
});
</script>

<template>
    <div class="p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-2">Stock Price (AlphaVantage)</h3>
        <div class="flex items-center space-x-2 mb-2">
            <label for="stockSymbol" class="sr-only">Stock Symbol</label>
            <input
                id="stockSymbol"
                type="text"
                v-model="stockSymbol"
                @keyup.enter="fetchStockPrice"
                placeholder="Enter stock symbol (e.g., IBM)"
                class="border rounded-md p-2 text-sm"
            />
            <button @click="fetchStockPrice" class="px-4 py-2 bg-blue-500 text-white rounded-md text-sm">
                Fetch
            </button>
        </div>
        <div v-if="stockPrice" class="text-2xl font-bold text-blue-600">
            ${{ stockPrice.toFixed(2) }}
        </div>
        <div v-else-if="error" class="text-red-500">
            Error: {{ error }}
        </div>
        <div v-else class="text-gray-500">
            Loading...
        </div>
    </div>
</template>