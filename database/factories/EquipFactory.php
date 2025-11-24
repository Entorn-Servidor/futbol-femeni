<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipFactory extends Factory
{
    protected $model = Equip::class;

    public function definition(): array
    {
        // Intentamos coger un estadio aleatorio que ya exista
        $estadi = Estadi::inRandomOrder()->first();

        return [
            'nom' => $this->faker->unique()->company,
            'ciutat' => $this->faker->city, // OBLIGATORIO: Campo nuevo
            'pressupost' => $this->faker->numberBetween(1000000, 50000000), // OBLIGATORIO: Campo nuevo
            'titols' => $this->faker->numberBetween(0, 50),
            
            // OBLIGATORIO: Si hay estadio, usamos su ID. Si no, creamos uno nuevo.
            'estadi_id' => $estadi ? $estadi->id : Estadi::factory(),
        ];
    }
}