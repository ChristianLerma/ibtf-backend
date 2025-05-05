<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcomodacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            array('id' => 1, 'acomodacion' => 'Sencilla', 'descripcion' => 'Acomodación Sencilla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('id' => 2, 'acomodacion' => 'Doble', 'descripcion' => 'Acomodación Doble', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('id' => 3, 'acomodacion' => 'Triple', 'descripcion' => 'Acomodación Triple', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('id' => 4, 'acomodacion' => 'Cuádruple', 'descripcion' => 'Acomodación Cuádruple', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        ];

        // Insertar los datos en la tabla 'acomodaciones'
        DB::table('acomodaciones')->insert($datos);
    }
}
