<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note_user;
use Laravel\Prompts\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
}
