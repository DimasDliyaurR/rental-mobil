<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Detail_foto_mobil;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailFotoMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            DB::table("Detail_foto_mobil")->insert([
                "detail_transaksi_id" => $faker->numberBetween(1, 20),
                "keterangan" => $faker->text(200),
                "foto_mobil" => $faker->imageUrl(180, 180, "transportasi", true, "mobil", $format = "png")
            ]);
        }
    }
}
