<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::latest();

        return view("admin.pengeluaran.lihat", [
            "title" => "Pengeluaran",
            "action" => "lihat_pengeluaran",
            "data" => $data->filter()
                ->paginate(10)->withQueryString()
        ]);
    }

    public function tambah_index()
    {
        return view("admin.pengeluaran.tambah", [
            "title" => "Pengeluaran",
            "action" => "tambah_pengeluaran",
        ]);
    }

    public function update_index($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view("admin.pengeluaran.update", [
            "title" => "Update Pengeluaran",
            "action" => "update_pengeluaran",
            "data" => $pengeluaran,
        ]);
    }

    // Action Tambah

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
            return redirect("pengeluaran-tambah")->with("error", "Coba isi kembali");
        }

        return redirect("/pengeluaran-tambah")->with("success", "Berhasil Menambahkan " . $request->nama_pengeluaran);
    }

    // Action Update

    public function update_pengeluaran(Request $request)
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
            $pengeluaran = Pengeluaran::whereId($request->id)->update([
                "nama_pengeluaran" => $request->nama_pengeluaran,
                "deskripsi_pengeluaran" => $request->deskripsi_pengeluaran,
                "harga_pengeluaran" => $request->harga_pengeluaran,
                "tanggal_pengeluaran" => date("Y-m-d", time()),
            ]);
        } catch (\Exception $th) {
            return back()->with("error", "Coba isi kembali");
        }

        return back()->with("success", "Berhasil Mengubah " . $request->nama_pengeluaran);
    }

    // Action delete
    public function delete_pengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        try {
            $pengeluaran->delete();
        } catch (\Exception $th) {
            return back()->with("error", "Coba isi kembali");
        }
        return back()->with("success", "Berhasil Menghapus");
    }

    public function filter(Request $request)
    {

        $tanggal = $request->tanggal;
        $transaksi = Pengeluaran::whereDate('created_at', '=', $tanggal)->paginate(10)->withQueryString();

        return view("admin.pengeluaran.lihat", [
            "title" => "Pengeluaran",
            "action" => "lihat_pengeluaran",
            "data" => $transaksi,
        ]);
    }
}
