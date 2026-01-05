<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    protected $fillable = [
        'robot_id',
        'waktu_operasional',
        'status',
    ];

    protected $casts = [
        'waktu_operasional' => 'datetime',
    ];

    /* =============================
       RELASI KE ROBOT
    ============================== */
    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }

    /* =============================
       RELASI KE RUTE DINAMIS
       Mengambil titik rute dari tabel pivot
    ============================== */
    public function rutes()
    {
        return $this->belongsToMany(Rute::class, 'penugasan_rutes')
                    ->withPivot('urutan')
                    ->orderBy('pivot_urutan');
    }
}
