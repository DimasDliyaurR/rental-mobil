<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::all();

        return view("admin.pengeluaran.lihat", [
            "title" => "Pengeluaran",
            "action" => "lihat_pengeluaran",
            "data" => $data
        ]);
    }
}
