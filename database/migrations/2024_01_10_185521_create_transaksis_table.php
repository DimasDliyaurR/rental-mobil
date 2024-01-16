<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->nullable()->index('fk_Transaksi_to_Kendaraan');
            $table->string("foto_penyewa");
            $table->string("nama_penyewa");
            $table->string("no_telp");
            $table->string("no_ktp");
            $table->string("foto_ktp");
            $table->string("no_sim");
            $table->string("foto_sim");
            $table->string("foto_ttd")->nullable();
            $table->date("tanggal_sewa");
            $table->date("waktu_pengambilan");
            $table->string("lokasi_pengambilan");
            $table->boolean("driver")->nullable();
            $table->integer("durasi");
            $table->date("tanggal_kembali");
            $table->time("waktu_kembali");
            $table->string("foto_kondisi_bbm");
            $table->string("jumlah_bbm");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Transaksi');
    }
};
