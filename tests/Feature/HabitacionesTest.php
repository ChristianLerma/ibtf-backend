<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tipos;
use App\Models\Hoteles;
use App\Models\Habitaciones;
use App\Models\Acomodaciones;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function run_factory_seeders()
    {
        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_04_30_161528_create_acomodaciones_table.php',
            '--realpath' => true,
        ]);
        $this->artisan('db:seed', [
            '--class' => 'AcomodacionesSeeder',
        ]);

        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_04_30_161529_create_tipos_table.php',
            '--realpath' => true,
        ]);
        $this->artisan('db:seed', [
            '--class' => 'TiposSeeder',
        ]);

        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_050644_create_hoteles_table.php',
            '--realpath' => true,
        ]);
        $hotel_id = \App\Models\Hoteles::factory()->create([
            'hotel' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'pagina_web' => $this->faker->url,
            'calificacion' => $this->faker->numberBetween(1, 5),
            'numero_habitaciones' => $this->faker->numberBetween(1, 100),
        ])->id;

        $this->artisan('migrate', [
            '--path' => 'database/migrations/2025_05_01_053418_create_habitaciones_table.php',
            '--realpath' => true,
        ]);
        $habitacion = Habitaciones::factory()->create([
            'habitacion' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'hotel_id' => $hotel_id,
            'acomodacion_id' => Acomodaciones::where('id', 1)->first()->id,
            'tipo_id' => Tipos::where('id', 1)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $habitacion;
    }

    public function test_habitaciones_returns_all_habitaciones(): void
    {
        $response = $this->getJson('api/v1/habitaciones');

        $response->assertJson([
            'success' => true,
            'message' => 'Habitaciones retrieved successfully',
            'error' => [],
            'data' => []
        ])->assertStatus(200);
    }

    public function test_habitaciones_show_habitacion_not_found(): void
    {
        $response = $this->getJson('api/v1/habitaciones/999');

        $response->assertJson([
            'success' => false,
            'message' => 'Habitacion not found',
            'error' => "Habitacion not found",
        ])->assertStatus(404);
    }

    public function test_habitaciones_show_habitacion_by_id(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->getJson('api/v1/habitaciones/' . $habitacion->id);
        $response->assertJson([
            'success' => true,
            'message' => 'Habitacion retrieved successfully',
            'error' => [],
            'data' => [
                'id' => $habitacion->id,
            ]
        ])->assertStatus(200);
    }

    public function test_habitaciones_show_habitaciones_by_hotel_id(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->getJson('api/v1/habitaciones/hotel/' . $habitacion->hotel_id);
        $response->assertJson([
            'success' => true,
            'message' => 'Habitaciones retrieved successfully',
            'error' => [],
        ])->assertStatus(200);
    }

    public function test_habitaciones_show_habitaciones_by_hotel_id_not_found(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->getJson('api/v1/habitaciones/hotel/999');

        $response->assertJson([
            'success' => true,
            'message' => 'Habitaciones retrieved successfully',
        ])->assertStatus(200);
    }

    public function test_habitaciones_update_habitacion(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->putJson('api/v1/habitaciones/' . $habitacion->id, [
            'habitacion' => 'Habitacion Actualizada',
            'descripcion' => 'Descripcion Actualizada',
            'hotel_id' => $habitacion->hotel_id,
            'acomodacion_id' => Acomodaciones::where('id', 1)->first()->id,
            'tipo_id' => Tipos::where('id', 1)->first()->id,
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'Habitacion updated successfully',
            'error' => [],
        ])->assertStatus(200);
    }

    public function test_habitaciones_update_habitacion_not_found(): void
    {
        $response = $this->putJson('api/v1/habitaciones/999', [
            'habitacion' => 'Habitacion Actualizada',
            'descripcion' => 'Descripcion Actualizada',
            'hotel_id' => 1,
            'acomodacion_id' => 1,
            'tipo_id' => 1,
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Habitacion not found',
            'error' => "Habitacion not found",
        ])->assertStatus(500);
    }

    public function test_habitaciones_create_habitacion(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->postJson('api/v1/habitaciones', [
            'habitacion' => 'Habitacion Nueva',
            'descripcion' => 'Descripcion Nueva',
            'hotel_id' => $habitacion->hotel_id,
            'acomodacion_id' => Acomodaciones::where('id', 1)->first()->id,
            'tipo_id' => Tipos::where('id', 1)->first()->id,
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'Habitacion created successfully',
            'error' => [],
        ])->assertStatus(201);
    }

    public function test_habitaciones_create_habitacion_validation_error(): void
    {
        $response = $this->postJson('api/v1/habitaciones', [
            'habitacion' => '',
            'descripcion' => '',
            'hotel_id' => '',
            'acomodacion_id' => '',
            'tipo_id' => '',
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Habitacion not created',
            'error' => "Habitacion not created",
        ])->assertStatus(500);
    }

    public function test_habitaciones_delete_habitacion(): void
    {
        $habitacion = $this->run_factory_seeders();

        $response = $this->deleteJson('api/v1/habitaciones/' . $habitacion->id);

        $response->assertJson([
            'success' => true,
            'message' => 'Habitacion deleted successfully',
            'error' => [],
        ])->assertStatus(200);
    }

    public function test_habitaciones_delete_habitacion_not_found(): void
    {
        $response = $this->deleteJson('api/v1/habitaciones/999');

        $response->assertJson([
            'success' => false,
            'message' => 'Habitacion not found',
            'error' => "Habitacion not found",
        ])->assertStatus(500);
    }
}
