<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. EQUIPOS MANUALES ---
        
        // Creamos (o buscamos) el estadio PRIMERO para asegurar que tenemos ID
        $campNou = Estadi::firstOrCreate(
            ['nom' => 'Camp Nou'], 
            ['ciutat' => 'Barcelona', 'capacitat' => 99354]
        );

        Equip::create([
            'nom' => 'Barça Femení',
            'ciutat' => 'Barcelona',
            'pressupost' => 12000000,
            'titols' => 30,
            'estadi_id' => $campNou->id // Aquí usamos el ID del objeto que acabamos de asegurar
        ]);

        // ---
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

        // ---
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

        // --- 2. RESTO DE EQUIPOS (Factory) ---
        // Generamos 15 más. El Factory se encargará de asignarles estadio.
        Equip::factory()->count(15)->create();
    }
}