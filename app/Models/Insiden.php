<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    protected $table = 'insiden';

    protected $fillable = [
        'waktu',
        'area',
        'informasi',
        'keterangan',
    ];
}

