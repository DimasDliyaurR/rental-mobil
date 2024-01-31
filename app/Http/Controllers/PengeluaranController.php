<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::all();

        return view("admin.pengeluaran.lihat", [
            "title" => "Pengeluaran",
            "action" => "lihat_pengeluaran",
            "data" => $data
        ]);
    }

    public function tambah_index()
    {
        return view("admin.pengeluaran.tambah", [
            "title" => "Pengeluaran",
            "action" => "tambah_pengeluaran",
        ]);
    }

    public function tambah_pengeluaran(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            "nama_pengeluaran" => "required",
            "deskripsi_pengeluaran" => "required",
            "harga_pengeluaran" => "required|integer",
        ], [
            "*.requied" => ":attribute belum diisi",
            "*.integer" => "Yang dimaksukan bukan nomor",
        ]);

        try {
            $pengeluaran = Pengeluaran::create([
                "nama_pengeluaran" => $request->nama_pengeluaran,
                "deskripsi_pengeluaran" => $request->deskripsi_pengeluaran,
                "harga_pengeluaran" => $request->harga_pengeluaran,
                "tanggal_pengeluaran" => date("Y-m-d", time()),
            ]);
        } catch (\Exception $th) {
            dd(get_class($th));
            return redirect("pengeluaran-tambah")->with("error", "Coba isi kembali");
        }

        return redirect("/pengeluaran-tambah")->with("success", "Berhasil Menambahkan " . $request->nama_pengeluaran);
    }
}
