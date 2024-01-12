<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'unit_avaible',
        'tahun_mobil',
        'bahan_bakar',
        'harga_sewa',
        'foto_mobil',
    ];

    public function transaksi(): HasMany
    {
        return $this->HasMany('App\Models\Transaksi', 'kendaraan_id');
    }
}
