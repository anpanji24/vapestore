<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keluar extends Model
{
    protected $table = 'keluars';
    protected $fillable = array('jenis','jumlah','barang_id');

    public function barang() {
        return $this->belongsTo('App\barang', 'barang_id', 'id');
    }
}
