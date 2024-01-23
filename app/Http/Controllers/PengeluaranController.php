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
        $validation = $request->validate([
            "nama_pengeluaran" => "required",
            "deskripsi_pengeluaran" => "required",
            "harga_pengeluaran" => "required|integer",
        ], [
            "*.requied" => ":attribute belum diisi",
            "*.integer" => "Yang dimaksukan bukan nomor",
        ]);

        try {
            DB::table("pengeluaran")->insert([
                "nama_pengeluaran" => "required",
                "deskripsi_pengeluaran" => "required",
                "harga_pengeluaran" => "required",
            ]);
        } catch (\Exception $th) {
            return redirect("pengeluaran-tambah")->with("error", "Coba isi kembali");
        }
    }
}
