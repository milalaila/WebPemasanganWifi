<?php

use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KecamatanController;

use App\Http\Controllers\PaymentMethodController;
 


use App\Http\Controllers\PaketWifiController;


Route::get('/provinsi', [WilayahController::class, 'indexProvinsi']);
Route::post('/provinsi/store', [WilayahController::class, 'storeProvinsi'])->name('provinsi.store');
Route::post('/provinsi/update/{id}', [WilayahController::class, 'updateProvinsi'])->name('provinsi.update');
Route::delete('/provinsi/delete/{id}', [WilayahController::class, 'deleteProvinsi'])->name('provinsi.delete');


Route::get('/kabupaten/provinsi/{provinsiId}', [WilayahController::class, 'kabupatenByProvinsi'])->name('kabupaten.by_provinsi');
Route::post('/kabupaten/store', [WilayahController::class, 'storeKabupaten'])->name('kabupaten.store');
Route::delete('/kabupaten/{kabupaten_id}', [WilayahController::class, 'destroyKabupaten'])->name('kabupaten.delete');

Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
Route::delete('/kabupaten/{kabupaten_id}', [KabupatenController::class, 'destroy'])->name('kabupaten.delete');
Route::get('/kabupaten/edit/{id}', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
Route::put('/kabupaten/{id}', [KabupatenController::class, 'update'])->name('kabupaten.update');


Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
Route::post('/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
Route::put('/kecamatan/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
Route::delete('/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.delete');
Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');

//PELANGGAN
Route::middleware(['auth', 'userAkses:pelanggan'])->group(function() {
    Route::get('/pelanggan',[AdminController::class, 'pelanggan']);
});


Route::get('/daftar-paket', function () {
    return view('daftarpaket');
});


Route::get('/daftar-paket', [PaketWifiController::class, 'index']);

Route::resource('paketwifi', PaketWifiController::class);


Route::resource('admin/payment-methods', PaymentMethodController::class);
Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');

