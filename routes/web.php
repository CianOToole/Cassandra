<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ModeratorController as ModProfileController;


Route::get('/', function () {
    return view('home');
});

// HOME ROUTES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/moderator/home', [App\Http\Controllers\Moderator\HomeController::class, 'index'])->name('moderator.home');
Route::get('/client/home', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('client.home');

// PROFILE CRUD ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// - moderators
Route::get('/admin/moderators', [ModProfileController::class, 'index'])->name('admin.moderators.index');
Route::get('/admin/moderators/create', [ModProfileController::class, 'create'])->name('admin.moderators.create');
Route::get('/admin/moderators/{id}', [ModProfileController::class, 'show'])->name('admin.moderators.show');
Route::post ('/admin/moderators/store', [ModProfileController::class, 'store'])->name('admin.moderators.store');
Route::get('/admin/moderators/{id}/edit', [ModProfileController::class, 'edit'])->name('admin.moderators.edit');
Route::put('/admin/moderators/{id}', [ModProfileController::class, 'update'])->name('admin.moderators.update');
Route::delete('/admin/moderators/{id}', [ModProfileController::class, 'destroy'])->name('admin.moderators.destroy');

// STOCKS CRUD ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('stocks',[StockController::class,'index'])->name('stocks.index');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store'); // this will be making a post request
Route::get('/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');
Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [StockController::class, 'update'])->name('stocks.update'); //making a put request
Route::delete('/stocks/{id}', [StockController::class, 'destroy'])->name('stocks.destroy'); //making a delete request

Route::get('trades',[TradeController::class,'index'])->name('trades.index');
Route::get('/trades/create/{price}/{id}', [TradeController::class, 'create'])->name('trades.create');
Route::post('/trades', [TradeController::class, 'store'])->name('trades.store'); // this will be making a post request
Route::get('/trades/{id}', [TradeController::class, 'show'])->name('trades.show');
Route::get('/trades/{id}/edit', [TradeController::class, 'edit'])->name('trades.edit');
Route::put('/trades/{id}', [TradeController::class, 'update'])->name('trades.update'); //making a put request
Route::delete('/trades/{id}', [TradeController::class, 'destroy'])->name('trades.destroy'); //making a delete request

Route::get('balances',[BalanceController::class,'index'])->name('balances.index');
Route::get('/balances/create', [BalanceController::class, 'create'])->name('balances.create');
Route::post('/balances', [BalanceController::class, 'store'])->name('balances.store'); // this will be making a post request
Route::get('/balances/{id}', [BalanceController::class, 'show'])->name('balances.show');
Route::get('/balances/{id}/edit', [BalanceController::class, 'edit'])->name('balances.edit');
Route::put('/balances/{id}', [BalanceController::class, 'update'])->name('balances.update'); //making a put request
Route::delete('/balances/{id}', [BalanceController::class, 'destroy'])->name('balances.destroy'); //making a delete request

Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // this will be making a post request
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); //making a put request
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); //making a delete request


