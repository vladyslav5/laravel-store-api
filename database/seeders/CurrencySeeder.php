<?php

namespace Database\Seeders;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');
        $response = json_decode($data,true);
        foreach ($response as $currency) {
            $currency['exchangedate'] = Carbon::parse($currency['exchangedate'])->format('Y-m-d');
            Currency::create($currency);
        }
    }
}
