<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserControlController extends Controller
{
    public function tambah_index()
    {
        $data = User::whereLevel("admin")->get();

        return view("admin.user-control.tambah", [
            "title" => "User",
            "action" => "user_tambah",
            "data" => $data,
        ]);
    }

    public function tambah(Request $request)
    {
        $validation = $request->validate([
            "username" => "required|unique:User",
            "password" => "required",
        ]);

        try {
            User::create($validation);
        } catch (\Throwable $th) {
            return redirect("user-control")->with("error", "Ups ada yang salah ni");
        }

        return redirect("user-control")->with("success", "Berhasil menambahkan user");
    }
}
