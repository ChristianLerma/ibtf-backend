<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Habitaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habitaciones extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'habitacion',
        'descripcion',
        'hotel_id',
        'acomodacion_id',
        'tipo_id',

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
    protected $table = 'habitaciones';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @return mixed
     */
    public function getAllHabitaciones()
    {
        return $this->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getHabitacionById($id)
    {
        try {
            $habitacion = $this->findOrFail($id);

            return $habitacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Habitacion not found',
                'error' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createHabitacion(Request $request)
    {
        try {
            $request->validate([
                'habitacion' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'hotel_id' => 'required|exists:hoteles,id',
                'acomodacion_id' => 'required|exists:acomodaciones,id',
                'tipo_id' => 'required|exists:tipos,id',
            ]);

            $newHabitacion = new Habitaciones();

            $newHabitacion->id = Habitaciones::max('id') + 1;
            if($newHabitacion->id == null){
                $newHabitacion->id = 1;
            }
            if($newHabitacion->id == 0){
                $newHabitacion->id = 1;
            }
            if($newHabitacion->id == ''){
                $newHabitacion->id = 1;
            }

            $newHabitacion->habitacion = $request->habitacion;
            $newHabitacion->descripcion = $request->descripcion;
            $newHabitacion->hotel_id = $request->hotel_id;
            $newHabitacion->acomodacion_id = $request->acomodacion_id;
            $newHabitacion->tipo_id = $request->tipo_id;
            $newHabitacion->created_at = now();
            $newHabitacion->updated_at = now();

            $newHabitacion->save();

            return $newHabitacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating habitacion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateHabitacion($id, Request $request)
    {
        try {
            $data = $request->validate([
                'habitacion' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'hotel_id' => 'required|exists:hoteles,id',
                'acomodacion_id' => 'required|exists:acomodaciones,id',
                'tipo_id' => 'required|exists:tipos,id',
            ]);

            $habitacion = $this->findOrFail($id);

            if($request->has('habitacion')) {
                $habitacion->habitacion = $request->habitacion;
            }
            if($request->has('descripcion')) {
                $habitacion->descripcion = $request->descripcion;
            }
            if($request->has('hotel_id')) {
                $habitacion->hotel_id = $request->hotel_id;
            }
            if($request->has('acomodacion_id')) {
                $habitacion->acomodacion_id = $request->acomodacion_id;
            }
            if($request->has('tipo_id')) {
                $habitacion->tipo_id = $request->tipo_id;
            }
            $habitacion->updated_at = now();

            $habitacion->update();

            return $habitacion;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating habitacion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteHabitacion($id)
    {
        try {
            $habitacion = $this->findOrFail($id);
            $habitacion->delete();

            return response()->json([
                'message' => 'Habitacion deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error deleting habitacion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    /**
     * @param $habitacion
     * @return mixed
     */
    public function getHabitacionByName($habitacion)
    {
        return $this->where('habitacion', $habitacion)->first();
    }

    /**
     * @param $descripcion
     * @return mixed
     */
    public function getHabitacionByDescripcion($descripcion)
    {
        return $this->where('descripcion', $descripcion)->first();
    }

    /**
     * @param $hotel_id
     * @return mixed
     */
    public function getHabitacionByHotelId($hotel_id)
    {
        return $this->where('hotel_id', $hotel_id)->get();
    }

    /**
     * @param $acomodacion_id
     * @return mixed
     */
    public function getHabitacionByAcomodacionId($acomodacion_id)
    {
        return $this->where('acomodacion_id', $acomodacion_id)->get();
    }

    /**
     * @param $tipo_id
     * @return mixed
     */
    public function getHabitacionByTipoId($tipo_id)
    {
        return $this->where('tipo_id', $tipo_id)->get();
    }
}
