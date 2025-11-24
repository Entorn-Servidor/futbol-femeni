<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'local_id',
        'visitant_id',
        'jornada',
        'data', // Asegúrate de que coincida con la base de datos
        'gols'  // Asegúrate de que coincida con la base de datos
    ];

    // Conversión automática de tipos (Casting)
    protected $casts = [
        'data' => 'date',
        'gols' => 'array', // Esto convierte el JSON de la BD a Array en PHP automáticamente
    ];

    // Relaciones
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }
}