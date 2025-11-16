<?php

namespace App\Services\Quotes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FmpQuoteProvider implements QuoteProviderInterface
{
    protected string $apiKey;
    // protected string $baseUrl = 'https://financialmodelingprep.com/api/v3';
    protected string $baseUrl = 'https://financialmodelingprep.com/stable';

    public function __construct()
    {
        $this->apiKey = config('services.fmp.api_key');
    }

    public function getQuote(string $symbol): ?float
    {
         $params = [
            'symbol' => $symbol,
            'apikey' => $this->apiKey,
        ];

        try {
            $response = Http::get("{$this->baseUrl}/quote", $params)->json();

            // FMP returns an array of quotes, even for a single symbol.
            // We expect the first element to contain the quote.
            if (isset($response[0]['price'])) {
                return (float) $response[0]['price'];
            }

            Log::warning("FmpQuoteProvider: Unexpected response format for {$symbol}.", ['response' => $response]);
            return null;
        } catch (\Exception $e) {
            // Log::error("FmpQuoteProvider: Failed to fetch quote for {$symbol}. Error: {$e->getMessage()}");
            Log::error("FmpError: {$e->getMessage()}");
            return null;
        }
    }
}