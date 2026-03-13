<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp500Quote extends Model
{
    use HasFactory;

    protected $table = 'sp500_quotes';

    protected $fillable = ['open', 'high', 'low', 'close', 'volume', 'quote_date'];
}