<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return "back working";
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'orders' => OrderController::class,
    ]);
});


Route::post('/reg',[UserController::class,'createUser']);
Route::post('/auth',[UserController::class,'authUser']);
Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {

    $isAuth = Auth::check();
    return response()->json([
        'user'=>$request->user(),
        'isAuth'=>$isAuth
    ]);
})->middleware('auth:sanctum');
