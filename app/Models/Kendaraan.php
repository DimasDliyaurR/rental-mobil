<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Primary Key Kendaraan
     * **/

    protected $primarykey = "id_kendaraan";

    /**
     *
     * Declaration Kendaraan
     *
     */


    protected $table = "kendaraan";

    protected $fillable = [
        'brand_kendaraan_id',
        'nama_kendaraan',
        'plat',
        'status',
    ];

    public function transaksi()
    {
        return $this->HasMany(Transaksi::class);
    }

    public function brand_kendaraan()
    {
        return $this->belongsTo(Brand_Kendaraan::class);
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['merek'] ?? false, function ($query, $search) {
            return $query
                ->where('brand_kendaraan.nama_merek', 'like', '%' . $search . '%');
        });

        $query->when($filters['bahan_bakar'] ?? false, function ($query, $bahan_bakar) {
            return $query->whereHas('brand_kendaraan', function ($query) use ($bahan_bakar) {
                $query->where('brand_kendaraan.bahan_bakar', $bahan_bakar);
            });
        });

        // Tambahkan kondisi untuk status tidak terpakai
        $query->where('status', '=', 'Tidak Terpakai');
    }
}
