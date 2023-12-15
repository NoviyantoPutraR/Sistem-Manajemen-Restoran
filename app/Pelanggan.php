<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'tbl_pelanggans';

    protected $fillable = [
        'nama_pelanggan',
        'metode_pembayaran',
        'alamat',
        'no_hp',
        'terakhir_kunjungan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo('App\Pelanggan', 'id_pelanggan');
    }
}
