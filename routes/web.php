<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\kasKeluarController;
use App\Http\Controllers\laporanTransaksiMasukController;
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
Route::post('/coa/add', [App\Http\Controllers\CoaController::class, 'addData'])->name('coa.add');

Route::get('/rab', [App\Http\Controllers\RabController::class, 'index'])->name('rab.index');
Route::post('/rab', [App\Http\Controllers\RabController::class, 'sync'])->name('rab.sync');
Route::post('/rab/update', [App\Http\Controllers\RabController::class, 'update'])->name('rab.update');

Route::get('/tahun', [App\Http\Controllers\TahunAnggaranController::class, 'index'])->name('tahun.index');

Route::get('/kasMasuk', [App\Http\Controllers\kasMasukController::class, 'index'])->name('kasMasuk.index');
Route::post('/kasMasuk/simpanData', [App\Http\Controllers\kasMasukController::class, 'simpanData'])->name('kasMasuk.simpanData');

Route::get('/kasKeluar', [App\Http\Controllers\kasKeluarController::class, 'index'])->name('kasKeluar.index');
Route::post('/kasKeluar/simpanData', [App\Http\Controllers\kasKeluarController::class, 'simpanData'])->name('kasKeluar.simpanData');

Route::get('/laporanRealisasi', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
//Route::get('/laporanTransaksiKeluar', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'index'])->name('laporanTransaksiKeluar.index');
//Route::get('/laporanTransaksiMasuk', [App\Http\Controllers\laporanTransaksiMasukController::class, 'index'])->name('laporanTransaksiMasuk.index');
Route::get('/laporanTransaksiMasuk/{tanggalAwal}', [laporanTransaksiMasukController::class, 'index'])
    ->name('laporanTransaksiMasuk.index')
    ->where('tanggalAwal', '\d{4}-\d{2}-\d{2}');
Route::get('/laporanTransaksiKeluar/{tanggalAwal}', [laporanTransaksiKeluarController::class, 'index'])
    ->name('laporanTransaksiKeluar.index')
    ->where('tanggalAwal', '\d{4}-\d{2}-\d{2}');