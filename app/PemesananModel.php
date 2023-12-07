<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananModel extends Model
{
    protected $table = 'tbl_pembelians';
    protected $primaryKey = 'id_pembelian';
    protected $fillable = [
        'kategori',
        'created_at',
    ];

    public function PembelianModel()
    {
        return $this->belongsTo('App\PembelianModel', 'id_pembelian');
    }

}
