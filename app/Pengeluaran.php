<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'tbl_pengeluarans';
    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = [
        'jenis',
        'deskripsi',
        'total',
    ];
}
