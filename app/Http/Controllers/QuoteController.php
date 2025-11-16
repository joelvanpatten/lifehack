<?php

namespace App\Http\Controllers;

use App\Services\Quotes\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    protected QuoteService $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function getQuote(Request $request, string $symbol)
    {
        $price = $this->quoteService->getQuote($symbol);

        if ($price !== null) {
            return response()->json(['price' => $price]);
        } else {
            return response()->json(['error' => 'Could not retrieve quote for ' . $symbol], 500);
        }
    }
}