<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtcQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'open',
        'high',
        'low',
        'close',
        'volume',
        'quote_date',
    ];
}