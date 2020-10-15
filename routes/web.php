<?php

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


Route::get('stocks',[StockController::class,'index']);
Route::get('/stocks/create', [TodoController::class, 'create'])->name('stocks.create');
Route::post('/stocks', [TodoController::class, 'store'])->name('stocks.store'); // this will be making a post request
Route::get('/stocks/{id}', [TodoController::class, 'show'])->name('stocks.show');
Route::get('/stocks/{id}/edit', [TodoController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [TodoController::class, 'update'])->name('stocks.update'); //making a put request
Route::delete('/stocks/{id}', [TodoController::class, 'destroy'])->name('stocks.destroy'); //making a delete request