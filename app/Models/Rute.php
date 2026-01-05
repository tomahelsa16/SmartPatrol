<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $fillable = [
        'nama_rute',
        'nama_tempat',
             
        'latitude',
        'longitude',
    ];
}
