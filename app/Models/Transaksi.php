<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    use HasFactory;

    protected $primarykey = "id_transaksi";
    protected $table = "Transaksi";

    protected $fillable = [
        'id_kendaraan',
        'sub_total'
    ];

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo('App\Models\Kendaraan', 'kendaraan_id', 'id');
    }

    public function data_diri(): HasOne
    {
        return $this->hasOne(Data_diri::class, "transaksi_id");
    }

    public function detail_transaksi(): HasMany
    {
        return $this->hasMany(Detail_transaksi::class, "transaksi_id");
    }
}
