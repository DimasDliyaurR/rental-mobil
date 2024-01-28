<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
}
