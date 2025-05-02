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
     *       tags={"Acomodaciones"},
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
         *     path="/api/v1/acomodaciones",
         *     tags={"Acomodaciones"},
         *     summary="Get all registers",
         *     @OA\Response(
         *         response=200,
         *         description="Retrieved successfully"
         *     )
         * )
         */
        $acomodaciones = $this->acomodaciones->getAllAcomodaciones();

        return response()->json($acomodaciones);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/acomodaciones/{id}",
     *     tags={"Acomodaciones"},
     *     summary="Get register by ID",
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
        $acomodacion = $this->acomodaciones->getAcomodacionById($id);
        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodacion not found'], 404);
        }
        return response()->json($acomodacion);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/acomodaciones/{id}",
     *     tags={"Acomodaciones"},
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
     *             required={"acomodacion"},
     *             @OA\Property(property="acomodacion", type="string"),
     *             @OA\Property(property="descripcion", type="string")
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
        $acomodacion = $this->acomodaciones->updateAcomodacion($id, $request);
        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodacion not found'], 404);
        }

        return response()->json($acomodacion);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/acomodaciones",
     *     tags={"Acomodaciones"},
     *     summary="Create a new register",
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
     *         description="Created successfully",
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
     *     tags={"Acomodaciones"},
     *     summary="Delete register",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service response message",
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *    @OA\Response(
     *        response=500,
     *       description="Internal server error"
     *    )
     * )
     */
    public function destroy($id)
    {
        $result = $this->acomodaciones->deleteAcomodacion($id);

        return response()->json($result);
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
