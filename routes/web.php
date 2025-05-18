<?php

use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaketWifiController;
use App\Http\Controllers\OrderReviewController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SesiController;



Route::get('/', function(){
    return redirect('/login');
});

Route::get('/login', [SesiController::class, 'index'])->name('login.index');
Route::post('/login', [SesiController::class, 'login'])->name('login.store');

Route::get('/logout', [SesiController::class, 'logout'])->name('logout');


//ADMIN
Route::middleware(['auth', 'userAkses:admin'])->group(function() {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');

    //prov
    Route::get('/provinsi', [ProvinsiController::class, 'indexProvinsi'])->name('prov.index');
    Route::post('/provinsi/store', [ProvinsiController::class, 'storeProvinsi'])->name('provinsi.store');
    Route::put('/provinsi/update/{id}', [ProvinsiController::class, 'updateProvinsi'])->name('provinsi.update');
    Route::delete('/provinsi/delete/{id}', [ProvinsiController::class, 'deleteProvinsi'])->name('provinsi.delete');

    //kab
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::post('/kabupaten/store', [KabupatenController::class, 'store'])->name('kabupaten.store');
    Route::put('/kabupaten/update/{id}', [KabupatenController::class, 'update'])->name('kabupaten.update');
    Route::get('/kabupaten/edit/{id}', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
    Route::delete('/kabupaten/delete{kabupaten_id}', [KabupatenController::class, 'destroy'])->name('kabupaten.delete');

    //kec
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::post('/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/kecamatan/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::delete('/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.delete');
    Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');

    //paket
    Route::get('/daftar-paket', [PaketWifiController::class, 'index']);
    Route::resource('paketwifi', PaketWifiController::class);

    //payment method
    Route::resource('admin/payment-methods', PaymentMethodController::class);
    Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');

    Route::get('/get-kabupaten/{prov_id}', [PelangganController::class, 'getKabupaten']);
    Route::get('/get-kecamatan/{kab_id}', [PelangganController::class, 'getKecamatan']);

    Route::get('/order-review/create', [OrderReviewController::class, 'create']);
    Route::post('/order-review/store', [OrderReviewController::class, 'store']);

    Route::get('/admin/order-review', [OrderReviewController::class, 'index']);
    Route::post('/admin/order-review/accept/{id}', [OrderReviewController::class, 'accept']);
    Route::post('/admin/order-review/reject/{id}', [OrderReviewController::class, 'reject']);

    Route::get('/admin/order-review/history', [OrderReviewController::class, 'history']);
});


//PELANGGAN
Route::middleware(['auth', 'userAkses:pelanggan'])->group(function() {
    Route::get('/pelanggan',[AdminController::class, 'pelanggan']);
});

    Route::get('/registrasi', [PelangganController::class, 'register'])->name('registrasi.form');
    Route::post('/registrasi/submit', [PelangganController::class, 'submit'])->name('registrasi.submit');

