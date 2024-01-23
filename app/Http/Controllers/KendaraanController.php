<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\Brand_Kendaraan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class KendaraanController extends Controller
{
    public function index()
    {
        $data = DB::table("kendaraan")
            ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")
            ->get();

        return view("admin.kendaraan.lihat", [
            "title" => "Kendaraan",
            "action" => "lihat_kendaraan",
            "data" => $data,
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
            "nama_kendaraan" => "required",
            "plat" => "required",
        ], [
            "*.required" => ":attribute Belum Diisi",
        ]);

        try {
            DB::table("Kendaraan")->insert([
                "brand_kendaraan_id" => $request->nama_kendaraan,
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
            "nama_kendaraan" => "required",
            "foto_kendaraan" => "required|image|max:10240",
            "tahun_mobil" => "required|integer",
            "bahan_bakar" => "required",
            "harga_sewa" => "required|integer|max_digits:6",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.integer" => ":attribute diisi menggunakan Nomor",
            "*.image" => "File tidak gambar",
            "harga_sewa.max_digits" => "Maksimal 6 Digit",
            "foto_kendaraan.max" => "File terlalu besar",
        ]);


        try {
            $file = $request->file("foto_kendaraan");
            $file_type = $file->getClientOriginalExtension();
            $file_name =  preg_replace('/[^A-Za-z0-9]+/', '_', $request->nama_kendaraan) . '.' . $file_type;
            $file_path =  'brand/' . preg_replace('/[^A-Za-z0-9]+/', '_', $request->nama_kendaraan) . '.' . $file_type;

            DB::table("brand_kendaraan")->insert([
                "nama_kendaraan" => $request->nama_kendaraan,
                "foto_kendaraan" => $file_path,
                "tahun_mobil" => $request->tahun_mobil,
                "bahan_bakar" => $request->bahan_bakar,
                "harga_sewa" => $request->harga_sewa,
            ]);
        } catch (\Exception $th) {
            return redirect('kendaraan-tambah/brand')->with('error', 'Silahkan Coba Lagi');
        }

        $store = $file->move('brand', $file_name);

        return redirect("kendaraan-tambah/brand")->with("success", "Berhasil Menambahkan Brand " . $request->nama_kendaraan);
    }
}
