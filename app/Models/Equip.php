<?php

namespace App\Models;

use App\Http\Controllers\PartitController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ciutat',
        'estadi_id', 
        'pressupost',
    ];

    // --- NOVES RELACIONS ---

    /**
     * Un equip té moltes jugadores (Relació 1:N)
     */
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    /**
     * Un equip juga molts partits com a local (Relació 1:N)
     */
    public function partitsLocal()
    {
        return $this->hasMany(PartitController::class, 'local_id');
    }

    /**
     * Un equip juga molts partits com a visitant (Relació 1:N)
     */
    public function partitsVisitant()
    {
        return $this->hasMany(PartitController::class, 'visitant_id');
    }

    /**
     * Relació N:1 amb Estadi (L'estadi de l'equip)
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}