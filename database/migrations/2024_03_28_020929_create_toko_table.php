<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('nama_toko');
            $table->enum('kategori_toko', ['elektronik', 'otomotif', 'sembako', 'fashion', 'makanan', 'obat', 'aksesoris', 'perabotan']);
            $table->text('desc_toko');
            $table->string('hari_buka');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->boolean('aktif')->default('0');
            $table->string('icon_toko')->default('default-toko.png');
            $table->foreign('id_user')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};