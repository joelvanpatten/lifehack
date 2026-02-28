<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRatio extends Model
{
    protected $fillable = [
        'btc_to_gold',
        'btc_to_sp500',
        'gold_to_sp500',
    ];
}
