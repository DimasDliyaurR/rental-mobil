<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\KreditDebit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = "pengeluaran";
    protected $dates = ["tanggal_pengaluran"];
    protected $fillable = [
        "nama_pengeluaran",
        "deskripsi_pengeluaran",
        "harga_pengeluaran",
        "tanggal_pengeluaran",
    ];

    public function dateFormat($value)
    {
        Carbon::parse($value)->translatedFormat("d F Y");
    }

    public function scopeFilter($query){
        if (request('search')) {
            return $query
            ->where('nama_pengeluaran','like','%'.request('search').'%');
        }
    }


}
