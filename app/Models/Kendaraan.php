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


    public function scopeFilter($query, array $filters){

        $query->when($filters['merek'] ?? false, function($query, $search){
            return $query
            ->where('brand_kendaraan.nama_merek','like','%'.$search.'%');
        });

        $query->when($filters['bahan_bakar'] ?? false, function($query, $bahan_bakar){
            return $query->whereHas('brand_kendaraan',function($query) use ($bahan_bakar){
                $query->where('brand_kendaraan.bahan_bakar',$bahan_bakar);
            });
        });

        // Tambahkan kondisi untuk status tidak terpakai
        $query->where('status', '=', 'Tidak Terpakai');

    }
}
