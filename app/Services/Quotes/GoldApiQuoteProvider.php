<?php

namespace App\Services\Quotes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoldApiQuoteProvider implements QuoteProviderInterface
{
    protected string $apiKey;
    protected string $baseUrl = 'https://www.goldapi.io/api';

    public function __construct()
    {
        $this->apiKey = config('services.goldapi.api_key');
    }

    public function getQuote(string $symbol): ?float
    {
        // GoldAPI.io expects symbol like XAU/USD.
        // Our current symbol format is just "XAU" for gold, and we'll assume USD as the currency.
        // If the symbol is "XAU", we'll construct "XAU/USD".
        // If other symbols are needed, the logic here would need to be expanded.

        $fullSymbol = $symbol;
        if ($symbol === 'XAU') {
            $fullSymbol = 'XAU/USD'; // Default to USD for Gold
        }

        try {
            $response = Http::withHeaders([
                'x-access-token' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->get("{$this->baseUrl}/{$fullSymbol}")->json();

            if (isset($response['price'])) {
                return (float) $response['price'];
            }

            Log::warning("GoldApiQuoteProvider: Unexpected response format for {$symbol}.", ['response' => $response]);
            return null;
        } catch (\Exception $e) {
            Log::error("GoldApiQuoteProvider: Failed to fetch quote for {$symbol}. Error: {$e->getMessage()}");
            return null;
        }
    }
}