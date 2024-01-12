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
        Schema::create('data_diri', function (Blueprint $table) {
            $table->foreignId("transaksi_id");
            $table->string("foto_penyewa");
            $table->string("nama_penyewa");
            $table->string("no_telp");
            $table->string("no_ktp");
            $table->string("foto_ktp");
            $table->string("no_sim");
            $table->string("foto_sim");
            $table->string("foto_ttd");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_diri');
    }
};
