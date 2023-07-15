<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $fillable = [
        'id',
        'no_pengiriman',
        'tanggal',
        'lokasi_id',
        'lokasi_name',
        'barang_id',
        'barang_name',
        'jumlah_barang',
        'harga_barang',
        'kurir_id',
        'kurir_name',
        'is_approved'
    ];

    const UPDATED_AT = null;
    protected $table = 'pengiriman';
}
