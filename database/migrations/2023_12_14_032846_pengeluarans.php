<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pengeluarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengeluarans', function (Blueprint $table) {
            $table->bigIncrements('id_pengeluaran');
            $table->enum('jenis', ['listrik', 'operasional', 'gaji pegawai', 'lain_lain']);
            $table->text('deskripsi')->nullable();
            $table->integer('total');
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
        Schema::dropIfExists('tbl_pengeluarans');
    }
}
