<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;
use Illuminate\Routing\Controller;

class TiposController extends Controller
{
    /**
     * @var Tipos
     */
    private $tipos;

    /**
     * TiposController constructor.
     *
     * @param Tipos $tipos
     */
    public function __construct(Tipos $tipos)
    {
        $this->tipos = $tipos;
    }

    /**
     * @OA\PathItem(
     *    path="/api/v1/tipos",
     *    @OA\Get(
     *       path="/api/v1/tipos",
     *       tags={"Tipos"},
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
         *     path="/api/v1/tipos",
         *     tags={"Tipos"},
         *     summary="Get all registers",
         *     @OA\Response(
         *         response=200,
         *         description="Retrieved successfully"
         *     )
         * )
         */
        $tipos = $this->tipos->getAllTipos();

        return response()->json($tipos);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tipos/{id}",
     *     tags={"Tipos"},
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
        $tipo = $this->tipos->getTipoById($id);
        if (!$tipo) {
            return response()->json([
                'message' => 'Tipo not found',
            ], 404);
        }
        return response()->json($tipo);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tipos/{id}",
     *     tags={"Tipos"},
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
     *             required={"tipo"},
     *             @OA\Property(property="tipo", type="string"),
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
        $tipo = $this->tipos->updateTipo($id, $request);
        if (!$tipo) {
            return response()->json(['message' => 'Tipos not found'], 404);
        }

        return response()->json($tipo);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/tipos",
     *     tags={"Tipos"},
     *     summary="Create a new register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $tipo = $this->tipos->createTipo($request);

        return response()->json($tipo, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/tipos/{id}",
     *     tags={"Tipos"},
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
        $tipo = $this->tipos->getTipoById($id);
        if (!$tipo) {
            return response()->json(['message' => 'Tipo not found'], 404);
        }

        $tipo->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Schema(
     *     schema="Tipos",
     *     type="object",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="tipo", type="string"),
     *     @OA\Property(property="descripcion", type="string"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
}
