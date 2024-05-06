<?php

use App\Http\Controllers\CurrencyController;
use App\Models\Currency;
use Carbon\Carbon;
use http\Client;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function (){
    DB::table('currencies')->delete();


//
    $data = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');
    $response = [];
    foreach ($response as $currency) {
        $currency['exchangedate'] = Carbon::parse($currency['exchangedate'])->format('Y-m-d');
        Currency::create($currency);
    }

})->daily();

