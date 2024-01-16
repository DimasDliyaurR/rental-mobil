<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Route Start
    public function index()
    {
        $data = DB::table("kendaraan")
            ->join("transaksi", "transaksi.kendaraan_id", "=", "kendaraan.id")
            ->join("data_diri", "data_diri.transaksi_id", "=", "transaksi.id")
            ->get();

        return view("admin.transaksi.lihat", [
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
        ]);
    }

    public function tambah_index()
    {
        $kendaraan = Kendaraan::all();
        return view("admin.transaksi.tambah", [
            "title" => "Transaksi",
            "action" => "tambah_transaksi",
            "kendaraan" => $kendaraan,
        ]);
    }

    // Route End

    public function data_diri($id)
    {
        $data = DB::table("data_diri")
            ->where("transaksi_id", "=", $id)->get();

        return dd($data);
    }

    public function detail_transaksi($id)
    {
        $data = DB::table("detail_transaksi")->where("transaksi_id", "=", $id)->get();
        return dd($data);
    }

    // Transaksi Action
    public function tambah_transaksi(Request $request)
    {
        return dd($request->all());
    }
}
