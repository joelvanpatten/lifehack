<?php

namespace App\Console\Commands\Quotes;

use App\Services\Quotes\FinnhubQuoteProvider;
use App\Services\Quotes\GoldApiQuoteProvider;
use App\Services\Quotes\FmpQuoteProvider;
use App\Models\QuoteRatio;
use Illuminate\Console\Command;

class CalculateAndStoreRatios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:calculate-and-store-ratios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Bitcoin, Gold, and S&P 500 quotes, calculate ratios, and store them.';

    /**
     * Execute the console command.
     */
    public function handle(
        FinnhubQuoteProvider $finnhubQuoteProvider,
        GoldApiQuoteProvider $goldApiQuoteProvider,
        FmpQuoteProvider $fmpQuoteProvider
    ) {
        $this->info('Fetching quotes...');

        $bitcoinPrice = $finnhubQuoteProvider->getQuote('BINANCE:BTCUSDT');
        $goldPrice = $goldApiQuoteProvider->getQuote('XAU');
        $sp500Price = $fmpQuoteProvider->getQuote('^GSPC');

        $this->info("Bitcoin Price: $" . $bitcoinPrice);
        $this->info("Gold Price: $" . $goldPrice);
        $this->info("S&P 500 Index: $" . $sp500Price);

        // Calculate Ratios
        $btcToGoldRatio = $goldPrice > 0 ? round($bitcoinPrice / $goldPrice, 2) : 0;
        $btcToSp500Ratio = $sp500Price > 0 ? round($bitcoinPrice / $sp500Price, 2) : 0;
        $goldToSp500Ratio = $sp500Price > 0 ? round($goldPrice / $sp500Price, 2) : 0;

        $this->info("Ratios:");
        $this->info("BTC:XAU = " . $btcToGoldRatio . ":1");
        $this->info("BTC:SP500 = " . $btcToSp500Ratio . ":1");
        $this->info("XAU:SP500 = " . $goldToSp500Ratio . ":1");

        // Store ratios to the database
        QuoteRatio::create([
            'bitcoin_price' => $bitcoinPrice,
            'gold_price' => $goldPrice,
            'sp500_price' => $sp500Price,
            'btc_to_gold' => $btcToGoldRatio,
            'btc_to_sp500' => $btcToSp500Ratio,
            'gold_to_sp500' => $goldToSp500Ratio,
        ]);

        $this->info('Ratios stored in the database successfully!');
    }
}
