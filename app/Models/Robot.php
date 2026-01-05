<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'robot_id',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
