<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hoteles;
use Illuminate\Routing\Controller;

class HotelesController extends Controller
{
    /**
     * @var Hoteles
     */
    private $hoteles;

    /**
     * HotelesController constructor.
     *
     * @param Hoteles $hoteles
     */
    public function __construct(Hoteles $hoteles)
    {
        $this->hoteles = $hoteles;
    }

    /**
     * @OA\PathItem(
     *    path="/api/v1/hoteles",
     *    @OA\Get(
     *       path="/api/v1/hoteles",
     *       tags={"Hoteles"},
     *       summary="Get all registers",
     *       @OA\Response(
     *          response=200,
     *          description="Retrieved successfully",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *      )
     *    ),
     * )
     */
    public function index()
    {
        /**
         * @OA\Get(
         *     path="/api/v1/hoteles",
         *     tags={"Hoteles"},
         *     summary="Get all registers",
         *     @OA\Response(
         *         response=200,
         *         description="Retrieved successfully",
         *         @OA\JsonContent(
         *             @OA\Property(property="success", type="boolean"),
         *             @OA\Property(property="data", type="object"),
         *             @OA\Property(property="message", type="object"),
         *             @OA\Property(property="error", type="object")
         *         )
         *     )
         * )
         */
        $hoteles = $this->hoteles->getAllHoteles();

        return $hoteles;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/hoteles/{id}",
     *     tags={"Hoteles"},
     *     summary="Get a register by ID",
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
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $hotel = $this->hoteles->getHotelById($id);

        return $hotel;
    }

    /**
     * @OA\Put(
     *     path="/api/v1/hoteles/{id}/editar",
     *     tags={"Hoteles"},
     *     summary="Update a register",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the register",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"hotel"},
     *             @OA\Property(property="hotel", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="direccion", type="string"),
     *             @OA\Property(property="telefono", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="pagina_web", type="string"),
     *             @OA\Property(property="calificacion", type="integer"),
     *             @OA\Property(property="numero_habitaciones", type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *        )
     *    )
     * )
     */
    public function update(Request $request, $id)
    {
        $hotel = $this->hoteles->updateHotel($id, $request);

        return $hotel;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/hoteles",
     *     tags={"Hoteles"},
     *     summary="Create a new register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"hotel"},
     *            @OA\Property(property="hotel", type="string"),
     *            @OA\Property(property="descripcion", type="string"),
     *            @OA\Property(property="direccion", type="string"),
     *            @OA\Property(property="telefono", type="string"),
     *            @OA\Property(property="email", type="string"),
     *            @OA\Property(property="pagina_web", type="string"),
     *            @OA\Property(property="calificacion", type="integer"),
     *            @OA\Property(property="numero_habitaciones", type="integer")
     *        ),
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
        $hotel = $this->hoteles->createHotel($request);

        return $hotel;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/hoteles/nombre/{nombre}",
     *     tags={"Hoteles"},
     *     summary="Get a register by name",
     *     @OA\Parameter(
     *         name="nombre",
     *         in="path",
     *         required=true,
     *         description="Name of the hotel",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
     */
    public function getHotelesByNombre($nombre)
    {
        $hoteles = $this->hoteles->getHotelesByNombre($nombre);

        return $hoteles;
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/hoteles/{id}/eliminar",
     *     tags={"Hoteles"},
     *     summary="Delete a register",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the hotel",
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
        $result = $this->hoteles->deleteHotel($id);

        return $result;
    }

    /**
     * @OA\Shema(
     *    schema="Hoteles",
     *    type="object",
     *    title="Hoteles",
     *    @OA\Property(property="id", type="integer"),
     *    @OA\Property(property="hotel", type="string"),
     *    @OA\Property(property="descripcion", type="string"),
     *    @OA\Property(property="direccion", type="string"),
     *    @OA\Property(property="telefono", type="string"),
     *    @OA\Property(property="email", type="string"),
     *    @OA\Property(property="pagina_web", type="string"),
     *    @OA\Property(property="calificacion", type="integer"),
     *    @OA\Property(property="numero_habitaciones", type="integer"),
     *    @OA\Property(property="created_at", type="string", format="date-time"),
     *    @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
}
