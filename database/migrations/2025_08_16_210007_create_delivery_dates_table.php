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
        Schema::create('delivery_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_subscription_id')->constrained()->onDelete('cascade');
            $table->date('delivery_date');
            $table->enum('status', ['scheduled', 'delivered', 'skipped', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_dates');
    }
};
