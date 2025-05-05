<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcomodacionesController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\HotelesController;
use App\Http\Controllers\HabitacionesController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
*/

/**
 * Acomodaciones Routes
 */
Route::apiResource('v1/acomodaciones', AcomodacionesController::class);
Route::put('v1/acomodaciones/{id}/editar', [AcomodacionesController::class, 'update'])->name('acomodaciones.editar');
Route::delete('v1/acomodaciones/{id}/eliminar', [AcomodacionesController::class, 'delete'])->name('acomodaciones.eliminar');

/**
 * Tipos Routes
 */
Route::apiResource('v1/tipos', TiposController::class);
Route::put('v1/tipos/{id}/editar', [TiposController::class, 'update'])->name('tipos.editar');
Route::delete('v1/tipos/{id}/eliminar', [TiposController::class, 'delete'])->name('tipos.eliminar');

/**
 * Hoteles Routes
 */
Route::apiResource('v1/hoteles', HotelesController::class);
Route::get('v1/hoteles/nombre/{nombre}', [HotelesController::class, 'getHotelesByNombre'])->name('hoteles.nombre');
Route::put('v1/hoteles/{id}/editar', [HotelesController::class, 'update'])->name('hoteles.editar');
Route::delete('v1/hoteles/{id}/eliminar', [HotelesController::class, 'delete'])->name('hoteles.eliminar');

/**
 * Habitaciones Routes
 */
Route::apiResource('v1/habitaciones', HabitacionesController::class);
Route::get('v1/habitaciones/hotel/{hotel_id}', [HabitacionesController::class, 'getHabitacionesByHotel'])->name('habitaciones.hotel');
Route::put('v1/habitaciones/{id}/editar', [HabitacionesController::class, 'update'])->name('habitaciones.editar');
Route::delete('v1/habitaciones/{id}/eliminar', [HabitacionesController::class, 'delete'])->name('habitaciones.eliminar');
