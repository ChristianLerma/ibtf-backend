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
     *       summary="Get all Tipos",
     *       tags={"Tipos"},
     *       @OA\Response(
     *          response=200,
     *          description="Tipos retrieved successfully",
     *      )
     *    ),
     * )
    */
    public function index()
    {
        /**
         * @OA\Get(
         *     path="/api/v1/tipos",
         *     summary="Get all Tipos",
         *     tags={"Tipos"},
         *     @OA\Response(
         *         response=200,
         *         description="Tipos retrieved successfully"
         *     )
         * )
         */
        $tipos = $this->tipos->getAllTipos();

        /**
         * @OA\Response(
         *    response=200,
         *   description="Tipos retrieved successfully",
         *   @OA\JsonContent(
         *       type="array",
         *      @OA\Items(ref="#/components/schemas/Tipos")
         *   )
         * )
         */
        return response()->json($tipos);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tipos/{id}",
     *     summary="Get Tipo by ID",
     *     tags={"Tipos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Tipo",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tipo retrieved successfully"
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
     *     summary="Update Tipos",
     *     tags={"Tipos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Tipos",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipos"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tipos updated successfully"
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
     *     summary="Create a new Tipos",
     *     tags={"Tipos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo", "descripcion"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tipos created successfully",
     *         @OA\JsonContent(
     *            @OA\Property(property="id", type="integer"),
     *            @OA\Property(property="tipo", type="string"),
     *            @OA\Property(property="descripcion", type="string"),
     *        )
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
     *     summary="Delete Tipos",
     *     tags={"Tipos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Tipos",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tipos deleted successfully"
     *     )
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
