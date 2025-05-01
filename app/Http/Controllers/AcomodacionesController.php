<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acomodaciones;
use Illuminate\Routing\Controller;

class AcomodacionesController extends Controller
{
    /**
     * @var Acomodaciones
     */
    private $acomodaciones;

    /**
     * AcomodacionesController constructor.
     *
     * @param Acomodaciones $acomodaciones
     */
    public function __construct(Acomodaciones $acomodaciones)
    {
        $this->acomodaciones = $acomodaciones;
    }

    /**
     * @OA\Info(
     *    title="IBTF API",
     *    version="1.0.0",
     *    description="API for IBTF",
     *    @OA\Contact(
     *        name="Christian Lerma",
     *        email="christianlerma@gmail.com",
     *        url="",
     *    ),
     *    @OA\License(
     *        name="Apache 2.0",
     *        url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *    ),
     *    @OA\Server(
     *        url="http://localhost:8000/api/v1",
     *        description="Local Server"
     *    ),
     * )
     *
     * @OA\PathItem(
     *    path="/api/v1/acomodaciones",
     *    @OA\Get(
     *       path="/api/v1/acomodaciones",
     *       summary="Get all Acomodaciones",
     *       tags={"Acomodaciones"},
     *       @OA\Response(
     *          response=200,
     *          description="Acomodaciones retrieved successfully",
     *      )
     *    ),
     * )
    */
    public function index()
    {
        /**
         * @OA\Get(
         *     path="/api/v1/acomodaciones",
         *     summary="Get all Acomodaciones",
         *     tags={"Acomodaciones"},
         *     @OA\Response(
         *         response=200,
         *         description="Acomodaciones retrieved successfully"
         *     )
         * )
         */
        $acomodaciones = $this->acomodaciones->getAllAcomodaciones();

        /**
         * @OA\Response(
         *    response=200,
         *   description="Acomodaciones retrieved successfully",
         *   @OA\JsonContent(
         *       type="array",
         *      @OA\Items(ref="#/components/schemas/Acomodaciones")
         *   )
         * )
         */
        return response()->json($acomodaciones);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/acomodaciones/{id}",
     *     summary="Get Acomodacion by ID",
     *     tags={"Acomodaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Acomodacion",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acomodacion retrieved successfully"
     *     )
     * )
     */
    public function show($id)
    {
        $acomodacion = $this->acomodaciones->getAcomodacionById($id);
        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodacion not found'], 404);
        }
        return response()->json($acomodacion);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/acomodaciones/{id}",
     *     summary="Update Acomodacion",
     *     tags={"Acomodaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Acomodacion",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"acomodacion"},
     *             @OA\Property(property="acomodacion", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acomodacion updated successfully"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $acomodacion = $this->acomodaciones->updateAcomodacion($id, $request);
        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodacion not found'], 404);
        }

        return response()->json($acomodacion);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/acomodaciones",
     *     summary="Create a new Acomodacion",
     *     tags={"Acomodaciones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"acomodacion"},
     *             @OA\Property(property="acomodacion", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Acomodacion created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="acomodacion", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $acomodacion = $this->acomodaciones->createAcomodacion($request);

        return response()->json($acomodacion, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/acomodaciones/{id}",
     *     summary="Delete Acomodacion",
     *     tags={"Acomodaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Acomodacion",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Acomodacion deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $acomodacion = $this->acomodaciones->getAcomodacionById($id);
        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodacion not found'], 404);
        }

        $acomodacion->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Schema(
     *     schema="Acomodaciones",
     *     type="object",
     *     title="Acomodaciones",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="acomodacion", type="string"),
     *     @OA\Property(property="descripcion", type="string"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time"),
     * )
     */
}
