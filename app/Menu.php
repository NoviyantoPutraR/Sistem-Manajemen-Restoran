<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tbl_menus';

    protected $fillable = [
        'menu',
        'deskripsi',
        'harga',
        'total_item',
        'total_transaksi',
    ];
}
