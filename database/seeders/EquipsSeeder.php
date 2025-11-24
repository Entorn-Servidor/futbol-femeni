<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // --- EQUIPO 1: Barça ---
        // Buscamos el estadio o lo creamos si no existe (A prueba de fallos)
        $campNou = Estadi::firstOrCreate(
            ['nom' => 'Camp Nou'], 
            ['ciutat' => 'Barcelona', 'capacitat' => 99354]
        );

        Equip::create([
            'nom' => 'Barça Femení',
            'ciutat' => 'Barcelona',    // OBLIGATORIO
            'pressupost' => 12000000,   // OBLIGATORIO
            'titols' => 30,
            'estadi_id' => $campNou->id // OBLIGATORIO
        ]);

        // --- EQUIPO 2: Atlético ---
        $wanda = Estadi::firstOrCreate(
            ['nom' => 'Wanda Metropolitano'], 
            ['ciutat' => 'Madrid', 'capacitat' => 68456]
        );

        Equip::create([
            'nom' => 'Atlètic de Madrid',
            'ciutat' => 'Madrid',
            'pressupost' => 5000000,
            'titols' => 10,
            'estadi_id' => $wanda->id
        ]);

        // --- EQUIPO 3: Real Madrid ---
        $bernabeu = Estadi::firstOrCreate(
            ['nom' => 'Santiago Bernabéu'], 
            ['ciutat' => 'Madrid', 'capacitat' => 81044]
        );

        Equip::create([
            'nom' => 'Real Madrid Femení',
            'ciutat' => 'Madrid',
            'pressupost' => 8000000,
            'titols' => 5,
            'estadi_id' => $bernabeu->id
        ]);

        // --- RESTO DE EQUIPOS (Factory) ---
        // Generamos 15 más para llegar a 18
        Equip::factory()->count(15)->create();
    }
}