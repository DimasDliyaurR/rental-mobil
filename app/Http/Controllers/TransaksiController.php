<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    // Route Start
    public function index()
    {
        $data = DB::table("kendaraan")
            ->join("transaksi", "transaksi.kendaraan_id", "=", "kendaraan.id")
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
        $data = Transaksi::find($id);

        return dd($data);
    }

    public function detail_transaksi($id)
    {
        $data = Transaksi::find($id);
        return dd($data);
    }

    // Transaksi Action
    public function tambah_transaksi(Request $request)
    {
        return dd($request->all());
    }

    public function tanda_tangan_index($id)
    {

        return view('admin.transaksi.tanda_tangan', [
            'title' => "Transaksi",
            "action" => "tambah_transaksi",
            'id' => $id,
        ]);
    }

    public function update_tanda_tangan(Request $request)
    {
        $folderPath = public_path('tanda_tangan/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $file = 'tanda_tangan/' . uniqid() . '.' . $image_type;

        $transaksi = DB::table('transaksi')->where('id', $request->id)->first();
        if ($transaksi->foto_ttd) {
            $oldFilePath = public_path($transaksi->foto_ttd);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        DB::table('transaksi')
            ->where('id', $request->id)
            ->update([
                'foto_ttd' => $file
            ]);
        file_put_contents($file, $image_base64);
        return redirect("transaksi");
    }
}
