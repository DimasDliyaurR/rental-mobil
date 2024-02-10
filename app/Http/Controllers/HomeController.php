<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\Brand_Kendaraan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {

        $filterMerek = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->select('kendaraan.plat', 'brand_kendaraan.*')
            ->groupBy('brand_kendaraan.nama_merek')->get();

        $filterBB = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->select('kendaraan.*', 'brand_kendaraan.*')
            ->groupBy('brand_kendaraan.bahan_bakar')
            ->get();

        $filteredData = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->select('kendaraan.*', 'brand_kendaraan.nama_brand')
            ->groupBy('brand_kendaraan.nama_merek')
            ->selectRaw('brand_kendaraan.nama_merek, COUNT(*) as count')
            ->filter(request(['merek', 'bahan_bakar']))
            ->paginate(7)->withQueryString();

        $banyakMobil = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->select('kendaraan.*', 'brand_kendaraan.nama_brand')
            ->filter(request(['merek', 'bahan_bakar']))->count();


        // foreach ($filterMerek as $row) {
        //     echo "<br>" . $row->brand_kendaraan->nama_merek;
        // }
        // dd($filteredData);

        return view('layouts.home', [
            "title" => "Kendaraan",
            "action" => "tambah_kendaraan",
            "data" => $filteredData,
            'banyakMobil' => $banyakMobil,
            'filterMerek' => $filterMerek,
            'filterBB' => $filterBB,
        ]);
    }



    // public function home()
    // {
    //     $data = DB::table("brand_kendaraan")
    //         ->select(DB::raw("COUNT(kendaraan.status) jumlah_tersedia"), "brand_kendaraan.*")
    //         ->join("kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
    //         ->where("kendaraan.status", "=", "Tidak Terpakai")
    //         ->groupBy("brand_kendaraan.nama_brand")
    //         ->get();

    //     $jumlah = Brand_Kendaraan::select(DB::raw("COUNT(id) jumlah"))->first();

    //     // dd($data);
    //     return view('layouts/home', [
    //         "data" => $data,
    //         "jumlah" => $jumlah,
    //     ]);
    // }

    public function detail($id)
    {
        $data = Brand_Kendaraan::findOrFail($id);
        // dd($data);
        return view('layouts/detilKendaraan', [
            "data" => $data,
        ]);
    }
}
