<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use Finnhub\Model\Quote;

class FinnhubController extends Controller
{
    public function getBitcoinPrice()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', config('services.finnhub.api_key'));
        $client = new DefaultApi(
            new \GuzzleHttp\Client(),
            $config
        );

        try {
            $quote = $client->quote("BINANCE:BTCUSDT");

            $price = null;
            if ($quote instanceof Quote) {
                $price = $quote->getC();
            } elseif (is_array($quote) && isset($quote['c'])) {
                $price = $quote['c'];
            }

            if ($price !== null) {
                return response()->json(['price' => $price]);
            } else {
                return response()->json(['error' => 'Could not retrieve Bitcoin price or unexpected response format.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}