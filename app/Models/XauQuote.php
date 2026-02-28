<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XauQuote extends Model
{
    use HasFactory;

    protected $table = 'xau_quotes';

    protected $fillable = ['price'];
}