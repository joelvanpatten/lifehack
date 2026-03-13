<?php

namespace Database\Seeders;

use App\Models\Sp500Quote;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Sp500QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path("data/alphavantage_monthly_VOO.json"));
        $data = json_decode($json, true);

        $quotes = [];
        foreach ($data["Monthly Time Series"] as $date => $quoteData) {
            $quotes[] = [
                "quote_date" => $date,
                "open" => $quoteData["1. open"],
                "high" => $quoteData["2. high"],
                "low" => $quoteData["3. low"],
                "close" => $quoteData["4. close"],
                "volume" => $quoteData["5. volume"],
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        // Chunk the data to insert in batches
        foreach (array_chunk($quotes, 1000) as $chunk) {
            Sp500Quote::insert($chunk);
        }
    }
}
