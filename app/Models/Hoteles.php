<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Acomodaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hoteles extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'hotel',
        'descripcion',
        'direccion',
        'telefono',
        'email',
        'pagina_web',
        'calificacion',
        'numero_habitaciones',

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
    protected $table = 'hoteles';
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
            'message' => ['error' => $message],
            'error' => $message,
        ];
    }

    /**
     * @return mixed
     */
    public function getAllHoteles()
    {
        try {
            $hoteles = $this->all();

            return response()->json(
                $this->successResponse(
                    $hoteles,
                    'Hoteles retrieved successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error retrieving hoteles')
                , 500
            );
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getHotelById($id)
    {
        try {
            $hotel = $this->findOrFail($id);

            return response()->json(
                $this->successResponse(
                    $hotel,
                    'Hotel retrieved successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error retrieving hotel')
                , 500
            );
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createHotel(Request $request)
    {
        try {
            $request->validate([
                'hotel' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'pagina_web' => 'nullable|string|max:255',
                'calificacion' => 'nullable|integer|min:1|max:5',
                'numero_habitaciones' => 'nullable|integer|min:1',
            ]);

            $newHotel = new Hoteles();

            $newHotel->id = Hoteles::max('id') + 1;
            if ($newHotel->id == null) {
                $newHotel->id = 1;
            }
            if ($newHotel->id == 0) {
                $newHotel->id = 1;
            }
            if ($newHotel->id == '') {
                $newHotel->id = 1;
            }

            $newHotel->hotel = $request->hotel;
            $newHotel->descripcion = $request->descripcion;
            $newHotel->direccion = $request->direccion;
            $newHotel->telefono = $request->telefono;
            $newHotel->email = $request->email;
            $newHotel->pagina_web = $request->pagina_web;
            $newHotel->calificacion = $request->calificacion;
            $newHotel->numero_habitaciones = $request->numero_habitaciones;
            $newHotel->created_at = now();
            $newHotel->updated_at = now();

            $newHotel->save();

            return response()->json(
                $this->successResponse(
                    $newHotel,
                    'Hotel created successfully')
                , 201
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error creating hotel')
                , 500
            );
        }
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function updateHotel($id, Request $request)
    {
        try {
            $request->validate([
                'hotel' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'pagina_web' => 'nullable|url|max:255',
                'calificacion' => 'nullable|integer|min:1|max:5',
                'numero_habitaciones' => 'nullable|integer|min:1',
            ]);

            $hotel = $this->findOrFail($id);

            if ($request->has('hotel')) {
                $hotel->hotel = $request->hotel;
            }
            if ($request->has('descripcion')) {
                $hotel->descripcion = $request->descripcion;
            }
            if ($request->has('direccion')) {
                $hotel->direccion = $request->direccion;
            }
            if ($request->has('telefono')) {
                $hotel->telefono = $request->telefono;
            }
            if ($request->has('email')) {
                $hotel->email = $request->email;
            }
            if ($request->has('pagina_web')) {
                $hotel->pagina_web = $request->pagina_web;
            }
            if ($request->has('calificacion')) {
                $hotel->calificacion = $request->calificacion;
            }
            if ($request->has('numero_habitaciones')) {
                $hotel->numero_habitaciones = $request->numero_habitaciones;
            }

            $hotel->updated_at = now();

            $hotel->update();

            return response()->json(
                $this->successResponse(
                    $hotel,
                    'Hotel updated successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error updating hotel')
                , 500
            );
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteHotel($id)
    {
        try {
            $hotel = $this->findOrFail($id);

            $hotel->delete();

            return response()->json(
                $this->successResponse(
                    $hotel,
                    'Hotel deleted successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error deleting hotel')
                , 500
            );
        }
    }

    /**
     * @param $hotel
     * @return mixed
     */
    public function getHotelByName($hotel)
    {
        try {
            $hotel = $this->where('hotel', $hotel)->first();

            return response()->json(
                $this->successResponse(
                    $hotel,
                    'Hotel retrieved successfully')
                , 200
            );
        } catch (\Throwable $th) {
            return response()->json(
                $this->errorResponse(
                    $th,
                    'Error retrieving hotel')
                , 500
            );
        }
    }

    public function getAcomodaciones()
    {
        return $this->hasMany(Acomodaciones::class, 'id_hotel', 'id');
    }

    /**
     * @return mixed
     */
    public function getAcomodacionesByHotel($id)
    {
        return $this->getAcomodaciones()->where('id_hotel', $id)->get();
    }

    /**
     * @return mixed
     */
    public function getAcomodacionesByHotelAndTipo($id, $tipo)
    {
        return $this->getAcomodacionesByHotel($id)->where('id_tipo', $tipo)->get();
    }

    /**
     * @return mixed
     */
    public function getTipos()
    {
        return $this->hasMany(Tipos::class, 'id_hotel', 'id');
    }

    /**
     * @return mixed
     */
    public function getTiposByHotel($id)
    {
        return $this->getTipos()->where('id_hotel', $id)->get();
    }

    /**
     * @return mixed
     */
    public function getTiposByHotelAndTipo($id, $tipo)
    {
        return $this->getTiposByHotel($id)->where('id_tipo', $tipo)->get();
    }

    /**
     * @return mixed
     */
    public function getHabitaciones()
    {
        return $this->hasMany(Habitaciones::class, 'id_hotel', 'id');
    }

    /**
     * @return mixed
     */
    public function getHabitacionesByHotel($id)
    {
        return $this->getHabitaciones()->where('id_hotel', $id)->get();
    }
}
