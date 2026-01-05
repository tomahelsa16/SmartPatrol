<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKondisi extends Model
{
    protected $fillable = [
        'waktu',
        'area',
        'informasi',
        'keterangan'
    ];
}

