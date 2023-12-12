<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id_pembelian');
            $table->enum('kategori', ['daging', 'seafood', 'karbo', 'sayur', 'buah', 'bumbu', 'tepung']);
            $table->integer('total_item');
            $table->integer('total_nominal'); // Presisi: 15 digit, 2 digit di belakang koma
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
        Schema::dropIfExists('tbl_pembelians');
    }
}
