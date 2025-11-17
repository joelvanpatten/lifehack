<?php

namespace App\Console\Commands\Quotes;

use App\Services\Quotes\GoldApiQuoteProvider;
use Illuminate\Console\Command;

class GetGoldQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:get-gold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the current Gold price from GoldAPI';

    /**
     * Execute the console command.
     */
    public function handle(GoldApiQuoteProvider $goldApiQuoteProvider)
    {
        $quote = $goldApiQuoteProvider->getQuote('XAU');
        $this->info('Gold Price: $' . $quote);
    }
}
