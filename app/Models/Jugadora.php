<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    // ESTA LÍNEA ES CRUCIAL:
    // Le dice a Laravel que la tabla se llama 'jugadores' (en catalán)
    // y NO 'jugadoras' (la convención por defecto).
    protected $table = 'jugadores'; 

    protected $fillable = [
        'nom',
        'posicio',
        'equip_id',
        'data_naixement',
        'dorsal',
        'foto',
    ];

    protected $casts = [
        'data_naixement' => 'date',
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}