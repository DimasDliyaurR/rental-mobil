<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KreditDebitController extends Controller
{
    public function index()
    {
        $transaksi = DB::table("transaksi")
            ->select(DB::raw("SUM(brand_kendaraan.harga_sewa * transaksi.durasi) jumlah_transaksi"))
            ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
            ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
            ->groupBy("transaksi.nama_penyewa")
            ->get();

        $pengeluaran = DB::table("pengeluaran")
            ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"), "pengeluaran.*")
            ->groupBy("pengeluaran.harga_pengeluaran", "pengeluaran.id", "pengeluaran.nama_pengeluaran", "pengeluaran.deskripsi_pengeluaran", "pengeluaran.tanggal_pengeluaran", "pengeluaran.created_at", "pengeluaran.updated_at")
            ->get();

        $total_pengeluaran = DB::table("pengeluaran")
            ->select(DB::raw("SUM(pengeluaran.harga_pengeluaran) total_pengeluaran"))
            ->get();

        $total_transaksi = DB::table("transaksi")
            ->select(DB::raw("SUM((brand_kendaraan.harga_sewa * transaksi.durasi)+transaksi.biaya_supir) total_transaksi"))
            ->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")
            ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
            ->get();

        // dd($total_pengeluaran);

        return view("admin.kredit_debit.lihat", [
            "title" => "Kredit Debit",
            "action" => "Kredit_Debit_Lihat",
            "transaksi" => $transaksi,
            "pengeluaran" => $pengeluaran,
            "total_pengeluaran" => $total_pengeluaran[0],
            "total_transaksi" => $total_transaksi[0],
        ]);
    }
}
