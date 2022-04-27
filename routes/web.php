<?php

use App\Http\Controllers\agent\AgentController;
use App\Http\Controllers\client\TicketController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::resource('tickets', TicketController::class)->only('index', 'store', 'create', 'show');
Route::get('my-ticket', [TicketController::class, 'myTicket'])->name('my.ticket');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('agents', AgentController::class)->only('index');
    Route::post('reply', [AgentController::class, 'reply'])->name('reply');
});
