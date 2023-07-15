<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'email',
        'password'
    ];

    const UPDATED_AT = null;
    protected $table = 'kurir';
}
