<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('stock-list', [StockController::class, 'index'])->name('stock_list');
Route::resource('stocks', StockController::class)->except(['index']);
Route::get('stock-details', [StockController::class, 'display'])->middleware('auth:api');

Route::post('login', [AuthController::class,'login_api']);

Route::post('logout', [AuthController::class,'logout_api'])->middleware('auth:api');
Route::post('add-multiple-stocks', [StockController::class,'addMutipleStocks']);
