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

    public function successResponse(object $data, string $message = 'Success')
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
            'error' => [],
        ];
    }

    public function errorResponse(object $data, string $message = 'Error')
    {
        return [
            'success' => false,
            'data' => $data,
            'message' => $message,
            'error' => $message,
        ];
    }

    /**
     * @return mixed
     */
    public function getAllHabitaciones()
    {
        $habitaciones = $this->all();

        return response()->json($this->successResponse(
            $habitaciones,
            'Habitaciones retrieved successfully')
            , 200
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getHabitacionById($id)
    {
        try {
            $habitacion = $this->findOrFail($id)
                ->join('hoteles', 'habitaciones.hotel_id', '=', 'hoteles.id')
                ->join('acomodaciones', 'habitaciones.acomodacion_id', '=', 'acomodaciones.id')
                ->join('tipos', 'habitaciones.tipo_id', '=', 'tipos.id')
                ->select(
                    'habitaciones.id',
                    'habitaciones.habitacion',
                    'habitaciones.descripcion',
                    'habitaciones.hotel_id',
                    'hoteles.hotel as hotel',
                    'habitaciones.acomodacion_id',
                    'acomodaciones.acomodacion as acomodacion',
                    'habitaciones.tipo_id',
                    'tipos.tipo as tipo',
                    'habitaciones.created_at',
                    'habitaciones.updated_at'
                )
                ->first();

            return response()->json(
                $this->successResponse(
                    $habitacion,
                    'Habitacion retrieved successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th->getMessage(),
                    'Habitacion not found')
                , 404
            );
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getHabitacionesByHotelId($hotel_id)
    {
        $habitacion = $this->where('hotel_id', $hotel_id)
            ->join('hoteles', 'habitaciones.hotel_id', '=', 'hoteles.id')
            ->join('acomodaciones', 'habitaciones.acomodacion_id', '=', 'acomodaciones.id')
            ->join('tipos', 'habitaciones.tipo_id', '=', 'tipos.id')
            ->select(
                'habitaciones.id',
                'habitaciones.habitacion',
                'habitaciones.descripcion',
                'habitaciones.hotel_id',
                'hoteles.hotel as hotel',
                'habitaciones.acomodacion_id',
                'acomodaciones.acomodacion as acomodacion',
                'habitaciones.tipo_id',
                'tipos.tipo as tipo',
                'habitaciones.created_at',
                'habitaciones.updated_at'
            )
            ->get();

        return response()->json(
            $this->successResponse(
                $habitacion,
                'Habitaciones retrieved successfully')
            , 200
        );
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
            if($newHabitacion->id == null) $newHabitacion->id = 1;
            if($newHabitacion->id == 0) $newHabitacion->id = 1;
            if($newHabitacion->id == '') $newHabitacion->id = 1;

            $newHabitacion->habitacion = $request->habitacion;
            $newHabitacion->descripcion = $request->descripcion;
            $newHabitacion->hotel_id = $request->hotel_id;
            $newHabitacion->acomodacion_id = $request->acomodacion_id;
            $newHabitacion->tipo_id = $request->tipo_id;
            $newHabitacion->created_at = now();
            $newHabitacion->updated_at = now();

            $newHabitacion->save();

            return response()->json(
                $this->successResponse(
                    $newHabitacion,
                    'Habitacion created successfully')
                , 201
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th->getMessage(),
                    'Habitacion not created')
                , 500
            );
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateHabitacion($id, Request $request)
    {
        try {
            $habitacion = $this->findOrFail($id);

            $request->validate([
                'habitacion' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'hotel_id' => 'required|exists:hoteles,id',
                'acomodacion_id' => 'required|exists:acomodaciones,id',
                'tipo_id' => 'required|exists:tipos,id',
            ]);

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

            return response()->json(
                $this->successResponse(
                    $habitacion,
                    'Habitacion updated successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th->getMessage(),
                    'Habitacion not found')
                , 500
            );
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

            return response()->json(
                $this->successResponse(
                    $habitacion,
                    'Habitacion deleted successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th->getMessage(),
                    'Habitacion not found')
                , 500
            );
        }
    }
}
