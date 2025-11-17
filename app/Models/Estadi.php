<?php

namespace App\Models;

use App\Http\Controllers\PartitController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'capacitat',
    ];
    
    // --- NOVES RELACIONS ---

    /**
     * Un estadi pot tenir molts partits (Relació 1:N)
     */
    public function partits()
    {
        return $this->hasMany(PartitController::class);
    }

    /**
     * Un estadi pot ser la seu de molts equips
     */
    public function equips()
    {
        return $this->hasMany(Equip::class);
    }
}