<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pesanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_invoice');
            $table->json('menu_items'); // Kolom baru untuk menyimpan array menu
            $table->unsignedBigInteger('meja_id');
            $table->string('nama_pelanggan');
            $table->enum('status_pembayaran', ['lunas', 'belum lunas']);
            $table->enum('status_pesanan', ['belum diproses', 'sedang diproses', 'selesai']);
            $table->integer('total_items');
            $table->integer('total_nominal');
            $table->timestamps();

            $table->foreign('meja_id')->references('id')->on('tbl_mejas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pesanans');
    }
}
