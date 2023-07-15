<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_pengiriman');
            $table->timestamp('tanggal');
            $table->integer('lokasi_id');
            $table->string('lokasi_name');
            $table->integer('barang_id');
            $table->string('barang_name');
            $table->integer('jumlah_barang');
            $table->integer('harga_barang');
            $table->integer('kurir_id');
            $table->string('kurir_name');
            $table->boolean('is_approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengiriman');
    }
}
