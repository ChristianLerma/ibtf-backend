<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Hoteles;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_hoteles_returns_all_hotels(): void
    {
        $response = $this->getJson('api/v1/hoteles');

        $response->assertJson([
            'success' => true,
            'message' => 'Hoteles retrieved successfully',
            'error' => [],
            'data' => []
        ])->assertStatus(200);
    }

     public function test_hoteles_show_hotel_not_found(): void
    {
        $response = $this->getJson('api/v1/hoteles/999');

        $response->assertJson([
            'success' => false,
            'message' => 'Hotel not found',
            'error' => "Hotel not found",
        ])->assertStatus(500);
    }

    public function test_hoteles_show_hotel_by_id(): void
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_050644_create_hoteles_table.php',
            '--realpath' => true,
        ]);

        $hotel = Hoteles::factory()->create([
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response = $this->getJson('api/v1/hoteles/' . $hotel->id);
        $response->assertJson([
            'success' => true,
            'message' => 'Hotel retrieved successfully',
            'error' => [],
            'data' => [
                'id' => $hotel->id,
            ]
        ])->assertStatus(200);
    }

    public function test_hoteles_update_hotel(): void
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_050644_create_hoteles_table.php',
            '--realpath' => true,
        ]);

        $hotel = Hoteles::factory()->create([
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response = $this->putJson('api/v1/hoteles/' . $hotel->id . '/editar', [
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'Hotel updated successfully',
            'error' => [],
            'data' => [
                'id' => $hotel->id,
            ]
        ])->assertStatus(200);
    }

    public function test_hoteles_update_hotel_not_found(): void
    {
        $response = $this->putJson('api/v1/hoteles/999/editar', [
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Hotel not found',
            'error' => "Hotel not found",
        ])->assertStatus(500);
    }

    public function test_hoteles_create_hotel(): void
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_050644_create_hoteles_table.php',
            '--realpath' => true,
        ]);

        $response = $this->postJson('api/v1/hoteles', [
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'Hotel created successfully',
            'error' => [],
        ])->assertStatus(201);
    }

    public function test_hoteles_create_hotel_validation_error(): void
    {
        $response = $this->postJson('api/v1/hoteles', [
            'hotel' => '',
            'descripcion' => '',
            'direccion' => '',
            'telefono' => '',
            'email' => '',
            'pagina_web' => '',
            'calificacion' => '',
            'numero_habitaciones' => '',
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Hotel not created',
            'error' => "Hotel not created",
        ])->assertStatus(500);
    }

    public function test_hoteles_delete_hotel(): void
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_050644_create_hoteles_table.php',
            '--realpath' => true,
        ]);

        $hotel = Hoteles::factory()->create([
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ]);

        $response = $this->deleteJson('api/v1/hoteles/' . $hotel->id . '/eliminar');

        $response->assertJson([
            'success' => true,
            'message' => 'Hotel deleted successfully',
            'error' => [],
        ])->assertStatus(200);
    }

    public function test_hoteles_delete_hotel_not_found(): void
    {
        $response = $this->deleteJson('api/v1/hoteles/999/eliminar');

        $response->assertJson([
            'success' => false,
            'message' => 'Hotel not found',
            'error' => "Hotel not found",
        ])->assertStatus(500);
    }
}
