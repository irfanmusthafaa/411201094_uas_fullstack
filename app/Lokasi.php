<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = [
        'id',
        'kode_lokasi',
        'nama_lokasi'
    ];

    const UPDATED_AT = null;
    protected $table = 'lokasi';
}
