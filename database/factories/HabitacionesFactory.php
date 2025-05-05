<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habitaciones>
 */
class HabitacionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'habitacion' => fake()->name(),
            'descripcion' => fake()->text(),
            'cantidad' => fake()->numberBetween(1, 10),
            'hotel_id' => 1,
            'acomodacion_id' => 1,
            'tipo_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
