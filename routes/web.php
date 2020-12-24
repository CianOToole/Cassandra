<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;

// -    Users Profiles
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Moderator\ProfileController as ModeratorProfile;
use App\Http\Controllers\Client\ProfileController as ClientProfile;

// -    Users CRUD
use App\Http\Controllers\Admin\ModeratorController as ModController;
use App\Http\Controllers\Admin\ClientController as CliController;
use App\Http\Controllers\Moderator\ClientController as ModCliController;


Route::get('/', function () {
    return view('home');
});

// HOME ROUTES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/moderator/home', [App\Http\Controllers\Moderator\HomeController::class, 'index'])->name('moderator.home');
Route::get('/client/home', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('client.home');

// PROFILES CRUD ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// - Admins
Route::get('/admin/profile', [AdminProfile::class, 'profile'])->name('admin.profiles.index');
Route::get('/admin/profile/{id}/edit', [AdminProfile::class, 'edit'])->name('admin.profiles.edit');
Route::put('/admin/profile/{id}', [AdminProfile::class, 'update'])->name('admin.profiles.update');

// - Moderators
Route::get('/moderator/profile', [ModeratorProfile::class, 'profile'])->name('moderator.profiles.index');
Route::get('/moderator/profile/{id}/edit', [ModeratorProfile::class, 'edit'])->name('moderator.profiles.edit');
Route::put('/moderator/profile/{id}', [ModeratorProfile::class, 'update'])->name('moderator.profiles.update');

// - Clients
Route::get('/client/profile', [ClientProfile::class, 'profile'])->name('client.profiles.index');
Route::get('/client/profile/{id}/edit', [ClientProfile::class, 'edit'])->name('client.profiles.edit');
Route::put('/client/profile/{id}', [ClientProfile::class, 'update'])->name('client.profiles.update');

// USERS CRUD ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// - Admin -> moderators
Route::get('/admin/moderators', [ModController::class, 'index'])->name('admin.moderators.index');
Route::get('/admin/moderators/create', [ModController::class, 'create'])->name('admin.moderators.create');
Route::get('/admin/moderators/{id}', [ModController::class, 'show'])->name('admin.moderators.show');
Route::post ('/admin/moderators/store', [ModController::class, 'store'])->name('admin.moderators.store');
Route::get('/admin/moderators/{id}/edit', [ModController::class, 'edit'])->name('admin.moderators.edit');
Route::put('/admin/moderators/{id}', [ModController::class, 'update'])->name('admin.moderators.update');
Route::delete('/admin/moderators/{id}', [ModController::class, 'destroy'])->name('admin.moderators.destroy');

// - Admin ->  clients
Route::get('/admin/clients', [CliController::class, 'index'])->name('admin.clients.index');
Route::get('/admin/clients/create', [CliController::class, 'create'])->name('admin.clients.create');
Route::get('/admin/clients/{id}', [CliController::class, 'show'])->name('admin.clients.show');
Route::post ('/admin/clients/store', [CliController::class, 'store'])->name('admin.clients.store');
Route::get('/admin/clients/{id}/edit', [CliController::class, 'edit'])->name('admin.clients.edit');
Route::put('/admin/clients/{id}', [CliController::class, 'update'])->name('admin.clients.update');
Route::delete('/admin/clients/{id}', [CliController::class, 'destroy'])->name('admin.clients.destroy');
// -> banning sys
Route::put('/admin/banning/{id}', [CliController::class, 'ban'])->name('admin.clients.banning');
Route::put('/admin/clients/{id}', [CliController::class, 'unban'])->name('admin.clients.unban');

// - Moderator -> clients
Route::get('/moderator/clients', [ModCliController::class, 'index'])->name('moderator.clients.index');
Route::get('/moderator/clients/create', [ModCliController::class, 'create'])->name('moderator.clients.create');
Route::get('/moderator/clients/{id}', [ModCliController::class, 'show'])->name('moderator.clients.show');
Route::post ('/moderator/clients/store', [ModCliController::class, 'store'])->name('moderator.clients.store');
Route::get('/moderator/clients/{id}/edit', [ModCliController::class, 'edit'])->name('moderator.clients.edit');
Route::put('/moderator/clients/{id}', [ModCliController::class, 'update'])->name('moderator.clients.update');
Route::delete('/moderator/clients/{id}', [ModCliController::class, 'destroy'])->name('moderator.clients.destroy');
// -> banning sys
Route::put('/moderator/banning/{id}', [ModCliController::class, 'ban'])->name('moderator.clients.banning');
Route::put('/moderator/clients/{id}', [ModCliController::class, 'unban'])->name('moderator.clients.unban');


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


