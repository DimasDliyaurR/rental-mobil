<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $data = Kendaraan::all();

        return view("admin.kendaraan.lihat", [
            "title" => "Kendaraan",
            "action" => "lihat_kendaraan",
            "data" => $data,
        ]);
    }
}
