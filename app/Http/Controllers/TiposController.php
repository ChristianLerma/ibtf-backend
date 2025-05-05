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
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *          )
     *       )
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
         *         description="Retrieved successfully",
         *         @OA\JsonContent(
         *            @OA\Property(property="success", type="boolean"),
         *            @OA\Property(property="data", type="object"),
         *            @OA\Property(property="message", type="object"),
         *            @OA\Property(property="error", type="object")
         *         )
         *     )
         * )
         */
        $tipos = $this->tipos->getAllTipos();

        return $tipos;
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
    public function show($id)
    {
        $tipo = $this->tipos->getTipoById($id);

        return $tipo;
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tipos/{id}/editar",
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
        $tipo = $this->tipos->updateTipo($id, $request);

        return $tipo;
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
        $tipo = $this->tipos->createTipo($request);

        return $tipo;
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/tipos/{id}/eliminar",
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
    public function destroy($id)
    {
        $tipo = $this->tipos->deleteTipo($id);

        return $tipo;
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
