<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_menus', function (Blueprint $table) {
            $table->bigIncrements('id'); // Mengganti 'menu' dengan 'id'
            $table->string('foto'); 
            $table->string('menu'); // Menambahkan kolom 'menu' sebagai nama menu
            $table->text('deskripsi')->nullable(); // Menambahkan kolom 'deskripsi' dan membiarkan nilainya dapat kosong
            $table->decimal('harga', 10, 2); // Menambahkan kolom 'harga' dengan 2 digit di belakang koma
            $table->integer('total_item');
            $table->decimal('total_transaksi'); // Mengganti 'total' menjadi 'total_transaksi'
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
        Schema::dropIfExists('tbl_menus');
    }
}
