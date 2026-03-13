<?php

namespace App\Services\Quotes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FmpQuoteProvider implements QuoteProviderInterface
{
    protected string $apiKey;
    protected string $baseUrl = 'https://financialmodelingprep.com/stable';

    public function __construct()
    {
        $this->apiKey = config('services.fmp.api_key');
    }

    public function getQuote(string $symbol): ?float
    {
        // This method is deprecated. Use getQuoteData instead.
        $quoteData = $this->getQuoteData($symbol);
        return $quoteData ? (float) $quoteData['price'] : null;
    }

    public function getQuoteData(string $symbol): ?array
    {
        $params = [
            'symbol' => $symbol,
            'apikey' => $this->apiKey,
        ];

        try {
            $response = Http::get("{$this->baseUrl}/quote", $params)->json();

            // FMP returns an array of quotes, even for a single symbol.
            // We expect the first element to contain the quote.
            if (isset($response[0])) {
                return $response[0];
            }

            Log::warning("FmpQuoteProvider: Unexpected response format for {$symbol}.", ['response' => $response]);
            return null;
        } catch (\Exception $e) {
            Log::error("FmpError: {$e->getMessage()}");
            return null;
        }
    }
}