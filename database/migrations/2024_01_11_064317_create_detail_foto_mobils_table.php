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
        Schema::create('detail_foto_mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaksi_id")->nullable()->index("fk_detail_foto_mobil_to_transaksi");
            $table->text("keterangan");
            $table->string("foto_mobil");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_foto_mobils');
    }
};
