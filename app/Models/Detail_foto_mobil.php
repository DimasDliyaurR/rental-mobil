<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_foto_mobil extends Model
{
    use HasFactory;
    protected $table = "detail_foto_mobils";

    protected $fillable = [
        "transaksi_id",
        "keterangan",
        "foto_mobil",
    ];
}
