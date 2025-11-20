<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Partit;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'estadi_id', 'pressupost'];

    // Relació 1:N: Un equip té moltes jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    // Relació 1:N: Partits on l'equip és local
    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    // Relació 1:N: Partits on l'equip és visitant
    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    // Relació N:1: Un equip pertany a un estadi
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}