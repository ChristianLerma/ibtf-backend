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

/**
 * Tipos Routes
 */
Route::apiResource('v1/tipos', TiposController::class);

/**
 * Hoteles Routes
 */
Route::apiResource('v1/hoteles', HotelesController::class);
Route::put('v1/hoteles/{id}/editar', [HotelesController::class, 'update'])->name('hoteles.update');
Route::delete('v1/hoteles/{id}/eliminar', [HotelesController::class, 'delete'])->name('hoteles.delete');

/**
 * Habitaciones Routes
 */
Route::apiResource('v1/habitaciones', HabitacionesController::class);
