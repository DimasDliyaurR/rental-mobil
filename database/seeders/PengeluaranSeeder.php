<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for ($i = 0; $i < 20; $i++) {
            DB::table("pengeluaran")->insert([
                "nama_pengeluaran" => $faker->word(2, true),
                "deskripsi_pengeluaran" => $faker->paragraph(2, false),
                "harga_pengeluaran" => $faker->numberBetween(1000, 20000000),
                "tanggal_pengeluaran" => $faker->dateTimeBetween(now(), "+2 month"),
            ]);
        }
    }
}
