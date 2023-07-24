<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\kasKeluarController;
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
Route::post('/coa', [App\Http\Controllers\CoaController::class, 'sync'])->name('coa.sync');
Route::post('/coa/update', [App\Http\Controllers\CoaController::class, 'update'])->name('coa.update');

Route::get('/rab', [App\Http\Controllers\RabController::class, 'index'])->name('rab.index');
Route::post('/rab/sync', [App\Http\Controllers\RabController::class, 'sync'])->name('rab.sync');
Route::post('/rab/update', [App\Http\Controllers\RabController::class, 'update'])->name('rab.update');

Route::get('/tahun', [App\Http\Controllers\TahunAnggaranController::class, 'index'])->name('tahun.index');

Route::get('/kasMasuk', [App\Http\Controllers\kasMasukController::class, 'index'])->name('kasMasuk.index');

Route::get('/kasKeluar', [App\Http\Controllers\kasKeluarController::class, 'index'])->name('kasKeluar.index');

