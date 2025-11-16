<?php

namespace App\Services\Quotes;

use InvalidArgumentException;

class QuoteService
{
    protected QuoteProviderInterface $defaultProvider;

    public function __construct(QuoteProviderInterface $defaultProvider)
    {
        $this->defaultProvider = $defaultProvider;
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
        // For now, we only have one provider, so we'll use the default.
        // In the future, you could add logic here to select different providers
        // based on the symbol prefix (e.g., "BINANCE:" for Finnhub, "YAHOO:" for another provider)
        // or based on the $providerName parameter.

        return $this->defaultProvider->getQuote($symbol);
    }
}