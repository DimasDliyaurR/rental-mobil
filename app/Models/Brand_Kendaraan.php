<?php

namespace App\Models;

use App\Models\KreditDebit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand_Kendaraan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "brand_kendaraan";
    protected $fillable = [
        "nama_brand",
        "nama_merek",
        "foto_kendaraan",
        "tahun_mobil",
        "bahan_bakar",
        "harga_sewa",
    ];

    public function kendaraan(): HasMany
    {
        return $this->hasMany(Kendaraan::class, "brand_kendaraan_id");
    }
}
