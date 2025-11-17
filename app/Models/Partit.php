<?php

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'visitant_id',
        'estadi_id',
        'data',
        'jornada',
        'gols',
    ];

    /**
     * Converteix el camp 'gols' (JSON) a un array PHP automàticament.
     * I la 'data' a un objecte Carbon.
     */
    protected $casts = [
        'gols' => 'array',
        'data' => 'date',
    ];

    // --- RELACIONS N:1 ---

    /**
     * Un partit pertany a un equip local (Relació N:1)
     */
    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    /**
     * Un partit pertany a un equip visitant (Relació N:1)
     */
    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    /**
     * Un partit es juga en un estadi (Relació N:1)
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}