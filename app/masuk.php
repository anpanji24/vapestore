<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class masuk extends Model
{
    protected $table = 'masuks';
    protected $fillable = array('namabarang','jenis','jumlah','barang_id');

    public function barang() {
        return $this->belongsTo('App\barang', 'barang_id', 'id');
    }
}
