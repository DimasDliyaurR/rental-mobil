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
use Illuminate\Support\Facades\Artisan;

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
        Route::delete("/transaksi/delete/{id}", "delete_transaksi")->name('tansaksi-delete');

        // Delete semua foto transaksi
        Route::delete("transaksi-hapus", "hapus_foto_transaksi")->name("transaksi_delete");

        //Invoice
        Route::get("/transaksi/invoice/{id}", "invoice")->name('tansaksi-invoice');

        // Update
        Route::get("/transaksi/update/{id}", "update_index")->name('transaksi-update-index');
        Route::post("/transaksi/update", "update_transaksi")->name('transaksi-update');


        // Delete Kondisi Mobil
        Route::get("kondisi_mobil/{id}/hapus", "delete_kondisi_mobil")->name("kondisi_kendaraan_delete");
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

        // Update kendaraan
        Route::get("kendaraan-update/{id}", "update_kendaraan_index")->name("kendaraan_update");
        Route::post("kendaraan/update/{id}", "update_kendaraan")->name("kendaraan_update");

        // update Brand
        Route::get("brand-update/{id}", "update_brand_index")->name("brand_update");
        Route::post("brand/update", "update_brand")->name("brand_update");

        // Status Kendaraan kembali
        Route::get("kendaraan-kembali/{id}", "update_status_kembali")->name("update_status");

        // Status Kendaraan Terbayar
        Route::get("kendaraan-bayar/{id}", "update_status_terbayar")->name("update_status");

        // Status Kendaraan Tidak Terbayar
        Route::get("kendaraan-tidak-bayar/{id}", "update_status_tidak_terbayar")->name("update_status");

        // Delete Kendaraan
        Route::get("kendaraan/{id}/hapus", "delete_kendaraan")->name("kendaraan_delete");

        // Delete Brand
        Route::get("brand/{id}/hapus", "delete_brand")->name("brand_delete");

        // History Brand
        Route::get("history-brand", "history_brand_index")->name("brand_history");
        Route::get("history-brand/restore/{id}", "restore_brand")->name("restore_history");

        // History Kendaraan
        Route::get("history-kendaraan", "history_kendaraan_index")->name("kendaraan_history");
        Route::get("history-kendaraan/restore/{id}", "restore_kendaraan")->name("kendaraan_history");

        // Collection data
        Route::get("get-kendaraan/{id}", "get_kendaraan")->name("kendaraan_get");
    });

    Route::controller(KreditDebitController::class)->group(function () {
        Route::get("/kredit-debit", "index");

        // Jadwal
        Route::get("/jadwal", "jadwal");
    });

    Route::controller(UserControlController::class)->group(function () {
        Route::get("/user-control", "tambah_index");
        Route::post("/user-control/tambah", "tambah");

        // Update
        Route::get("/user-control/update/{id}", "update_index")->name("update.user");
        Route::post("/user-control/update", "update")->name("update.user");

        // Delete
        Route::get("/user-control/hapus/{id}", "delete")->name("delete.user");
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

        // Update
        Route::get("/pengeluaran-update/{id}", "update_index")->name('pengeluaran.update');
        Route::post("/pengeluaran-update/update", "update_pengeluaran")->name('pengeluaran.update');

        // Delete
        Route::get("/pengeluaran-hapus/{id}", "delete_pengeluaran")->name('pengeluaran.delete');
    });

    // Get Event
    Route::get("/get-event", [KreditDebitController::class, "get_event"])->name("get-event");
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


Route::get('/cariKendaraan', [KendaraanController::class, 'filterKendaraan']);

Route::get("113456", [UserControlController::class, "make_owner"]);

Route::get("fresh", function () {
    Artisan::call("migrate:fresh");
});
