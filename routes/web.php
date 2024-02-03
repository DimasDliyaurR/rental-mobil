<?php

use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KreditDebitController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserControlController;

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

Route::middleware(["auth", "owner"])->group(function () {
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', "index")->name("transaksi.lihat");
        Route::get('/transaksi/filter', "filter");
        Route::get('/transaksi/data_diri/{id}', "data_diri")->name("transaksi.datadiri");
        Route::get('/transaksi/detail_transaksi/{id}', "detail_transaksi")->name("transaksi.detailtransaksi");

        // Tambah
        Route::get("/transaksi-tambah", "tambah_index")->name('tansaksi-tambah');
        Route::post("/transaksi-tambah/tambah", "tambah_transaksi");

        // Delete
        Route::get("/transaksi/delete/{id}", "delete_transaksi")->name('tansaksi-delete');

        //Invoice
        Route::get("/transaksi/invoice/{id}", "invoice")->name('tansaksi-invoice');

        // Update
        Route::get("/transaksi/update/{id}", "update_index")->name('transaksi-update-index');
        Route::post("/transaksi/update", "update_transaksi")->name('transaksi-update');
    });

    Route::controller(PengeluaranController::class)->group(function () {
        Route::get("/pengeluaran", "index")->name('pengeluaran.lihat');
        Route::get("/pengeluaran/filter", "filter")->name('pengeluaran.lihat');
        Route::get("/pengeluaran-tambah", "tambah_index")->name('pengeluaran.tambah');
        Route::post("/pengeluaran-tambah/tambah", "tambah_pengeluaran")->name('pengeluaran.tambah');
        // Tambah
    });

    Route::controller(KendaraanController::class)->group(function () {
        Route::get("/kendaraan", "index")->name('kendaraan.lihat');
        Route::get("/kendaraan-tambah", "tambah_index")->name('kendaraan.tambah');
        Route::post("/kendaraan-tambah/tambah", "tambah_kendaraan");
        Route::get("/kendaraan-tambah/brand", "brand_index")->name('kendaraan.brand');
        Route::post("/kendaraan-tambah/tambah-brand", "tambah_brand")->name('kendaraan.brand.tambah');

        // Update Status kendaraan
        Route::get("kendaraan/{id}", "update_status")->name("kendaraan_status");
    });

    Route::controller(KreditDebitController::class)->group(function () {
        Route::get("/kredit-debit", "index");
    });

    Route::controller(UserControlController::class)->group(function () {
        Route::get("/user-control", "tambah_index");
        Route::post("/user-control/tambah", "tambah");
    });
});

Route::middleware(["auth"])->group(function () {
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', "index")->name("transaksi.lihat");
        Route::get('/transaksi/data_diri/{id}', "data_diri")->name("transaksi.datadiri");
        Route::get('/transaksi/detail_transaksi/{id}', "detail_transaksi")->name("transaksi.detailtransaksi");

        // Tambah
        Route::get("/transaksi-tambah", "tambah_index")->name('tansaksi-tambah');
        Route::post("/transaksi-tambah/tambah", "tambah_transaksi");

        // Delete
        Route::get("/transaksi/delete/{id}", "delete_transaksi")->name('tansaksi-delete');

        //Invoice
        Route::get("/transaksi/invoice/{id}", "invoice")->name('tansaksi-invoice');

        // Update
        Route::get("/transaksi/update/{id}", "update_index")->name('transaksi-update-index');
        Route::post("/transaksi/update", "update_transaksi")->name('transaksi-update');
    });

    Route::controller(PengeluaranController::class)->group(function () {
        Route::get("/pengeluaran-tambah", "tambah_index")->name('pengeluaran.tambah');
        Route::post("/pengeluaran-tambah/tambah", "tambah_pengeluaran")->name('pengeluaran.tambah');
    });
});


Route::controller(LoginController::class)->group(function () {
    Route::get("/login", "index")->name("login")->middleware('guest');
    Route::post("/login", "login");
    Route::get("/registrasi", "registrasi_index")->name("registrasi")->middleware('guest');
    Route::post("/registrasi", "registrasi");

    Route::get("/logout", "logout")->name("logout");
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/', "home");
    Route::get('/detil/{id}', "detail");
});


Route::get('/cariKendaraan',[KendaraanController::class, 'filterKendaraan']);
