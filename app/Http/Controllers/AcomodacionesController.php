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
     *    title="ITBF API",
     *    version="1.0.0",
     *    description="API for ITBF",
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
     *          @OA\JsonContent(
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="success", type="boolean"),
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
         *     path="/api/v1/acomodaciones",
         *     tags={"Acomodaciones"},
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
        $acomodaciones = $this->acomodaciones->getAllAcomodaciones();

        return $acomodaciones;
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
     *         description="Acomodacion not found",
     *         @OA\JsonContent
     *         (
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="object"),
     *             @OA\Property(property="error", type="object")
     *         )
     *     ),
     * )
     */
    public function show($id)
    {
        $acomodacion = $this->acomodaciones->getAcomodacionById($id);

        return $acomodacion;
    }

    /**
     * @OA\Put(
     *     path="/api/v1/acomodaciones/{id}/editar",
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
        $acomodacion = $this->acomodaciones->updateAcomodacion($id, $request);

        return $acomodacion;
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
        $acomodacion = $this->acomodaciones->createAcomodacion($request);

        return $acomodacion;
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/acomodaciones/{id}/eliminar",
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
        $acomodacion = $this->acomodaciones->deleteAcomodacion($id);

        return $acomodacion;
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
