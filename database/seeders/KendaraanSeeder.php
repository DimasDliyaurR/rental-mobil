<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for ($i = 0; $i < 20; $i++) {
            DB::table('Kendaraan')->insert([
                'nama_kendaraan' => $faker->word, // Faker::word akan menghasilkan kata acak
                'plat' => $faker->numerify('##-###-##'), // Faker::numerify akan menghasilkan nomor acak
                'unit_available' => $faker->numberBetween(1, 50), // Faker::numberBetween akan menghasilkan angka acak dalam range tertentu
                'tahun_mobil' => $faker->year,
                'bahan_bakar' => $faker->randomElement(['Bensin', 'Solar', 'Gas']),
                'harga_sewa' => $faker->numberBetween(100000, 1000000),
                'foto_mobil' => $faker->imageUrl(180, 180, "transportasi", true, "mobil", $format = "png"),
            ]);
        }
    }
}
