<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Acomodaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acomodaciones extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'acomodacion',
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
    protected $table = 'acomodaciones';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @return mixed
     */
    public function getAllAcomodaciones()
    {
        return $this->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAcomodacionById($id)
    {
        try {
            $acomodacion = $this->findOrFail($id);

            return $acomodacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Acomodacion not found',
                'error' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createAcomodacion(Request $request)
    {
        try {
            $request->validate([
                'acomodacion' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $newAcomodacion = new Acomodaciones();

            $newAcomodacion->acomodacion = $request->acomodacion;
            $newAcomodacion->descripcion = $request->descripcion;
            $newAcomodacion->created_at = now();
            $newAcomodacion->updated_at = now();

            $newAcomodacion->save();

            return $newAcomodacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating Acomodacion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function updateAcomodacion($id, Request $request)
    {
        try {
            $data = $request->validate([
                'acomodacion' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $acomodacion = $this->findOrFail($id);

            if($request->has('acomodacion')) {
                $acomodacion->acomodacion = $request->acomodacion;
            }

            if($request->has('descripcion')) {
                $acomodacion->descripcion = $request->descripcion;
            }

            $acomodacion->updated_at = now();

            $acomodacion->update();

            return $acomodacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating Acomodacion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteAcomodacion($id)
    {
        $acomodacion = $this->find($id);
        if ($acomodacion) {
            $acomodacion->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $acomodacion
     * @return mixed
     */
    public function getAcomodacionByName($acomodacion)
    {
        return $this->where('acomodacion', $acomodacion)->first();
    }

    /**
     * @param $descripcion
     * @return mixed
     */
    public function getAcomodacionByCreatedAt($created_at)
    {
        return $this->where('created_at', $created_at)->first();
    }

    /**
     * @param $updated_at
     * @return mixed
     */
    public function getAcomodacionByUpdatedAt($updated_at)
    {
        return $this->where('updated_at', $updated_at)->first();
    }
}
