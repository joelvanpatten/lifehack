<?php

namespace App\Console\Commands\Quotes;

use App\Models\BtcQuote;
use App\Services\Quotes\FinnhubQuoteProvider;
use Illuminate\Console\Command;

class GetBitcoinQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:get-bitcoin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the current Bitcoin price from Finnhub';

    /**
     * Execute the console command.
     */
    public function handle(FinnhubQuoteProvider $finnhubQuoteProvider)
    {
        $bitcoinPrice = $finnhubQuoteProvider->getQuote('BINANCE:BTCUSDT');
        BtcQuote::create(['price' => $bitcoinPrice]);
        $this->info('Bitcoin Price: $' . $bitcoinPrice);
    }
}
