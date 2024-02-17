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
            Kendaraan::create([
                'brand_kendaraan_id' => $faker->numberBetween(1, 3), // Faker::word akan menghasilkan kata acak
                'plat' => $faker->unique()->numerify('##-###-##'), // Faker::numerify akan menghasilkan nomor acak
            ]);
        }
    }
}
