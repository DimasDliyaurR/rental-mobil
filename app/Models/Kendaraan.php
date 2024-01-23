<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    use HasFactory;

    /** 
     * Primary Key Kendaraan
     * **/

    protected $primarykey = "id_kendaraan";

    /** 
     *
     * Declaration Kendaraan
     *  
     */


    protected $table = "Kendaraan";

    protected $fillable = [
        'nama_kendaraan',
        'plat',
        'status',
    ];

    public function transaksi(): HasMany
    {
        return $this->HasMany('App\Models\Transaksi', 'kendaraan_id');
    }

    public function brand_kendaraan(): BelongsTo
    {
        return $this->belongsTo(Brand_Kendaraan::class, 'brand_kendaraan_id', 'id');
    }
}
