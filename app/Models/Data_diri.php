<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data_diri extends Model
{
    use HasFactory;

    protected $table = "data_diri";
    protected $timestamp = false;
    protected $fillable = [
        "foto_penyewa",
        "nama_penyewa",
        "no_telp",
        "no_ktp",
        "foto_ktp",
        "no_sim",
        "foto_sim",
        "foto_ttd",
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, "transaksi_id", "id");
    }
}
