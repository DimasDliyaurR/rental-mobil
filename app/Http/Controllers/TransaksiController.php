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
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // Route Start
    public function index()
    {
        $data = DB::table("transaksi")
            ->select("transaksi.*", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek", "kendaraan.plat")
            ->join("kendaraan", "kendaraan.id", "=", "transaksi.kendaraan_id")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
            ->get();

        return view("admin.transaksi.lihat", [
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
        ]);
    }

    public function tambah_index()
    {
        $kendaraan = DB::table("kendaraan")
            ->select("kendaraan.id", "kendaraan.plat", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
            ->where("kendaraan.status", "=", "Tidak Terpakai")
            ->get();

        return view('admin.transaksi.tambah', [
            "title" => "Transaksi",
            "action" => "tambah_transaksi",
            "kendaraan" => $kendaraan,
        ]);
    }

    public function update_index($id)
    {
        $data = Transaksi::findOrFail($id);

        $detail_foto_mobil = Detail_foto_mobil::whereTransaksiId($id)->get();

        $kendaraan = DB::table("kendaraan")
            ->select("kendaraan.id", "kendaraan.plat", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
            ->where("kendaraan.status", "=", "Tidak Terpakai")
            ->get();

        return view('admin.transaksi.update', [
            "title" => "Update Transaksi",
            "action" => "update_transaksi",
            "kendaraan_field" => $kendaraan,
            "detail_foto_mobil" => $detail_foto_mobil,
            "data" => $data,
            "kendaraan" => $data->kendaraan,
        ]);
    }


    public function detail_transaksi($id)
    {
        Transaksi::findOrFail($id);

        $data = DB::table("transaksi")->join("kendaraan", "kendaraan.id", "=", "transaksi.kendaraan_id")->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")->where("transaksi.id", $id)->first();


        $kondisi_mobil = Detail_foto_mobil::whereTransaksiId($id)->get();

        return view("admin.transaksi.detail", [
            "title" => "Detail Transaksi",
            "action" => "detail_transaksi",
            "data" => $data,
            "kondisi_mobil" => $kondisi_mobil,
        ]);
    }

    // Transaksi Action
    public function tambah_transaksi(Request $request)
    {

        $validation = $request->validate([
            "kendaraan" => "required",
            "foto_penyewa" => "required|image|max:10240",
            "nama_penyewa" => "required",
            "no_telp" => "required",
            "alamat" => "required",
            "no_ktp" => "required",
            "foto_ktp" => "required|image|max:10240",
            "no_sim" => "required",
            "foto_sim" => "required|image|max:10240",
            "tanda_tangan" => "required",
            "waktu_pengambilan" => "required",
            "lokasi_pengambilan" => "required",
            "driver" => "required",
            "durasi" => "required",
            "foto_kondisi_bbm" => "required|image|max:10240",
            "jumlah_bbm" => "required",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.max" => "Ukuran file haris dibawah 10 Mb",
            "*.image" => "Tipe file tidak valid",
        ]);


        try {
            DB::transaction(function () use ($request, $validation) {
                $tanggal_sewa_unix = time();
                $tanggal_sewa = date("Y-m-d", time());
                $waktu_pengambilan = strtotime($request->waktu_pengambilan);
                $durasi = $request->durasi * 86400;
                $tanggal_kembali = date("Y-m-d", $waktu_pengambilan + $durasi);
                $waktu_kembali = date("h:i:s", $tanggal_sewa_unix - (3600 * 5));

                // dd($tanggal_sewa, $waktu_pengambilan, $durasi, $request->durasi, $tanggal_kembali, $waktu_kembali);

                $penyewa = $this->saveImage($request, "foto_penyewa", "penyewa");
                $ktp = $this->saveImage($request, "foto_ktp", "ktp");
                $sim = $this->saveImage($request, "foto_sim", "sim");
                $bbm = $this->saveImage($request, "foto_kondisi_bbm", "bbm");

                $folderPath = public_path('tanda_tangan/');
                $image_parts = explode(";base64,", $request->tanda_tangan);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                $file = 'tanda_tangan/' . uniqid() . '.' . $image_type;

                // dd(["alamat" => $request->alamat]);
                $transaksi = Transaksi::create([
                    "kendaraan_id" => $request->kendaraan,
                    "foto_penyewa" => $penyewa,
                    "nama_penyewa" => $request->nama_penyewa,
                    "no_telp" => $request->no_telp,
                    "alamat" => $request->alamat,
                    "no_ktp" => $request->no_ktp,
                    "foto_ktp" => $ktp,
                    "no_sim" => $request->no_sim,
                    "foto_sim" => $sim,
                    "tanda_tangan" => $file,
                    "tanggal_sewa" => $tanggal_sewa,
                    "waktu_pengambilan" => $request->waktu_pengambilan,
                    "lokasi_pengambilan" => $request->lokasi_pengambilan,
                    "driver" => $request->driver,
                    "biaya_supir" => $request->biaya_supir,
                    "durasi" => $request->durasi,
                    "tanggal_kembali" => $tanggal_kembali,
                    "waktu_kembali" => $waktu_kembali,
                    "foto_kondisi_bbm" => $bbm,
                    "jumlah_bbm" => $request->jumlah_bbm,
                ]);

                $keterangan = $request->keterangan;
                for ($i = 0; $i < count($keterangan); $i++) {
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
        } catch (\ErrorException $th) {
            return redirect("transaksi-tambah")
                ->with("error", "Silahkan Coba lagi , Jangan Lupa Mengisi Kondisi Mobil");
        }

        return redirect("transaksi-tambah")
            ->with("success", "Transaksi Berhasil");
    }

    // Update Action
    public function update_transaksi(Request $request)
    {
        $validation = $request->validate([
            "kendaraan" => "required",
            "foto_penyewa" => "image|max:10240",
            "nama_penyewa" => "required",
            "no_telp" => "required",
            "alamat" => "required",
            "no_ktp" => "required",
            "foto_ktp" => "image|max:10240",
            "no_sim" => "required",
            "foto_sim" => "image|max:10240",
            "waktu_pengambilan" => "required",
            "lokasi_pengambilan" => "required",
            "driver" => "required",
            "durasi" => "required",
            "foto_kondisi_bbm" => "image|max:10240",
            "jumlah_bbm" => "required",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.max" => "Ukuran file haris dibawah 10 Mb",
            "*.image" => "Tipe file tidak valid",
        ]);
        // dd($request->all());


        try {

            DB::transaction(function () use ($request) {

                $tanggal_sewa_unix = time();
                $tanggal_sewa = date("Y-m-d", time());
                $waktu_pengambilan = strtotime($request->waktu_pengambilan);
                $durasi = $request->durasi * 86400;
                $tanggal_kembali = date("Y-m-d", $waktu_pengambilan + $durasi);
                $waktu_kembali = date("h:i:s", $tanggal_sewa_unix - (3600 * 5));

                // dd($tanggal_sewa, $waktu_pengambilan, $durasi, $request->durasi, $tanggal_kembali, $waktu_kembali);

                $penyewa = $this->updateImage($request, "foto_penyewa", "penyewa", "transaksi", $request->id);
                $ktp = $this->updateImage($request, "foto_ktp", "ktp", "transaksi", $request->id);
                $sim = $this->updateImage($request, "foto_sim", "sim", "transaksi", $request->id);
                $bbm = $this->updateImage($request, "foto_kondisi_bbm", "bbm", "transaksi", $request->id);

                //  Tanda Tangan
                $file = $this->update_tanda_tangan($request);


                // dd(["alamat" => $request->alamat]);
                $transaksi = Transaksi::whereId($request->id)->update([
                    "kendaraan_id" => $request->kendaraan,
                    "foto_penyewa" => $penyewa,
                    "nama_penyewa" => $request->nama_penyewa,
                    "no_telp" => $request->no_telp,
                    "alamat" => $request->alamat,
                    "no_ktp" => $request->no_ktp,
                    "foto_ktp" => $ktp,
                    "no_sim" => $request->no_sim,
                    "foto_sim" => $sim,
                    "tanda_tangan" => $file,
                    "tanggal_sewa" => $tanggal_sewa,
                    "waktu_pengambilan" => $request->waktu_pengambilan,
                    "lokasi_pengambilan" => $request->lokasi_pengambilan,
                    "driver" => $request->driver,
                    "biaya_supir" => $request->biaya_supir,
                    "durasi" => $request->durasi,
                    "tanggal_kembali" => $tanggal_kembali,
                    "waktu_kembali" => $waktu_kembali,
                    "foto_kondisi_bbm" => $bbm,
                    "jumlah_bbm" => $request->jumlah_bbm,
                ]);

                $keterangan = $request->keterangan;
                $kondisi_mobil_id = Detail_foto_mobil::whereTransaksiId($request->id)->get();
                for ($i = 0; $i < count($keterangan); $i++) {
                    $kondisi_mobil = $this->updateImageMultiple($request, "foto_mobil", "foto_kondisi_mobil", $i, "detail_foto_mobils", $request->id, "transaksi_id");

                    $kondisi = Detail_foto_mobil::whereTransaksiId($request->id)->whereId($kondisi_mobil_id[$i]->id)->update([
                        "keterangan" => $request->keterangan[$i],
                        "foto_mobil" => $kondisi_mobil,
                    ]);
                }
            });
        } catch (\ErrorException $th) {
            return redirect("transaksi-tambah")
                ->with("error", "Silahkan Coba lagi");
        }

        return redirect("transaksi")->with("success", "Berhasil Update");
    }

    // Delete Action
    public function delete_transaksi($id)
    {
        try {

            $transaksi = Transaksi::find($id);

            $kondisi_mobil = Detail_foto_mobil::where("transaksi_id", $id)->get();

            // dd($transaksi);
            unlink($transaksi->foto_penyewa);
            unlink($transaksi->foto_ktp);
            unlink($transaksi->foto_sim);
            unlink($transaksi->tanda_tangan);
            unlink($transaksi->foto_kondisi_bbm);

            foreach ($kondisi_mobil as $row) {
                unlink($row->foto_mobil);
            }
            DB::table("kendaraan")->where("id", $transaksi->kendaraan_id)->update([
                "status" => "Tidak Terpakai",
            ]);
            Transaksi::where('id', $id)->delete();
        } catch (\Exception $th) {
            return redirect("/transaksi")
                ->with("error", "Gagal menghapus data");
        }

        return redirect("/transaksi")->with("success", "Delete Berhasil dilakukan");
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $data = DB::table('transaksi')
            ->select('transaksi.nama_penyewa', 'transaksi.no_telp', 'transaksi.alamat', 'transaksi.no_ktp', 'transaksi.no_sim', 'transaksi.foto_penyewa', 'transaksi.driver', 'transaksi.biaya_supir', 'transaksi.tanda_tangan', 'transaksi.tanggal_sewa', 'transaksi.durasi', 'transaksi.waktu_pengambilan', 'transaksi.lokasi_pengambilan', 'transaksi.tanggal_kembali', 'transaksi.waktu_kembali', 'transaksi.foto_ktp', 'transaksi.foto_sim', 'transaksi.foto_kondisi_bbm', 'brand_kendaraan.nama_brand', 'brand_kendaraan.nama_merek', 'brand_kendaraan.harga_sewa', 'kendaraan.plat')
            ->join('kendaraan', 'transaksi.kendaraan_id', '=', 'kendaraan.id')
            ->join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->where('transaksi.id', '=', $id)
            ->get();

        $transaksi = $data[0];

        $detail_foto_mobils = DB::table("detail_foto_mobils")
            ->where("transaksi_id", "=", $id)
            ->get();

        if (request("output") == "pdf") {
            $pdf = Pdf::loadView("admin.transaksi.invoice.invoice", compact("transaksi", "detail_foto_mobils"));
            // $pdf = Pdf::loadHTML("<p>Test</p>");
            return $pdf->download("invoice.pdf");
        }

        return view("admin.transaksi.invoice.invoice", [
            "transaksi" => $transaksi,
            "detail_foto_mobils" => $detail_foto_mobils,
        ]);
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

    public function updateImage($request, $name, $path, $db, $id)
    {
        $data = DB::table($db)->where('id', $id)->first();
        $oldFilePath = $data->$name;

        if ($request->file($name) != null) {
            $file = $request->file($name);
            $file_type = $file->getClientOriginalExtension();
            $file_name =  uniqid() . '.' . $file_type;
            $file_path =  $path . '/' . $file_name;

            // Detele Old File
            if ($data->$name) {
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $file->move($path, $file_name);
            return $file_path;
        } else {
            return $oldFilePath;
        }
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

    public function updateImageMultiple($request, $name, $path, $i, $db, $id, $foregnIdName)
    {
        $data =  DB::table($db)->where($foregnIdName, $id)->pluck($name);
        $oldFilePath = $data[$i];
        if ($request->$name != null) {
            $file = $request->file($name)[$i];
            $file_type = $file->getClientOriginalExtension();
            $file_name =  uniqid() . '.' . $file_type;
            $file_path =  $path . '/' . $file_name;
            if ($data[$i]) {
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $file->move($path, $file_name);
            return $file_path;
        }

        return $oldFilePath;
    }

    public function tanda_tangan_index($id)
    {

        return view('admin.transaksi.tanda_tangan', [
            'title' => "Transaksi",
            "action" => "tambah_transaksi",
            'id' => $id,
        ]);
    }

    public function update_tanda_tangan($request)
    {
        $transaksi = DB::table('transaksi')->where('id', $request->id)->first();
        $oldFilePath = $transaksi->tanda_tangan;
        if ($request->tanda_tangan != null) {
            $image_parts = explode(";base64,", $request->tanda_tangan);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $file = 'tanda_tangan/' . uniqid() . '.' . $image_type;

            if ($transaksi->tanda_tangan) {
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            file_put_contents($file, $image_base64);
            return $file;
        }

        return $oldFilePath;
    }
}
