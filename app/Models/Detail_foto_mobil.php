<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_foto_mobil extends Model
{
    use HasFactory;
    protected $table = "Detail_foto_mobils";

    protected $fillable = [
        "transaksi_id",
        "keterangan",
        "foto_mobil",
    ];

    public function detail_transaksi(): BelongsTo
    {
        return $this->belongsTo(Detail_transaksi::class, "transaksi_id", "id");
    }
}
