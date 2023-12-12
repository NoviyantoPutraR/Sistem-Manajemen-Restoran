<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'tbl_pelanggans';

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'terakhir_kunjungan',
        'total_transaksi',
    ];

    public function pelanggan()
{
return $this->belogsTo('App\Pelanggan', 'id_pelanggan');
}

}
