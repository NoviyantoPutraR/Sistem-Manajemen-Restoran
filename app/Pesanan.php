<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'tbl_pesanans';
    protected $fillable = ['kode_invoice', 'menu_id', 'meja_id', 'nama_pelanggan', 'status_pembayaran', 'status_pesanan', 'total_items', 'total_nominal'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
}
