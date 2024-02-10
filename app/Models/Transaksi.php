<?php

namespace App\Models;

use App\Models\KreditDebit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaksi extends Model
{
    use HasFactory;

    protected $primarykey = "id_transaksi";
    protected $table = "Transaksi";
    protected $dates = ["waktu_kembali", "tanggal_kembali", "waktu_pengambilan"];

    protected $fillable = [
        "kendaraan_id",
        "foto_penyewa",
        "nama_penyewa",
        "no_telp",
        "alamat",
        "no_ktp",
        "foto_ktp",
        "no_sim",
        "foto_sim",
        "tanda_tangan",
        "tanggal_sewa",
        "biaya_supir",
        "waktu_pengambilan",
        "lokasi_pengambilan",
        "driver",
        "durasi",
        "tanggal_kembali",
        "waktu_kembali",
        "foto_kondisi_bbm",
        "jumlah_bbm",
    ];

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function data_diri(): HasOne
    {
        return $this->hasOne(Data_diri::class, "transaksi_id");
    }

    public function detail_transaksi(): HasMany
    {
        return $this->hasMany(Detail_transaksi::class, "transaksi_id");
    }

    public function detail_foto_mobil(): HasMany
    {
        return $this->hasMany(Detail_foto_mobil::class, "detail_transaksi_id");
    }

    public function brand_kendaraan()
    {
        return $this->hasMany(\App\Models\Kendaraan::class);
    }
}
