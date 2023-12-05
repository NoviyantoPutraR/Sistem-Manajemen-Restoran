<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianModel extends Model
{
    protected $table = 'tbl_pembelians';

    protected $fillable = [
        'id_pembelian',
        'kategori',
        'total',
        'create_at',
    ];
}
