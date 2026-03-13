<?php

namespace App\Console\Commands\Quotes;

use App\Models\Sp500Quote;
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
        $quoteData = $fmpQuoteProvider->getQuoteData('^GSPC');

        if ($quoteData) {
            Sp500Quote::create([
                'open' => $quoteData['open'] ?? 0,
                'high' => $quoteData['high'] ?? 0,
                'low' => $quoteData['low'] ?? 0,
                'close' => $quoteData['price'] ?? 0,
                'volume' => $quoteData['volume'] ?? 0,
                'quote_date' => now()->toDateString(),
            ]);
            $this->info('S&P 500 Index: Open $' . $quoteData['open'] . ', High $' . $quoteData['high'] . ', Low $' . $quoteData['low'] . ', Close $' . $quoteData['price'] . ', Volume ' . $quoteData['volume']);
        } else {
            $this->error('Failed to retrieve S&P 500 quote.');
        }
    }
}
