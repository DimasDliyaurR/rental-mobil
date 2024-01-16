<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class TransaksiController extends Controller
{
    // Route Start
    public function index()
    {
        $data = DB::table("kendaraan")
            ->join("transaksi", "transaksi.kendaraan_id", "=", "kendaraan.id")
            ->get();
        $url = URL::temporarySignedRoute(
            'tanda-valid',
            now()->addMinutes(10),
            [
                'id' => 1
            ]
        );

        return view("admin.transaksi.lihat", [
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
            "url" => $url,
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

    public function tanda_tangan_url($id)
    {
        $url = URL::temporarySignedRoute(
            'tanda-valid',
            now()->addMinutes(10),
            [
                'id' => $id
            ]
        );

        return view('admin.transaksi.tanda_tangan_url', [
            'title' => "Transaksi",
            "action" => "tambah_transaksi",
            'url' => $url,
        ]);
    }

    public function tanda_tangan(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return view('admin.transaksi.tanda_tangan');
    }
}
