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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaksi_id")->nullable()->index("fk_detail_transaksi_to_transaksi");
            $table->date("tanggal_sewa");
            $table->date("waktu_pengambilan");
            $table->string("lokasi_pengambilan");
            $table->boolean("driver")->nullable();
            $table->date("durasi");
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
        Schema::dropIfExists('detail_transaksi');
    }
};
