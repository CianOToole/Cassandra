<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\TradeController;
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


Route::get('stocks',[StockController::class,'index']);
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store'); // this will be making a post request
Route::get('/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');
Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [StockController::class, 'update'])->name('stocks.update'); //making a put request
Route::delete('/stocks/{id}', [StockController::class, 'destroy'])->name('stocks.destroy'); //making a delete request

Route::get('trades',[TradeController::class,'index']);
Route::get('/trades/create', [TradeController::class, 'create'])->name('trades.create');
Route::post('/trades', [TradeController::class, 'store'])->name('trades.store'); // this will be making a post request
Route::get('/trades/{id}', [TradeController::class, 'show'])->name('trades.show');
Route::get('/trades/{id}/edit', [TradeController::class, 'edit'])->name('trades.edit');
Route::put('/trades/{id}', [TradeController::class, 'update'])->name('trades.update'); //making a put request
Route::delete('/trades/{id}', [TradeController::class, 'destroy'])->name('trades.destroy'); //making a delete request

Route::get('balances',[BalanceController::class,'index']);
Route::get('/balances/create', [TradeController::class, 'create'])->name('balances.create');
Route::post('/balances', [TradeController::class, 'store'])->name('balances.store'); // this will be making a post request
Route::get('/balances/{id}', [TradeController::class, 'show'])->name('balances.show');
Route::get('/balances/{id}/edit', [TradeController::class, 'edit'])->name('balances.edit');
Route::put('/balances/{id}', [TradeController::class, 'update'])->name('balances.update'); //making a put request
Route::delete('/balances/{id}', [TradeController::class, 'destroy'])->name('balances.destroy'); //making a delete request