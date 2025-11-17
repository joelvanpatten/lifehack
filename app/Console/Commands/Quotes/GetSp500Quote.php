<?php

namespace App\Console\Commands\Quotes;

use App\Services\Quotes\FmpQuoteProvider;
use Illuminate\Console\Command;

class GetSp500Quote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:get-sp500';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the current S&P 500 Index quote from FMP';

    /**
     * Execute the console command.
     */
    public function handle(FmpQuoteProvider $fmpQuoteProvider)
    {
        $quote = $fmpQuoteProvider->getQuote('^GSPC');
        $this->info('S&P 500 Index: $' . $quote);
    }
}
