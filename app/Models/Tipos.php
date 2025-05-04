<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Tipos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tipos extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'tipo',
        'descripcion',

        'created_at',
        'updated_at',
    ];

    protected $cast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @var string
     */
    protected $table = 'tipos';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @return mixed
     */
    public function getAllTipos()
    {
        return $this->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTipoById($id)
    {
        try {
            $tipo = $this->findOrFail($id);

            return $tipo;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo not found',
                'error' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createTipo(Request $request)
    {
        try {
            $request->validate([
                'tipo' => 'required|string|max:100',
                'descripcion' => 'required|string|max:500',
            ]);

            $newTipo = new Tipos();

            $newTipo->id = Tipos::max('id') + 1;
            if ($newTipo->id == null) {
                $newTipo->id = 1;
            }
            if ($newTipo->id == 0) {
                $newTipo->id = 1;
            }
            if ($newTipo->id == '') {
                $newTipo->id = 1;
            }

            $newTipo->tipo = $request->tipo;
            $newTipo->descripcion = $request->descripcion;
            $newTipo->created_at = now();
            $newTipo->updated_at = now();

            $newTipo->save();

            return $newTipo;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating Tipo',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @param $request
     * @return mixed|null
     */
    public function updateTipo($id, Request $request)
    {
        try {
            $data = $request->validate([
                'tipo' => 'required|string|max:100',
                'descripcion' => 'required|string|max:500',
            ]);

            $tipo = $this->findOrFail($id);

            if ($request->has('tipo')) {
                $tipo->tipo = $request->tipo;
            }

            if ($request->has('descripcion')) {
                $tipo->descripcion = $request->descripcion;
            }

            $tipo->updated_at = now();

            $tipo->update();

            return $tipo;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating Tipo',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteTipo($id)
    {
        $tipo = $this->find($id);
        if ($tipo) {
            $tipo->delete();
            return true;
        }
        return false;
    }
}
