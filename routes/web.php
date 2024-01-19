<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(TransaksiController::class)->group(function () {
    Route::get('/transaksi', "index")->name("transaksi.lihat");
    Route::get('/transaksi/data_diri/{id}', "data_diri")->name("transaksi.datadiri");
    Route::get('/transaksi/detail_transaksi/{id}', "detail_transaksi")->name("transaksi.detailtransaksi");

    // Tambah
    Route::get("/transaksi-tambah", "tambah_index")->name('tansaksi-tambah');
    Route::post("/transaksi-tambah/tambah", "tambah_transaksi");

    //Tanda tangan
    Route::get("/transaksi-tangan/{id}", "tanda_tangan_index");
    Route::post("/transaksi-tangan/tambah", "update_tanda_tangan");
});

Route::controller(PengeluaranController::class)->group(function () {
    Route::get("/pengeluaran", "index")->name('pengeluaran.lihat');

    // Tambah
});

Route::controller(KendaraanController::class)->group(function () {
    Route::get("/kendaraan", "index")->name('kendaraan.lihat');
    Route::get("/kendaraan-tambah", "tambah_index")->name('kendaraan.tambah');
    Route::post("/kendaraan-tambah/tambah", "tambah_kendaraan");
    Route::get("/kendaraan-tambah/brand", "brand_index")->name('kendaraan.brand');
    Route::post("/kendaraan-tambah/tambah-brand", "tambah_brand")->name('kendaraan.brand.tambah');
});
