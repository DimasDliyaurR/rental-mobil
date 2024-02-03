<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\Brand_Kendaraan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class KendaraanController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table("kendaraan")
            ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id");

        // Pencarian (search)
        $searchKeyword = $request->input('search');
        if ($searchKeyword) {
            $query->where(function ($q) use ($searchKeyword) {
                $q->Where('brand_kendaraan.nama_brand', 'LIKE', "%$searchKeyword%")
                ->orWhere('brand_kendaraan.nama_merek', 'LIKE', "%$searchKeyword%")
                ->orWhere('brand_kendaraan.tahun_mobil', 'LIKE', "%$searchKeyword%")
                ->orWhere('brand_kendaraan.bahan_bakar', 'LIKE', "%$searchKeyword%")
                ->orWhere('kendaraan.plat', 'LIKE', "%$searchKeyword%");
            });
        }

        // Paginasi
        $data = $query->paginate(10, ['*'], 'page')->appends(request()->query());

        return view("admin.kendaraan.lihat", [
            "title" => "Kendaraan",
            "action" => "lihat_kendaraan",
            "data" => $data,
        ]);
    }

    // public function index()
    // {
    //     $data = DB::table("kendaraan")
    //         ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
    //         ->get();

    //     return view("admin.kendaraan.lihat", [
    //         "title" => "Kendaraan",
    //         "action" => "lihat_kendaraan",
    //         "data" => $data,
    //     ]);
    // }

    public function filterKendaraan(){

        $filterMerek = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
        ->select('kendaraan.*', 'brand_kendaraan.*')
        ->groupBy('brand_kendaraan.nama_merek')
        ->get();
        $filterBB = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
        ->select('kendaraan.*', 'brand_kendaraan.*')
        ->groupBy('brand_kendaraan.bahan_bakar')
        ->get();

        $filteredData = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
        ->select('kendaraan.*', 'brand_kendaraan.nama_brand')
        ->groupBy('brand_kendaraan.nama_merek')
        ->selectRaw('brand_kendaraan.nama_merek, COUNT(*) as count')
        ->filter(request(['merek','bahan_bakar']))
        ->paginate(7)->withQueryString();

        $banyakMobil = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
        ->select('kendaraan.*', 'brand_kendaraan.nama_brand')
        ->filter(request(['merek','bahan_bakar']))->count();

        return view('layouts.home', [
            "title" => "Kendaraan",
            "action" => "tambah_kendaraan",
            "data" => $filteredData,
            'banyakMobil' => $banyakMobil,
            'filterMerek' => $filterMerek,
            'filterBB' => $filterBB,
        ]);
    }


    public function tambah_index()
    {
        $brand = Brand_Kendaraan::all();

        return view("admin.kendaraan.tambah", [
            "title" => "Kendaraan",
            "action" => "tambah_kendaraan",
            "brand" => $brand,
        ]);
    }

    public function brand_index()
    {
        $data = Brand_Kendaraan::all();
        return view("admin.kendaraan.brand.tambah", [
            "title" => "Kendaraan",
            "action" => "brand_kendaraan",
            "data" => $data,
        ]);
    }

    public function tambah_kendaraan(Request $request)
    {
        $validation = $request->validate([
            "nama_brand" => "required",
            "plat" => "required|unique:kendaraan",
        ], [
            "*.required" => ":attribute Belum Diisi",
            "plat.unique" => ":attribute sudah ada",
        ]);

        try {
            DB::table("Kendaraan")->insert([
                "brand_kendaraan_id" => $request->nama_brand,
                "plat" => $request->plat,
                "status" => 'Tidak Terpakai',
            ]);
        } catch (\Exception $th) {
            return redirect("kendaraan-tambah")
                ->with('error', 'Silahkan coba lagi');
        }

        return redirect("kendaraan-tambah")
            ->with('success', 'Berhasil Ditambahkan');
    }

    public function tambah_brand(Request $request)
    {
        $validation = $request->validate([
            "nama_brand" => "required|unique:brand_kendaraan",
            "nama_merek" => "required|unique:brand_kendaraan",
            "foto_kendaraan" => "required|image|max:10240",
            "tahun_mobil" => "required|integer",
            "bahan_bakar" => "required",
            "harga_sewa" => "required|integer",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.integer" => ":attribute diisi menggunakan Nomor",
            "*.image" => "File tidak gambar",
            "foto_kendaraan.max" => "File terlalu besar",
            "*.unique" => ":attribute sudah ada",
        ]);


        try {
            $file = $request->file("foto_kendaraan");
            $file_type = $file->getClientOriginalExtension();
            $file_name =  preg_replace('/[^A-Za-z0-9]+/', '_', $request->nama_merek) . '.' . $file_type;
            $file_path =  'brand/' . preg_replace('/[^A-Za-z0-9]+/', '_', $request->nama_merek) . '.' . $file_type;

            DB::table("brand_kendaraan")->insert([
                "nama_brand" => $request->nama_brand,
                "nama_merek" => $request->nama_merek,
                "foto_kendaraan" => $file_path,
                "tahun_mobil" => $request->tahun_mobil,
                "bahan_bakar" => $request->bahan_bakar,
                "harga_sewa" => $request->harga_sewa,
            ]);
        } catch (\Exception $th) {
            // return redirect('kendaraan-tambah/brand')->with('error', 'Silakan Coba Lagi');
            dd(get_class($th));
        }

        $store = $file->move('brand', $file_name);

        return redirect("kendaraan-tambah/brand")->with("success", "Berhasil Menambahkan Brand " . $request->nama_kendaraan);
    }

    public function update_status($id)
    {
        $kendaraan = Kendaraan::findOrFail($id)->first();
        try {
            if ($kendaraan->status != null) {
                DB::table("kendaraan")->whereId($id)->update([
                    "status" => "Tidak Terpakai",
                ]);

                return redirect("kendaraan")->with("success", "Status Kendaraan dengan plat " . $kendaraan->plat . " berhasil diubah");
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups Ada sesuatu yang salah");
        }
    }
}
