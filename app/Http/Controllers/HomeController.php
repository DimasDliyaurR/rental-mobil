<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand_Kendaraan;

class HomeController extends Controller
{
    public function home()
    {
        $data = DB::table("brand_kendaraan")
            ->select(DB::raw("COUNT(kendaraan.status) jumlah_tersedia"), "brand_kendaraan.*")
            ->join("kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
            ->where("kendaraan.status", "=", "Tidak Terpakai")
            ->groupBy("brand_kendaraan.nama_brand")
            ->get();

        $jumlah = Brand_Kendaraan::select(DB::raw("COUNT(id) jumlah"))->first();

        // dd($data);
        return view('layouts/home', [
            "data" => $data,
            "jumlah" => $jumlah,
        ]);
    }

    public function detail($id)
    {
        $data = Brand_Kendaraan::findOrFail($id);
        // dd($data);
        return view('layouts/detilKendaraan', [
            "data" => $data,
        ]);
    }
}
