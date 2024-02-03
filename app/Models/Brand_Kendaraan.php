<?php

namespace App\Models;

use App\Models\KreditDebit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand_Kendaraan extends Model
{
    use HasFactory;

    protected $table = "Brand_Kendaraan";
    protected $fillable = [
        "nama_kendaraan",
        "foto_kendaraan",
    ];

    public function kendaraan(): HasMany
    {
        return $this->hasMany(Kendaraan::class, "brand_kendaraan_id");
    }


}
