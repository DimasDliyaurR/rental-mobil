<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for ($i = 0; $i < 20; $i++) {
            DB::table('Brand_Kendaraan')->insert([
                'nama_kendaraan' => $faker->word,
                'foto_kendaraan' => $faker->imageUrl(180, 180, "transportasi", true, "mobil", $format = "png"),
            ]);
        }
    }
}
