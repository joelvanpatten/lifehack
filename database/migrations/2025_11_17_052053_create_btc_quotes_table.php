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
        Schema::create('btc_quotes', function (Blueprint $table) {
            $table->id()->primary();
            $table->decimal("open", 10)->nullable();
            $table->decimal("high", 10)->nullable();
            $table->decimal("low", 10)->nullable();
            $table->decimal("close", 10);              // Close will set the "price".
            $table->decimal("volume", 10)->nullable();
            // $table->date("quote_date")->unique();
            // $table->date('quote_date')->default('1999-12-31')->unique();
            $table->date('quote_date')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('btc_quotes');
    }
};
