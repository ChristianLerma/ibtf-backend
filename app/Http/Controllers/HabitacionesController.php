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
     *         @OA\JsonContent(
     *            @OA\Property(property="success", type="boolean"),
     *            @OA\Property(property="data", type="object"),
     *            @OA\Property(property="message", type="object"),
     *            @OA\Property(property="error", type="object")
     *         )
     *      )
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
         *         description="Retrieved successfully",
         *         @OA\JsonContent(
         *             @OA\Property(property="success", type="boolean"),
         *             @OA\Property(property="data", type="object"),
         *             @OA\Property(property="message", type="object"),
         *             @OA\Property(property="error", type="object")
         *        )
         *     )
         * )
         */
        $habitaciones = $this->habitaciones->getAllHabitaciones();

        return $habitaciones;
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
     *         description="Retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *        )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitacion not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *        )
     *    )
     * )
     */
    public function show($id)
    {
        $habitacion = $this->habitaciones->getHabitacionById($id);

        return $habitacion;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/habitaciones/hotel/{id}",
     *     tags={"Habitaciones"},
     *     summary="Get all registers by hotel",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the hotel",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *        )
     *     )
     * )
     */
    public function getHabitacionesByHotel($id)
    {
        $habitaciones = $this->habitaciones->getHabitacionesByHotelId($id);

        return $habitaciones;
    }

    /**
     * @OA\Put(
     *     path="/api/v1/habitaciones/{id}/editar",
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
     *         description="Updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error updating the register",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $habitacion = $this->habitaciones->updateHabitacion($id, $request);

        return $habitacion;
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
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $habitacion = $this->habitaciones->createHabitacion($request);

        return $habitacion;
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/habitaciones/{id}/eliminar",
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
     *         description="Deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
     */
    public function delete($id)
    {
        $habitacion = $this->habitaciones->deleteHabitacion($id);

        return $habitacion;
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
