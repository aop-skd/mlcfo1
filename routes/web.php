<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;//追記
use App\Http\Controllers\TicketslistController;//追記
use App\Http\Controllers\BalancesController;//追記
use App\Http\Controllers\SettlementsController;//追記

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//保存処理
Route::post('tickets', [TicketsController::class, 'store']);

//Top画面
Route::get('/', [TicketsController::class, 'index']);

//Ticket&list画面
Route::get('/ticketslist', [TicketslistController::class, 'index']);

//Balance画面
Route::get('/balance', [BalancesController::class, 'index']);

//Balance画面保存処理
Route::post('balance', [BalancesController::class, 'store']);

//Balance画面削除処理
Route::delete('/balance/{balance}', [BalancesController::class, 'destroy']);

//削除処理
Route::delete('/ticket/{ticket}', [TicketsController::class, 'destroy']);

//更新画面表示
Route::get('/ticketsedit/{ticket}',[TicketsController::class, 'edit']);

//更新処理
Route::post('/tickets/update',[TicketsController::class, 'update']);

//Settlement画面表示
Route::get('/settlement', [SettlementsController::class, 'index']);

//Settlement画面保存処理
Route::post('settlement', [SettlementsController::class, 'store']);