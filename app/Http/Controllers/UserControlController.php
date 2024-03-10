<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note_user;
use Exception;
use Laravel\Prompts\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserControlController extends Controller
{

    // Tambah

    public function tambah_index()
    {
        $data = Note_user::whereLevel("admin")->get();

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
            DB::transaction(function () use ($request, $validation) {
                User::create([
                    "username" => $request->username,
                    "password" => $request->password,
                    "level" => "admin",
                ]);

                Note_user::create([
                    "username" => $request->username,
                    "password" => $request->password,
                    "level" => "admin",
                ]);
            });
        } catch (\Exception $th) {
            return redirect("user-control")->with("error", "Ups ada yang salah ni");
        }

        return redirect("user-control")->with("success", "Berhasil menambahkan user");
    }

    // Update

    public function update_index($id)
    {
        $data = Note_user::whereId($id)->first();

        return view("admin.user-control.update", [
            "title" => "Jadwal",
            "action" => "lihat_jadwal",
            "data" => $data,
        ]);
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            "username" => "required",
            "password" => "required",
        ], [
            "*.required" => ":attribute belum diisi"
        ]);
        try {
            DB::transaction(function () use ($request, $validation) {
                $user = User::findOrFail($request->id);

                $user->update([
                    "username" => $request->username,
                    "password" => $request->password,
                    "level" => "admin",
                ]);

                Note_user::findOrFail($request->id)->update([
                    "username" => $request->username,
                    "password" => $request->password,
                ]);
            });
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah");
        }

        return back()->with("success", "Berhasil Mengubah User");
    }

    // Delete

    public function delete($id)
    {
        $user = User::whereId($id)->first();

        if ($user->level == "owner") {
            return abort(404);
        }

        try {
            User::whereId($id)->delete();
            Note_user::whereId($id)->delete();
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah");
        }
        return back()->with("success", "Berhasil menghapus");
    }

    public function make_owner()
    {
        Artisan::call("db:seed --class=UserSeeder");
        return redirect("login");
    }

    public function ubah_password_index()
    {
        return view("admin.user-control.ubah-sandi", [
            "title" => "User",
            "action" => "user_ubah",
        ]);
    }

    public function ubah_password(Request $request, User $user)
    {
        $validation = $request->validate([
            "username" => "required",
            "password_lama" => "required",
            "password_baru" => "required",
        ], [
            "*.required" => ":attribute belum diisi"
        ]);
        $data = $user::whereUsername($request->username);
        if (count($data->get()) <= 0) {
            return back()->withErrors([
                "username" => "Username tidak cocok",
            ]);
        }

        $PwData = $data->first();

        try {
            if (Hash::check($request->password_lama, $PwData->password)) {
                $data->update([
                    "password" => Hash::make($request->password_baru),
                ]);
            } else {
                return back()->withErrors([
                    "password_lama" => "Password lama tidak cocok",
                ]);
            }
        } catch (\Exception $e) {
            return back()->with("error", "Ups ada yang error");
        }

        return back()->with("success", "Berhasil mengubah sandi");
    }
}
