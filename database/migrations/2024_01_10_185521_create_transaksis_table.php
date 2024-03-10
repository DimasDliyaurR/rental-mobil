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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->nullable()->index('fk_transaksi_to_kendaraan');
            $table->string("foto_penyewa");
            $table->string("nama_penyewa");
            $table->string("no_telp");
            $table->text("alamat");
            $table->string("no_ktp");
            $table->string("foto_ktp");
            $table->string("no_sim");
            $table->string("foto_sim");
            $table->string("tanda_tangan");
            $table->timestamp("tanggal_sewa");
            $table->date("waktu_pengambilan");
            $table->string("lokasi_pengambilan");
            $table->boolean("driver")->default(0);
            $table->string("biaya_supir")->nullable();
            $table->integer("durasi");
            $table->date("tanggal_kembali");
            $table->time("waktu_kembali");
            $table->string("foto_kondisi_bbm");
            $table->integer("promo")->nullable();
            $table->string("jumlah_bbm");
            $table->enum("status", ["belum lunas", "lunas"])->default("belum lunas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
