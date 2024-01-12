<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class DataDiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        $provinsiCode = '32'; // Kode provinsi (misalnya, 32 untuk Jawa Barat)
        $kotaKabupatenCode = $faker->numberBetween(1, 99); // Kode kota atau kabupaten
        $tanggalLahir = $faker->date('dmY');
        $nomorUrut = $faker->unique()->numberBetween(1, 9999);

        $nik = $provinsiCode . $kotaKabupatenCode . $tanggalLahir . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

        // Hitung digit verifikasi
        $total = 0;
        $nikArray = str_split($nik);

        foreach ($nikArray as $key => $value) {
            $total += $value * (15 - $key);
        }

        $digitVerifikasi = $total % 11;
        $nik .= $digitVerifikasi;

        for ($i = 0; $i < 20; $i++) {
            DB::table("data_diri")->insert([
                "transaksi_id" => $faker->numberBetween(1, 20),
                "foto_penyewa" => $faker->imageUrl(240, 240, "person"),
                "nama_penyewa" => $faker->firstName(),
                "no_telp" => $faker->phoneNumber(),
                "no_ktp" => $nik,
                "foto_ktp" => $faker->imageUrl(240, 240),
                "no_sim" => $nik,
                "foto_sim" => $faker->imageUrl(240, 240),
                "foto_ttd" => $faker->imageUrl(240, 240, "signature"),
            ]);
        }
    }
}
