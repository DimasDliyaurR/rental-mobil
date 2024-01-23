<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand_Kendaraan;
use App\Models\Detail_foto_mobil;

class TransaksiController extends Controller
{
    // Route Start
    public function index(Request $request)
    {
        $cari = $request->query('cari');
        if(!empty($cari)){
            $data = DB::table("kendaraan")
            ->join("transaksi", "transaksi.kendaraan_id", "=", "kendaraan.id")
            ->join("brand_kendaraan", "kendaraan.brand_kendaraan_id", "=", "brand_kendaraan.id") // Sesuaikan dengan kolom yang sesuai
            ->where("brand_kendaraan.nama_kendaraan", "like", "%" . $cari . "%")
            ->orWhere("transaksi.nama_penyewa", "like", "%" . $cari . "%")
            ->paginate(5)
            ->onEachSide(2);

        }else{
            $data = DB::table("kendaraan")
                ->join('transaksi', 'transaksi.kendaraan_id', '=', 'kendaraan.id')
                ->join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'kendaraan.id')
                ->paginate(5)
                ->onEachSide(2);

        }


        return view("admin.transaksi.lihat")->with([
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
            "cari" =>$cari,
        ]) ;
    }

    public function tambah_index()
    {
        $kendaraan = Brand_Kendaraan::all();

        return view('admin.transaksi.tambah', [
            "title" => "Transaksi",
            "action" => "tambah_transaksi",
            "kendaraan" => $kendaraan,
            "kendaraan_find" => Kendaraan::class,
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

        $validation = $request->validate([
            "kendaraan" => "required",
            "foto_penyewa" => "required|image|max:10240",
            "nama_penyewa" => "required",
            "no_telp" => "required",
            "no_ktp" => "required",
            "foto_ktp" => "required|image|max:10240",
            "no_sim" => "required",
            "foto_sim" => "required|image|max:10240",
            "tanda_tangan" => "required",
            "tanggal_sewa" => "required",
            "waktu_pengambilan" => "required",
            "lokasi_pengambilan" => "required",
            "driver" => "required",
            "durasi" => "required",
            "tanggal_kembali" => "required",
            "waktu_kembali" => "required",
            "foto_bbm" => "required|image|max:10240",
            "jumlah_bbm" => "required",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.max" => "Ukuran file haris dibawah 10 Mb",
            "*.image" => "Tipe file tidak valid",
        ]);

        DB::transaction(function () use ($request, $validation) {

            $kondisi_mobil = $request->kondisi_mobil;
            $count = count($kondisi_mobil);

            $penyewa = $this->saveImage($request, "foto_penyewa", "penyewa");
            $ktp = $this->saveImage($request, "foto_ktp", "ktp");
            $sim = $this->saveImage($request, "foto_sim", "sim");
            $bbm = $this->saveImage($request, "foto_bbm", "bbm");

            $folderPath = public_path('tanda_tangan/');
            $image_parts = explode(";base64,", $request->tanda_tangan);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $file = 'tanda_tangan/' . uniqid() . '.' . $image_type;

            $transaksi = Transaksi::create([
                "kendaraan_id" => $request->kendaraan,
                "foto_penyewa" => $penyewa,
                "nama_penyewa" => $request->nama_penyewa,
                "no_telp" => $request->no_telp,
                "no_ktp" => $request->no_ktp,
                "foto_ktp" => $ktp,
                "no_sim" => $request->no_sim,
                "foto_sim" => $sim,
                "tanda_tangan" => $file,
                "tanggal_sewa" => $request->tanggal_sewa,
                "waktu_pengambilan" => $request->waktu_pengambilan,
                "lokasi_pengambilan" => $request->lokasi_pengambilan,
                "driver" => $request->driver,
                "durasi" => $request->durasi,
                "tanggal_kembali" => $request->tanggal_kembali,
                "waktu_kembali" => $request->waktu_kembali,
                "foto_kondisi_bbm" => $bbm,
                "jumlah_bbm" => $request->jumlah_bbm,
            ]);

            for ($i = 0; $i < $count; $i++) {
                $kondisi_mobil = $this->saveImageMultiple($request, "kondisi_mobil", "foto_kondisi_mobil", $i);

                $kondisi = Detail_foto_mobil::create([
                    "transaksi_id" => $transaksi->id,
                    "keterangan" => $request->keterangan[$i],
                    "foto_mobil" => $kondisi_mobil,
                ]);
            }


            $kendaraan = DB::table("kendaraan")
                ->where('id', $request->kendaraan)
                ->update([
                    "status" => "Sudah Terpakai"
                ]);

            file_put_contents($file, $image_base64);
        });




        return redirect("transaksi-tambah")
            ->with("success", "Transaksi Berhasil");
    }

    public function saveImage($request, $name, $path)
    {
        $file = $request->file($name);
        $file_type = $file->getClientOriginalExtension();
        $file_name =  uniqid() . '.' . $file_type;
        $file_path =  $path . '/' . $file_name;
        $file->move($path, $file_name);

        return $file_path;
    }

    public function saveImageMultiple($request, $name, $path, $i)
    {
        $file = $request->file($name)[$i];
        $file_type = $file->getClientOriginalExtension();
        $file_name =  uniqid() . '.' . $file_type;
        $file_path =  $path . '/' . $file_name;
        $file->move($path, $file_name);

        return $file_path;
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
