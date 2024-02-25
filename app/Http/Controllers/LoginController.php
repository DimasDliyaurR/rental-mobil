<?php

namespace App\Http\Controllers;

use App\Models\Note_user;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Monolog\Level;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.login");
    }

    public function registrasi_index()
    {
        return view("login.registrasi");
    }

    public function login(Request $request)
    {
        $validation = $request->validate([
            "username" => "required",
            "password" => "required",
        ], [
            "*.required" => ":attribute belum diisi",
        ]);

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return redirect()->intended("/transaksi");
        }

        return back()->withErrors([
            "username" => "Username dan Password Tidak cocok",
        ]);
    }

    public function registrasi(Request $request)
    {
        $validation = $request->validate([
            "username" => "Required",
            "password" => "Required",
            "konfirmasi_password" => "Required|same:password",
        ]);

        DB::transaction(function () use ($request, $validation) {
            $user = User::create([
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "level" => "owner",
            ]);

            Note_user::create([
                "username" => $request->username,
                "password" => $request->password,
                "level" => "owner",
            ]);
        });

        return redirect("login")->with("success", "Berhasil menambahkan");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
