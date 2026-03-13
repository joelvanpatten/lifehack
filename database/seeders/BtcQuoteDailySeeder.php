<?php

namespace Database\Seeders;

use App\Models\BtcQuote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BtcQuoteDailySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path("DeveloperNotes/currency_daily_BTC_USD.csv");
        $data = array_map("str_getcsv", file($file));

        // Skip the header row
        $header = array_shift($data);

        foreach ($data as $row) {
            BtcQuote::create([
                "quote_date" => $row[0], // timestamp
                "open" => $row[1],
                "high" => $row[2],
                "low" => $row[3],
                "close" => $row[4],
                "volume" => $row[5],
            ]);
        }
    }
}
