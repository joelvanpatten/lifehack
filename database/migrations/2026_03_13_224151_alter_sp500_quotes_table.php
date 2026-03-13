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
        Schema::table('sp500_quotes', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->decimal('open', 15, 2)->after('id');
            $table->decimal('high', 15, 2)->after('open');
            $table->decimal('low', 15, 2)->after('high');
            $table->decimal('close', 15, 2)->after('low');
            $table->bigInteger('volume')->after('close');
            $table->date('quote_date')->after('volume');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sp500_quotes', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->after('id');
            $table->dropColumn(['open', 'high', 'low', 'close', 'volume', 'quote_date']);
        });
    }
};
