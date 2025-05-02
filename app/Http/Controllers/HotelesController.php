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
         *         description="Retrieved successfully"
         *     )
         * )
         */
        $hoteles = $this->hoteles->getAllHoteles();

        return response()->json($hoteles);
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
     *         description="Retrieved successfully"
     *     )
     * )
     */
    public function show($id)
    {
        $hotel = $this->hoteles->getHotelById($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
        return response()->json($hotel);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/hoteles/{id}",
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
     *         description="Updated successfully"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $hotel = $this->hoteles->updateHotel($id, $request);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }

        return response()->json($hotel);
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
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="hotel", type="string"),
     *              @OA\Property(property="descripcion", type="string"),
     *              @OA\Property(property="direccion", type="string"),
     *              @OA\Property(property="telefono", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="pagina_web", type="string"),
     *              @OA\Property(property="calificacion", type="integer"),
     *              @OA\Property(property="numero_habitaciones", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="Hotel not found",
     *        @OA\JsonContent(
     *           @OA\Property(property="message", type="string"),
     *          @OA\Property(property="error", type="string")
     *        )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $hotel = $this->hoteles->createHotel($request);

        return response()->json($hotel, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/hoteles/{id}",
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
     *         description="Deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $result = $this->hoteles->deleteHotel($id);

        return response()->json($result);
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
