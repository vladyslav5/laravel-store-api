<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Carbon\Carbon;


class CurrencyController extends Controller
{
    //
    function index()
    {
        return Currency::all();
    }

}
