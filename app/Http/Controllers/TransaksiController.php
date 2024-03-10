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
use Illuminate\Validation\Rules\Exists;

class TransaksiController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table("transaksi")
            ->select("transaksi.*", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek", "kendaraan.plat", "kendaraan.status")
            ->join("kendaraan", "kendaraan.id", "=", "transaksi.kendaraan_id")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id");

        // Pencarian (search)
        $searchKeyword = $request->input('search');
        if ($searchKeyword) {
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('transaksi.nama_penyewa', 'LIKE', "%$searchKeyword%")
                    ->orWhere('brand_kendaraan.nama_brand', 'LIKE', "%$searchKeyword%")
                    ->orWhere('brand_kendaraan.nama_merek', 'LIKE', "%$searchKeyword%")
                    ->orWhere('kendaraan.plat', 'LIKE', "%$searchKeyword%");
            });
        }

        $query->latest('transaksi.created_at');

        // Paginasi
        $data = $query->paginate(10, ['*'], 'page')->appends(request()->query());
        $title = 'Hapus Transaksi!';
        $text = "Apakah anda yakin akan hapus transaksi?";
        confirmDelete($title, $text);

        return view("admin.transaksi.lihat", [
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
            "searchKeyword" => $searchKeyword,
        ]);
    }

    // public function index()
    // {
    //     $data = DB::table("transaksi")
    //         ->select("transaksi.*", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek", "kendaraan.plat")
    //         ->join("kendaraan", "kendaraan.id", "=", "transaksi.kendaraan_id")
    //         ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
    //         ->get();

    //     return view("admin.transaksi.lihat", [
    //         "title" => "Transaksi",
    //         "action" => "lihat_transaksi",
    //         "data" => $data,
    //     ]);
    // }

    public function tambah_index()
    {
        $kendaraan = Kendaraan::withoutTrashed()->select("kendaraan.*", "kendaraan.plat", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek", "brand_kendaraan.harga_sewa")
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

        $kendaraan = Kendaraan::select("kendaraan.id", "kendaraan.plat", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id")
            ->where("kendaraan.status", "=", "Tidak Terpakai")
            ->get();

        return view('admin.transaksi.update', [
            "title" => "Update Transaksi",
            "action" => "update_transaksi",
            "kendaraan_field" => $kendaraan,
            "detail_foto_mobil" => $detail_foto_mobil,
            "data" => $data,
            "kendaraan" => Kendaraan::find($data->kendaraan_id),
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
            "promo" => "integer",
            "foto_kondisi_bbm" => "required|image|max:10240",
            "jumlah_bbm" => "required",
        ], [
            "*.required" => ":attribute belum diisi",
            "*.max" => "Ukuran file harus di bawah 10 Mb",
            "*.image" => "Tipe file tidak valid",
            "*.integer" => ":attribute harus menggunakan nomor",
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
                    "promo" => $request->promo,
                ]);

                Kendaraan::find($request->kendaraan)->update([
                    "status" => "booking",
                ]);

                $kondisi_mobil = $request->keterangan;
                foreach ($request->keterangan as $i => $value) {
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
                        "status" => "booking"
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
    public function update_transaksi(Request $request) // Bug
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
            "kondisi_mobil" => "max:10240",
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
            "*.image" => ":attribute Tipe file tidak valid",
        ]);


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

                // Update Keterangan (Lama)

                foreach ($request->keterangan_old as $key => $value) {
                    $kondisi = Detail_foto_mobil::whereTransaksiId($request->id)->whereId($request->kondisi_mobil_old_id[$key])->update([
                        "keterangan" => $request->keterangan_old[$key],
                    ]);
                }

                // Update Keterangan Kondisi Mobil (Lama)

                if ($request->kondisi_mobil_old != null) {
                    foreach ($request->kondisi_mobil_old as $i => $value) {
                        $kondisi_mobil_old = $this->updateImageMultiple($request, "foto_mobil", "kondisi_mobil_old", "foto_kondisi_mobil", $i, "detail_foto_mobils", $request->id, "transaksi_id");

                        $kondisi = Detail_foto_mobil::whereTransaksiId($request->id)->whereId($request->kondisi_mobil_old_id[$i])->update([
                            "foto_mobil" => $kondisi_mobil_old,
                        ]);
                    }
                }

                // Update Keterangan Kondisi Mobil dan Keterangan (Baru)
                if ($request->kondisi_mobil != null) {

                    foreach ($request->kondisi_mobil as $index => $value) {
                        $kondisi_mobil = $this->saveImageMultiple($request, "kondisi_mobil", "foto_kondisi_mobil", $index);

                        $kondisi = Detail_foto_mobil::create([
                            "transaksi_id" => $request->id,
                            "foto_mobil" => $kondisi_mobil,
                            "keterangan" => $request->keterangan[$index],
                        ]);
                    }
                }
            });
        } catch (\ErrorException $th) {
            return back()
                ->with("error", "Silahkan Coba lagi");
        }

        return back()->with("success", "Berhasil Update");
    }

    // Delete Action
    public function delete_transaksi($id)
    {
        try {

            $transaksi = Transaksi::find($id);

            $kondisi_mobil = Detail_foto_mobil::where("transaksi_id", $id)->get();

            $row = $transaksi->first();

            $detail_transaksi = Detail_foto_mobil::where("transaksi_id", "=", $row->id)->get();

            foreach ($detail_transaksi as $row_inner) {
                if (file_exists($row_inner->foto_mobil)) unlink($row_inner->foto_mobil);
            }

            $oldPathFotoPenyewa = file_exists($row->foto_penyewa);
            $oldPathFotoSim = file_exists($row->foto_sim);
            $oldPathFotoKtp = file_exists($row->foto_ktp);
            $oldPathFotoTandaTangan = file_exists($row->tanda_tangan);
            $oldPathFotoKondisiBBM = file_exists($row->foto_kondisi_bbm);

            if ($oldPathFotoPenyewa) unlink($row->foto_penyewa);

            if ($oldPathFotoKondisiBBM) unlink($row->foto_kondisi_bbm);

            if ($oldPathFotoSim) unlink($row->foto_sim);

            if ($oldPathFotoKtp) unlink($row->foto_ktp);

            if ($oldPathFotoTandaTangan) unlink($row->tanda_tangan);

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

    public function delete_kondisi_mobil($id)
    {
        $kondisi_mobil = Detail_foto_mobil::findOrFail($id);

        try {

            if (file_exists($kondisi_mobil->foto_mobil)) {
                unlink($kondisi_mobil->foto_mobil);
            }

            Detail_foto_mobil::whereId($kondisi_mobil->id)->delete();
        } catch (\Exception $th) {
            return back()->with("error", "ups ada yang salah");
        }
        return back();
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $data = Transaksi::select('transaksi.nama_penyewa', 'transaksi.no_telp', 'transaksi.alamat', 'transaksi.no_ktp', 'transaksi.no_sim', 'transaksi.foto_penyewa', 'transaksi.driver', 'transaksi.biaya_supir', 'transaksi.tanda_tangan', 'transaksi.tanggal_sewa', 'transaksi.durasi', 'transaksi.waktu_pengambilan', 'transaksi.lokasi_pengambilan', 'transaksi.tanggal_kembali', 'transaksi.waktu_kembali', 'transaksi.foto_ktp', 'transaksi.foto_sim', 'transaksi.foto_kondisi_bbm', 'brand_kendaraan.nama_brand', 'brand_kendaraan.nama_merek', 'brand_kendaraan.harga_sewa', 'kendaraan.plat')
            ->join('kendaraan', 'transaksi.kendaraan_id', '=', 'kendaraan.id')
            ->join('brand_kendaraan', 'kendaraan.brand_kendaraan_id', '=', 'brand_kendaraan.id')
            ->where('transaksi.id', '=', $id)
            ->get();

        $transaksi = $data[0];

        $detail_foto_mobils = DB::table("detail_foto_mobils")
            ->where("transaksi_id", "=", $id)
            ->get();

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

    public function updateImageMultiple($request, $name, $nameForm, $path, $i, $db, $id, $foregnIdName)
    {
        $data =  DB::table($db)->where($foregnIdName, $id)->pluck($name);
        $oldFilePath = $data[$i];
        // dd($request->file($nameForm)[1]);
        if ($request->file($nameForm)[$i] != null) {
            $file = $request->file($nameForm)[$i];
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

    public function filter(Request $request)
    {

        $query = DB::table("transaksi")
            ->select("transaksi.*", "brand_kendaraan.nama_brand", "brand_kendaraan.nama_merek", "kendaraan.plat")
            ->join("kendaraan", "kendaraan.id", "=", "transaksi.kendaraan_id")
            ->join("brand_kendaraan", "brand_kendaraan.id", "=", "kendaraan.brand_kendaraan_id");

        // Pencarian (search)
        $tanggal = $request->tanggal;
        if ($tanggal) {
            $query->where(function ($q) use ($tanggal) {
                $q->whereDate('transaksi.created_at', '=', $tanggal);
            });
        }
        $query->latest('transaksi.created_at');
        // Paginasi
        $data = $query->paginate(10, ['*'], 'page')->appends(request()->query());

        return view("admin.transaksi.lihat", [
            "title" => "Transaksi",
            "action" => "lihat_transaksi",
            "data" => $data,
        ]);
    }

    // Mengahapus semua foto dari transaksi
    public function hapus_foto_transaksi()
    {
        $transaksi = Transaksi::all();
        $count = 0;
        try {
            foreach ($transaksi as $row) {

                $detail_transaksi = Detail_foto_mobil::where("transaksi_id", "=", $row->id)->get();

                foreach ($detail_transaksi as $row_inner) {
                    if (file_exists($row_inner->foto_mobil)) unlink($row_inner->foto_mobil);
                }

                $oldPathFotoPenyewa = file_exists($row->foto_penyewa);
                $oldPathFotoSim = file_exists($row->foto_sim);
                $oldPathFotoKtp = file_exists($row->foto_ktp);
                $oldPathFotoTandaTangan = file_exists($row->tanda_tangan);
                $oldPathFotoKondisiBBM = file_exists($row->foto_kondisi_bbm);


                if ($oldPathFotoPenyewa or $oldPathFotoSim or $oldPathFotoKtp or $oldPathFotoTandaTangan) {
                    $count += 1;
                }

                if ($oldPathFotoPenyewa) unlink($row->foto_penyewa);

                if ($oldPathFotoKondisiBBM) unlink($row->foto_kondisi_bbm);

                if ($oldPathFotoSim) unlink($row->foto_sim);

                if ($oldPathFotoKtp) unlink($row->foto_ktp);

                if ($oldPathFotoTandaTangan) unlink($row->tanda_tangan);
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah");
        }

        return back()->with("success", "Berhasil Menghapus " . $count . " Baris");
    }
}
