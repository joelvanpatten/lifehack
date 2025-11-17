<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quote_ratios', function (Blueprint $table) {
            $table->id();
            $table->decimal('bitcoin_price', 15, 2);
            $table->decimal('gold_price', 15, 2);
            $table->decimal('sp500_price', 15, 2);
            $table->decimal('btc_to_gold', 15, 2);
            $table->decimal('btc_to_sp500', 15, 2);
            $table->decimal('gold_to_sp500', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_ratios');
    }
};
