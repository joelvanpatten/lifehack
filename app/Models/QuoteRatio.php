<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRatio extends Model
{
    protected $fillable = [
        'bitcoin_price',
        'gold_price',
        'sp500_price',
        'btc_to_gold',
        'btc_to_sp500',
        'gold_to_sp500',
    ];
}
