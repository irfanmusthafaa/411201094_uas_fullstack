<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'id',
        'kode_barang',
        'nama_barang'
    ];

    const UPDATED_AT = null;
    protected $table = 'barang';
}
