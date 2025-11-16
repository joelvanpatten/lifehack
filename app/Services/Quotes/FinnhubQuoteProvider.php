<?php

namespace App\Services\Quotes;

use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use Finnhub\Model\Quote;
use Illuminate\Support\Facades\Log;

class FinnhubQuoteProvider implements QuoteProviderInterface
{
    protected DefaultApi $client;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', config('services.finnhub.api_key'));
        $this->client = new DefaultApi(
            new \GuzzleHttp\Client(),
            $config
        );
    }

    public function getQuote(string $symbol): ?float
    {
        try {
            $quote = $this->client->quote($symbol);

            $price = null;
            if ($quote instanceof Quote) {
                $price = $quote->getC();
            } elseif (is_array($quote) && isset($quote['c'])) {
                $price = $quote['c'];
            }

            return $price;
        } catch (\Exception $e) {
            Log::error("FinnhubQuoteProvider: Failed to fetch quote for {$symbol}. Error: {$e->getMessage()}");
            return null;
        }
    }
}