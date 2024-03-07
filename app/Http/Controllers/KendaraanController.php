<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Brand_Kendaraan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use League\CommonMark\Node\Query\AndExpr;

class KendaraanController extends Controller
{

    public function index(Request $request)
    {
        $query = Kendaraan::select('kendaraan.*', 'brand_kendaraan.nama_brand', 'brand_kendaraan.nama_merek', 'brand_kendaraan.tahun_mobil', 'brand_kendaraan.bahan_bakar', 'brand_kendaraan.harga_sewa')
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

    public function filterKendaraan()
    {

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
            ->filter(request(['merek', 'bahan_bakar']))
            ->paginate(7)->withQueryString();

        $banyakMobil = Kendaraan::join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->select('kendaraan.*', 'brand_kendaraan.nama_brand')
            ->filter(request(['merek', 'bahan_bakar']))->count();

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
        $data = Brand_Kendaraan::latest()->paginate(5);
        return view("admin.kendaraan.brand.tambah", [
            "title" => "Kendaraan",
            "action" => "brand_kendaraan",
            "data" => $data,
        ]);
    }

    public function history_brand_index()
    {
        $data = Brand_Kendaraan::onlyTrashed()->get();

        return view("admin.kendaraan.brand.history", [
            "title" => "brand",
            "action" => "history_brand",
            "data" => $data,
        ]);
    }

    public function history_kendaraan_index()
    {
        $data = Kendaraan::onlyTrashed()->get();

        return view("admin.kendaraan.history", [
            "title" => "kendaraan",
            "action" => "history_kendaraan",
            "data" => $data,
        ]);
    }

    // Action Tambah

    public function tambah_kendaraan(Request $request)
    {
        $validation = $request->validate([
            "nama_brand" => "required",
            "plat" => "required",
        ], [
            "*.required" => ":attribute Belum Diisi",
            "plat.unique" => ":attribute sudah ada",
        ]);

        // Cek Plat Kendaraan
        $kendaraan = Kendaraan::withoutTrashed()
            ->where("plat", "=", $request->plat)
            ->get();

        if (count($kendaraan) > 0) {
            return back()->withErrors(["plat" => "plat sudah ada"]);
        }


        try {
            Kendaraan::create([
                "brand_kendaraan_id" => $request->nama_brand,
                "plat" => $request->plat,
            ]);
        } catch (\Exception $th) {
            return redirect("kendaraan-tambah")
                ->with('error', 'Silahkan coba lagi');
        }

        return redirect("kendaraan-tambah")
            ->with('success', 'Berhasil Ditambahkan');
    }

    public function update_kendaraan_index($id)
    {
        $data = Kendaraan::findOrFail($id);

        // dd($data);

        $brand = Brand_Kendaraan::get();

        return view("admin.kendaraan.update", [
            "title" => "Update Kendaraan",
            "action" => "update_kendaraan",
            "data" => $data,
            "brand" => $brand,
        ]);
    }

    public function update_brand_index($id)
    {
        $data = Brand_Kendaraan::findOrFail($id);

        return view("admin.kendaraan.brand.update", [
            "title" => "Update Brand",
            "action" => "update_brand",
            "data" => $data,
        ]);
    }

    public function tambah_brand(Request $request, TransaksiController $service)
    {
        $validation = $request->validate([
            "nama_brand" => "required",
            "nama_merek" => "required",
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
            $foto_kendaraan = $service->saveImage($request, "foto_kendaraan", "brand");

            Brand_Kendaraan::create([
                "nama_brand" => $request->nama_brand,
                "nama_merek" => $request->nama_merek,
                "foto_kendaraan" => $foto_kendaraan,
                "tahun_mobil" => $request->tahun_mobil,
                "bahan_bakar" => $request->bahan_bakar,
                "harga_sewa" => $request->harga_sewa,
            ]);
        } catch (\Exception $th) {
            return redirect('kendaraan-tambah/brand')->with('error', 'Silakan Coba Lagi');
            // dd(get_class($th));
        }

        return redirect("kendaraan-tambah/brand")->with("success", "Berhasil Menambahkan Brand " . $request->nama_kendaraan);
    }

    // Action Update status kendaraan kembali

    public function update_status_kembali($id)
    {
        return $this->update_status($id, "Tidak Terpakai");
    }

    public function update_status_terbayar($id)
    {
        return $this->update_status($id, "Sudah Terpakai");
    }

    public function update_status_tidak_terbayar($id)
    {
        return $this->update_status($id, "Booking");
    }

    // Action update status kendaraan Terbayar

    public function update_kendaraan(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan->plat != $request->plat) {

            $kendaraan_search = Kendaraan::withoutTrashed()->get();

            foreach ($kendaraan_search as $row) {
                if ($row->plat == $request->plat) {
                    return back()->withErrors([
                        "plat" => "Plat Sudah ada"
                    ]);
                }
            }
        } else {
            return back();
        }

        $validation = $request->validate([
            "nama_brand" => "required",
            "plat" => "required",
        ], [
            "required.*" => ":attribute belum diisi",
        ]);


        try {
            Kendaraan::whereId($id)->update([
                "brand_kendaraan_id" => $request->nama_brand,
                "plat" => $request->plat,
            ]);
        } catch (\Exception $th) {
            return back()->with("error", "Ups Ada sesuatu yang salah");
        }

        return back()->with("success", "Kendaraan dengan plat " . $kendaraan->plat . " berhasil update");
    }

    public function update_brand(Request $request, TransaksiController $service)
    {
        $validation = $request->validate([
            "nama_brand" => "required",
            "nama_merek" => "required",
            "foto_kendaraan" => "image|max:10240",
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

        $foto_kendaraan = $service->updateImage($request, "foto_kendaraan", "brand", "brand_kendaraan", $request->id);

        try {
            Brand_Kendaraan::findOrFail($request->id)->update([
                "nama_brand" => $request->nama_brand,
                "nama_merek" => $request->nama_merek,
                "foto_kendaraan" => $foto_kendaraan,
                "tahun_mobil" => $request->tahun_mobil,
                "bahan_bakar" => $request->bahan_bakar,
                "harga_sewa" => $request->harga_sewa,
            ]);
        } catch (\Exception $th) {
            return back()->with("error", "Ups Ada sesuatu yang salah");
        }
        return back()->with("success", "Berhasil Menambahkan Brand " . $request->nama_kendaraan);
    }

    // Action Hapus

    public function delete_kendaraan($id)
    {
        try {
            Kendaraan::whereId($id)->delete();
        } catch (\Exception $th) {
            return redirect("kendaraan")
                ->with("error", "Kendaraan gagal dihapus");
        }

        return redirect("kendaraan")
            ->with("success", "Kendaraan Berhasil Dihapus");
    }

    public function delete_brand($id)
    {
        $brand = Brand_Kendaraan::findOrFail($id);


        try {
            $findBrandOnKendaraan = Kendaraan::whereBrandKendaraanId($id)->get();
            $findBrandOnTransaksi = Transaksi::whereBrandKendaraanId($id)->join("kendaraan", "transaksi.kendaraan_id", "=", "kendaraan.id")->get();
            if (count($findBrandOnKendaraan) != 0 or count($findBrandOnTransaksi) != 0) {
                Brand_Kendaraan::whereId($brand->id)->delete();
            } else {

                unlink($brand->foto_kendaraan);
                DB::table("brand_kendaraan")->whereId($id)->delete();
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups Ada sesuatu yang salah");
        }
        return back()->with("success", "Berhasil Menghapus Brand " . $brand->nama_kendaraan);
    }

    // Un-delete Action

    public function restore_brand($id)
    {
        $brand = Brand_Kendaraan::onlyTrashed()->findOrFail($id);

        try {
            Brand_Kendaraan::onlyTrashed()->whereId($id)->restore();
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah");
        }

        return back()->with("success", "Berhasil restore data " . $brand->nama_brand . " " . $brand->nama_merek);
    }

    public function restore_kendaraan($id)
    {
        $kendaraan = Kendaraan::onlyTrashed()->findOrFail($id);

        try {
            Kendaraan::onlyTrashed()->whereId($id)->restore();
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah");
        }

        return back()->with("success", "Berhasil restore data " . $kendaraan->plat);
    }

    // Service
    public function update_status($id, $status)
    {
        $kendaraan = Kendaraan::findOrFail($id)->first();

        try {
            if ($kendaraan->status != null) {
                DB::table("kendaraan")->whereId($id)->update([
                    "status" => "$status",
                ]);
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups Ada sesuatu yang salah");
        }

        return back()->with("success", "Status Kendaraan dengan plat " . $kendaraan->plat . " berhasil diubah");
    }

    // JSON KENDARAAN

    public function get_kendaraan($id)
    {
        $data = Kendaraan::select("brand_kendaraan.harga_sewa")->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id")->where("kendaraan.id", "=", $id)->first();

        return response()->json($data);
    }
}
