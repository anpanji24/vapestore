<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = array('namabarang','jenis','stock');

    public function masuk() {
        return $this->hasMany('App\masuk', 'barang_id', 'id');
    }

    public function keluar() {
        return $this->hasMany('App\keluar', 'barang_id', 'id');
    }
}
