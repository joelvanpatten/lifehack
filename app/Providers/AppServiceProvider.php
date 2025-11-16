<?php

namespace App\Providers;

use App\Services\Quotes\FinnhubQuoteProvider;
use App\Services\Quotes\QuoteProviderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuoteProviderInterface::class, FinnhubQuoteProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
