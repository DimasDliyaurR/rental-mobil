<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_foto_mobil extends Model
{
    use HasFactory;
    protected $table = "Detail_foto_mobil";
    protected $timetamp = false;
    public function detail_transaksi(): BelongsTo
    {
        return $this->belongsTo(Detail_transaksi::class, "detail_transaksi_id", "id");
    }
}
