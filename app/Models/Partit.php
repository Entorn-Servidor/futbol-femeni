<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols'
    ];

    protected $casts = [
        'data' => 'date',
        'gols' => 'array',
    ];

    // Relació N:1: Equip Local
    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relació N:1: Equip Visitant
    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    // Relació N:1: Estadi
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}