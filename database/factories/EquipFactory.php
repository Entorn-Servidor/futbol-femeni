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
        return [
            'nom' => $this->faker->unique()->company,
            'ciutat' => $this->faker->city,
            'pressupost' => $this->faker->numberBetween(1000000, 50000000),
            'titols' => $this->faker->numberBetween(0, 50),
            
            // Lógica de seguridad:
            // 1. Intenta coger un estadio al azar.
            // 2. Si no hay ninguno (null), crea uno nuevo con el Factory de Estadi.
            'estadi_id' => Estadi::inRandomOrder()->first()?->id ?? Estadi::factory(),
        ];
    }
}