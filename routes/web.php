<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\kasKeluarController;
use App\Http\Controllers\laporanTransaksiKeluarController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// MASTER
Route::get('/coa', [App\Http\Controllers\CoaController::class, 'index'])->name('coa.index');
Route::post('/coa/add', [App\Http\Controllers\CoaController::class, 'addData'])->name('coa.add');
Route::delete('/coa/delete/{id}', [App\Http\Controllers\CoaController::class, 'deleteData'])->name('coa.delete');
Route::put('coa/{id}/update', [App\Http\Controllers\CoaController::class, 'editData'])->name('coa.update');

Route::get('/rab', [App\Http\Controllers\RabController::class, 'index'])->name('rab.index');
Route::post('/rab', [App\Http\Controllers\RabController::class, 'sync'])->name('rab.sync');
Route::post('/rab/update', [App\Http\Controllers\RabController::class, 'update'])->name('rab.update');
Route::post('/rab', function () {
    return redirect()->back();
})->name('refresh');

Route::get('/tahun', [App\Http\Controllers\TahunAnggaranController::class, 'index'])->name('tahun.index');
Route::post('/tahun/tutup', [App\Http\Controllers\TahunAnggaranController::class, 'tutup'])->name('tahun.tutup');

Route::get('/kas', [App\Http\Controllers\kasController::class, 'index'])->name('kas.index');
Route::post('/kas/add', [App\Http\Controllers\kasController::class, 'addData'])->name('kas.add');
Route::delete('/kas/delete/{id}', [App\Http\Controllers\kasController::class, 'deleteData'])->name('kas.delete');
Route::put('kas/{id}/update', [App\Http\Controllers\kasController::class, 'editData'])->name('kas.update');

// TRANSAKSI
Route::get('/kasMasuk', [App\Http\Controllers\kasMasukController::class, 'index'])->name('kasMasuk.index');
Route::post('/kasMasuk/simpanData', [App\Http\Controllers\kasMasukController::class, 'simpanData'])->name('kasMasuk.simpanData');

Route::get('/kasKeluar', [App\Http\Controllers\kasKeluarController::class, 'index'])->name('kasKeluar.index');
Route::post('/kasKeluar/simpanData', [App\Http\Controllers\kasKeluarController::class, 'simpanData'])->name('kasKeluar.simpanData');

// LAPORAN
Route::get('/laporanRealisasi', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporanRealisasi/cetak', [App\Http\Controllers\LaporanController::class, 'cetak'])->name('laporan.cetak');

Route::get('/laporanTransaksiKeluar', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'index'])->name('laporanTransaksiKeluar.index');
Route::delete('/laporanTransaksiKeluar/delete/{id}', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'deleteData'])->name('laporanTransaksiKeluar.delete');
Route::put('laporanTransaksiKeluar/{id}/update', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'editData'])->name('laporanTransaksiKeluar.update');
Route::get('/laporanTransaksiKeluar/cetak', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'cetak'])->name('laporanKeluar.cetak');

Route::get('/laporanTransaksiMasuk', [App\Http\Controllers\laporanTransaksiMasukController::class, 'index'])->name('laporanTransaksiMasuk.index');
Route::delete('/laporanTransaksiMasuk/delete/{id}', [App\Http\Controllers\laporanTransaksiMasukController::class, 'deleteData'])->name('laporanTransaksiMasuk.delete');
Route::put('laporanTransaksiMasuk/{id}/update', [App\Http\Controllers\laporanTransaksiMasukController::class, 'editData'])->name('laporanTransaksiMasuk.update');
Route::get('/laporanTransaksiMasuk/cetak', [App\Http\Controllers\laporanTransaksiMasukController::class, 'cetak'])->name('laporanMasuk.cetak');

Route::get('/arusKas', [App\Http\Controllers\arusKasController::class, 'index'])->name('arusKas.index');
Route::get('/arusKas/cetak', [App\Http\Controllers\arusKasController::class, 'cetak'])->name('laporanArus.cetak');

Route::get('/laporanTotalKas', [App\Http\Controllers\totalKasController::class, 'index'])->name('laporanTotalKas.index');
Route::get('/laporanTotalKas/cetak', [App\Http\Controllers\totalKasController::class, 'cetak'])->name('laporanTotal.cetak');

//ubah password
Route::get('/ubah', [App\Http\Controllers\ubahController::class, 'index'])->name('ubah.index');
Route::post('/ubah', [App\Http\Controllers\ubahController::class, 'changePassword'])->name('ubah.changePassword');

//Login with google
Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

//Diagram
Route::get('/chart', [App\Http\Controllers\chartController::class, 'index'])->name('chart.index');

//Calendar
Route::get('/kalender', [App\Http\Controllers\kalenderController::class, 'index'])->name('kalender.index');

// Collapse table
Route::get('/collapse', [App\Http\Controllers\collapseController::class, 'index'])->name('collapse.index');

//example
Route::get('/keluar', [App\Http\Controllers\keluarController::class, 'index'])->name('keluar.index');
Route::post('/keluar/simpanData', [App\Http\Controllers\keluarController::class, 'simpanData'])->name('keluar.simpanData');
Route::get('/laporanTransaksiKeluar/updateKelompok/{id}', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'updateKelompok'])->name('laporanTransaksiKeluar.updateKelompok');
//Route::post('/keluar/editNew', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'editNew'])->name('keluar.editNew');
Route::post('/keluar/editData', [App\Http\Controllers\laporanTransaksiKeluarController::class, 'editDatanew'])->name('keluar.editData');


Route::get('/masuk', [App\Http\Controllers\masukController::class, 'index'])->name('masuk.index');
Route::post('/masuk/simpanData', [App\Http\Controllers\masukController::class, 'simpanData'])->name('masuk.simpanData');
//Route::get('/masuk/edit/{no_kwitansi}', [App\Http\Controllers\laporanTransaksiMasukController::class, 'editButton'])->name('masuk.editButton');
Route::get('/laporanTransaksiMasuk/updateKelompok/{id}', [App\Http\Controllers\laporanTransaksiMasukController::class, 'updateKelompok'])->name('laporanTransaksiMasuk.updateKelompok');
//Route::post('/masuk/editNew', [App\Http\Controllers\laporanTransaksiMasukController::class, 'editNew'])->name('masuk.editNew');
Route::post('/masuk/editData', [App\Http\Controllers\laporanTransaksiMasukController::class, 'editDatanew'])->name('masuk.editData');
