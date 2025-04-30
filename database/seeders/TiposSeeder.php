<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            array('id' => 1, 'tipo' => 'Estandar', 'descripcion' => 'Habitación tipo Estandar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('id' => 2, 'tipo' => 'Junior', 'descripcion' => 'Habitación tipo Junior', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('id' => 3, 'tipo' => 'Suite', 'descripcion' => 'Habitación tipo Suite', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        ];

        DB::table('tipos')->insert($datos);
    }
}
