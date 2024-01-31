<?php

namespace App\Livewire;

use App\Models\Brand_Kendaraan;
use Livewire\Component;
use App\Models\Kendaraan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class TambahTransaksiForm extends Component
{
    use WithFileUploads;
    public $head = ["Transaksi", "Finish"];
    public $indexLength = 1;

    // Form Data Diri

    public $foto_penyewa = "";

    public $nama_penyewa = "";

    public $no_telp = "";

    public $no_ktp = "";

    public $foto_ktp = "";

    public $no_sim = "";

    public $foto_sim = "";

    public $foto_ttd = [];

    // Form Kendaraan


    public $kendaraan_field = "";

    public $tanggal_pengambilan = "";

    public $lokasi_pengembalian = "";

    public $driver = "";

    public $durasi = "";

    public $tanggal_kembali = "";

    public $waktu_kembali = "";

    public $foto_bbm = "";

    public $jumlah_bbm = "";


    public function render()
    {
        $kendaraan = Brand_Kendaraan::all();

        return view('livewire.tambah-transaksi-form', [
            "title" => "Transaksi",
            "action" => "tambah_transaksi",
            "kendaraan" => $kendaraan,
            "kendaraan_find" => Kendaraan::class,
        ]);
    }

    public function addStep()
    {
        $lengthcapacity = count($this->head);
        // $this->validation();
        if ($this->indexLength != $lengthcapacity) {
            $this->indexLength += 1;
        } else {
            $this->indexLength = 1;
        }
    }

    public function removeStep()
    {
        if ($this->indexLength != 1) {
            $this->indexLength -= 1;
        }
    }

    public function validation()
    {
        if ($this->indexLength == 1) {
            $this->validate([
                "foto_penyewa" => "required|image|max:10240",
                "nama_penyewa" => "required",
                "no_telp" => "required",
                "no_ktp" => "required",
                "foto_ktp" => "required|image|max:10240",
                "no_sim" => "required",
                "foto_sim" => "required|image|max:10240",
                "foto_ttd" => "required",
            ], [
                "*.required" => ":attribute belum diisi",
                "foto_penyewa.max" => "Ukuran file haris dibawah 10 Mb",
                "*.image" => "Tipe file tidak valid",
            ]);
        } else {
            $this->validate([
                "kendaraan_field" => "required",
                "tanggal_pengambilan" => "required",
                "lokasi_pengembalian" => "required",
                "driver" => "required",
                "durasi" => "required",
                "tanggal_kembali" => "required",
                "waktu_kembali" => "required",
                "foto_bbm" => "required",
                "jumlah_bbm" => "required",
            ]);
        }
    }

    public function save()
    {

        $valueTransaksi = [
            "foto_penyewa" => $this->foto_penyewa,
            "nama_penyewa" => $this->nama_penyewa,
            "no_telp" => $this->no_telp,
            "no_ktp" => $this->no_ktp,
            "foto_ktp" => $this->foto_ktp,
            "no_sim" => $this->no_sim,
            "foto_sim" => $this->foto_sim,
            "kendaraan_id" => $this->kendaraan_field,
            "tanggal_sewa" => now(),
            "waktu_pengambilan" => $this->tanggal_pengambilan,
            "lokasi_pengambilan" => $this->lokasi_pengembalian,
            "driver" => $this->driver,
            "durasi" => $this->durasi,
            "tanggal_kembali" => $this->tanggal_kembali,
            "waktu_kembali" => $this->waktu_kembali,
            "foto_kondisi_bbm" => $this->foto_bbm,
            "jumlah_bbm" => $this->jumlah_bbm,
            "foto_ttd" => $this->foto_ttd,
        ];
        dd($valueTransaksi);
        DB::table('transaksi')->insert($valueTransaksi);

        return redirect()->route('tansaksi-tambah')->with('success', 'Berhasil Di Tambahkan');
    }
}
