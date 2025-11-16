<?php

namespace App\Services\Quotes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlphaVantageQuoteProvider implements QuoteProviderInterface
{
    protected string $apiKey;
    protected string $baseUrl = 'https://www.alphavantage.co/query';

    public function __construct()
    {
        $this->apiKey = config('services.alphavantage.api_key');
    }

    public function getQuote(string $symbol): ?float
    {
        // AlphaVantage typically uses different symbols for crypto vs stocks.
        // For crypto, it's usually `DIGITAL_CURRENCY_DAILY` or `DIGITAL_CURRENCY_INTRADAY`.
        // For stocks, it's `GLOBAL_QUOTE`.
        // We'll assume for now that if the symbol contains ':', it's a crypto pair (e.g., BTC:USD).
        // Otherwise, it's a stock symbol.

        if (str_contains($symbol, ':')) {
            list($fromCurrency, $toCurrency) = explode(':', $symbol);
            $function = 'CURRENCY_EXCHANGE_RATE'; // For real-time currency exchange rates
            $params = [
                'function' => $function,
                'from_currency' => $fromCurrency,
                'to_currency' => $toCurrency,
                'apikey' => $this->apiKey,
            ];
        } else {
            $function = 'GLOBAL_QUOTE';
            $params = [
                'function' => $function,
                'symbol' => $symbol,
                'apikey' => $this->apiKey,
            ];
        }

        try {
            $response = Http::get($this->baseUrl, $params)->json();

            if (isset($response['Error Message'])) {
                Log::error("AlphaVantageQuoteProvider: API Error for {$symbol}. Message: {$response['Error Message']}");
                return null;
            }

            if (isset($response['Realtime Currency Exchange Rate'])) {
                return (float) $response['Realtime Currency Exchange Rate']['5. Exchange Rate'];
            } elseif (isset($response['Global Quote'])) {
                return (float) $response['Global Quote']['05. price'];
            }

            Log::warning("AlphaVantageQuoteProvider: Unexpected response format for {$symbol}.", ['response' => $response]);
            return null;
        } catch (\Exception $e) {
            Log::error("AlphaVantageQuoteProvider: Failed to fetch quote for {$symbol}. Error: {$e->getMessage()}");
            return null;
        }
    }
}