<?php

namespace App\Services\Quotes;

interface QuoteProviderInterface
{
    /**
     * Get a quote for a given symbol.
     *
     * @param string $symbol The symbol of the asset (e.g., "BINANCE:BTCUSDT", "AAPL").
     * @return float|null The current price of the asset, or null if not found.
     */
    public function getQuote(string $symbol): ?float;
}