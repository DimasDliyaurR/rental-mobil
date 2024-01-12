<?php

namespace Database\Seeders;

use DateInterval;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");
        $tanggal_sewa = $faker->dateTimeThisYear;
        $durasi = $faker->numberBetween(1, 7); // Durasi sewa antara 1-7 hari

        for ($i = 0; $i < 20; $i++) {
            DB::table('Detail_transaksi')->insert([
                'transaksi_id' => $faker->numberBetween(1, 10), // Ganti 10 dengan jumlah transaksi yang tersedia
                'tanggal_sewa' => $tanggal_sewa,
                'waktu_pengambilan' => $faker->dateTimeBetween($tanggal_sewa, '+1 week'),
                'lokasi_pengambilan' => $faker->address,
                'driver' => $faker->boolean,
                'durasi' => $faker->dateTimeBetween($tanggal_sewa, "+2 Week"), // Menambahkan durasi hari ke tanggal sewa
                'tanggal_kembali' => $faker->dateTimeInInterval($tanggal_sewa, "+{$durasi} days"),
                'waktu_kembali' => $faker->time('H:i'),
                'foto_kondisi_bbm' => $faker->imageUrl(640, 480, 'transport'), // Contoh URL gambar, Anda bisa sesuaikan dengan kebutuhan
                'jumlah_bbm' => $faker->numberBetween(1, 6),
            ]);
        }
    }
}
