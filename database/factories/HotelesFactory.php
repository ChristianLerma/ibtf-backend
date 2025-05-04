<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hoteles>
 */
class HotelesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel' => fake()->name(),
            'descripcion' => fake()->text(),
            'direccion' => fake()->address(),
            'telefono' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'pagina_web' => fake()->url(),
            'calificacion' => fake()->numberBetween(1, 5),
            'numero_habitaciones' => fake()->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
