<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    // --- CAMPS ACTUALITZATS ---
    protected $fillable = [
        'nom',
        'posicio',
        'equip_id',
        'data_naixement',
        'dorsal',
        'foto',
    ];

    /**
     * Converteix la data_naixement a un objecte Carbon
     */
    protected $casts = [
        'data_naixement' => 'date',
    ];

    // --- NOVA RELACIÓ ---

    /**
     * Una jugadora pertany a un equip (Relació N:1)
     */
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}