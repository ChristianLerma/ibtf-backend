<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitaciones;
use Illuminate\Routing\Controller;

class HabitacionesController extends Controller
{
    /**
     * @var Habitaciones
     */
    private $habitaciones;

    /**
     * HabitacionesController constructor.
     *
     * @param Habitaciones $habitaciones
     */
    public function __construct(Habitaciones $habitaciones)
    {
        $this->habitaciones = $habitaciones;
    }

    /**
     * @OA\PathItem(
     *   path="/api/v1/habitaciones",
     *   @OA\Get(
     *      path="/api/v1/habitaciones",
     *      tags={"Habitaciones"},
     *      summary="Get all registers",
     *      @OA\Response(
     *         response=200,
     *         description="Retrieved successfully",
     *        )
     *    )
     * )
     */
    public function index()
    {
        /**
         * @OA\Get(
         *     path="/api/v1/habitaciones",
         *     tags={"Habitaciones"},
         *     summary="Get all registers",
         *     @OA\Response(
         *         response=200,
         *         description="Retrieved successfully"
         *     )
         * )
         */
        $habitaciones = $this->habitaciones->getAllHabitaciones();

        return response()->json($habitaciones);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/habitaciones/{id}",
     *     tags={"Habitaciones"},
     *     summary="Get a register by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the register",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retrieved successfully"
     *     )
     * )
     */
    public function show($id)
    {
        $habitacion = $this->habitaciones->getHabitacionById($id);
        if (!$habitacion) {
            return response()->json(['message' => 'Habitacion not found'], 404);
        }
        return response()->json($habitacion);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/habitaciones/{id}",
     *     tags={"Habitaciones"},
     *     summary="Update a register",
     *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="ID of the register",
     *        @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"habitacion", "descripcion", "hotel_id", "acomodacion_id", "tipo_id"},
     *             @OA\Property(property="habitacion", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="hotel_id", type="integer"),
     *             @OA\Property(property="acomodacion_id", type="integer"),
     *             @OA\Property(property="tipo_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $habitacion = $this->habitaciones->updateHabitacion($id, $request);
        if (!$habitacion) {
            return response()->json(['message' => 'Habitacion not found'], 404);
        }

        return response()->json($habitacion);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/habitaciones",
     *     tags={"Habitaciones"},
     *     summary="Create a new register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"habitacion", "descripcion", "hotel_id", "acomodacion_id", "tipo_id"},
     *             @OA\Property(property="habitacion", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="hotel_id", type="integer"),
     *             @OA\Property(property="acomodacion_id", type="integer"),
     *             @OA\Property(property="tipo_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="habitacion", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="hotel_id", type="integer"),
     *             @OA\Property(property="acomodacion_id", type="integer"),
     *             @OA\Property(property="tipo_id", type="integer"),
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $habitacion = $this->habitaciones->createHabitacion($request);

        return response()->json($habitacion, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/habitaciones/{id}",
     *     tags={"Habitaciones"},
     *     summary="Delete a register",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the register",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $habitacion = $this->habitaciones->deleteHabitacion($id);
        if (!$habitacion) {
            return response()->json(['message' => 'Habitacion not found'], 404);
        }

        return response()->json(['message' => 'Habitacion deleted successfully']);
    }

    /**
     * @OA\Schema(
     *     schema="Habitaciones",
     *     type="object",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="habitacion", type="string"),
     *     @OA\Property(property="descripcion", type="string"),
     *     @OA\Property(property="hotel_id", type="integer"),
     *     @OA\Property(property="acomodacion_id", type="integer"),
     *     @OA\Property(property="tipo_id", type="integer"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
}
