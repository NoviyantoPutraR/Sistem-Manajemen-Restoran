<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'tbl_mejas';

    protected $fillable = [
        'no_meja',
        'kapasitas',
        'status',
        'total_transaksi',
    ];
}
