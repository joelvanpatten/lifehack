<?php

namespace App\Services\Quotes;

use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;

class QuoteService
{
    protected Application $app;
    protected array $providers = [
        'finnhub' => FinnhubQuoteProvider::class,
        'alphavantage' => AlphaVantageQuoteProvider::class,
        'fmp' => FmpQuoteProvider::class,
        'goldapi' => GoldApiQuoteProvider::class,
        // Add other providers here
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get a quote for a given symbol.
     *
     * @param string $symbol The symbol of the asset (e.g., "BINANCE:BTCUSDT", "AAPL").
     * @param string|null $providerName Optional: specify a provider if needed.
     * @return float|null The current price of the asset, or null if not found.
     */
    public function getQuote(string $symbol, ?string $providerName = null): ?float
    {
        $provider = $this->resolveProvider($providerName);

        return $provider->getQuote($symbol);
    }

    protected function resolveProvider(?string $providerName): QuoteProviderInterface
    {
        if ($providerName === null) {
            // Default to Finnhub if no provider is specified
            $providerName = 'finnhub';
        }

        if (!isset($this->providers[$providerName])) {
            throw new InvalidArgumentException("Quote provider '{$providerName}' not found.");
        }

        $providerClass = $this->providers[$providerName];

        return $this->app->make($providerClass);
    }
}