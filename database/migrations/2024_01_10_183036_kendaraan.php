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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_kendaraan_id')->index("fk_brand_kendaraan_to_kendaraan");
            $table->string('plat')->uniqe();
            $table->enum('status', ['Tidak Terpakai', 'Sudah Terpakai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Kendaraan');
    }
};
