<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('habitacion');
            $table->string('descripcion')->nullable();

            $table->foreignId('hotel_id')
                ->constrained('hoteles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('acomodacion_id')
                ->constrained('acomodaciones')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('tipo_id')
                ->constrained('tipos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
