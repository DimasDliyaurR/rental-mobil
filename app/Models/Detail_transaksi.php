<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Detail_transaksi extends Model
{
    use HasFactory;
    protected $table = "detail_transaksi";
    protected $fillable = [
        "transaksi_id",
        "tanggal_sewa",
        "waktu_pengambilan",
        "lokasi_pengambilan",
        "driver",
        "durasi",
        "tanggal_kembali",
        "waktu_kembali",
        "foto_kondisi_bbm",
        "jumlah_bbm"
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, "transaksi_id", "id");
    }

    public function detail_foto_mobil(): HasMany
    {
        return $this->hasMany(Detail_foto_mobil::class, "detail_transaksi_id");
    }
}
