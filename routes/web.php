<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CoaController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/coa', [App\Http\Controllers\CoaController::class, 'index'])->name('coa.index');
Route::get('/coa/update', [App\Http\Controllers\CoaController::class, 'update'])->name('coa.update');
Route::get('/kasMasuk', [App\Http\Controllers\kasMasukController::class, 'index'])->name('kasMasuk.index');
