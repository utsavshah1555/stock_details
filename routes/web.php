<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('user.login-page');
Route::post('login', [AuthController::class, 'login'])->name('user.login');
Route::get('stocks-list', [StockController::class, 'index'])->middleware('auth')->name('stocks-list');
Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
