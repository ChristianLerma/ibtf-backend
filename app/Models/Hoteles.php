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
            'message' => $message,
            'error' => $message,
        ];
    }

    /**
     * @return mixed
     */
    public function getAllHoteles()
    {
        $hoteles = $this->leftJoin('habitaciones', 'hoteles.id', '=', 'habitaciones.hotel_id')
            ->select('hoteles.*', \DB::raw('SUM(habitaciones.hotel_id) as total_habitaciones'))
             ->groupBy('hoteles.id')
             ->get();

        foreach ($hoteles as $hotel) {
            if ($hotel->total_habitaciones == null) {
                $hotel->total_habitaciones = +0;
            }else {
                $hotel->total_habitaciones = +$hotel->total_habitaciones;
            }

            if ($hotel->calificacion == null) {
                $hotel->calificacion += 0;
            }
        }

        return response()->json(
            $this->successResponse(
                $hoteles,
                'Hoteles retrieved successfully')

                , 200
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getHotelById($id)
    {
        try {
            $hotel = $this->findOrFail($id)->leftJoin('habitaciones', 'hoteles.id', '=', 'habitaciones.hotel_id')
                ->select('hoteles.*', \DB::raw('SUM(habitaciones.hotel_id) as total_habitaciones'))
                ->groupBy('hoteles.id')
                ->first();
            if ($hotel->total_habitaciones == null) {
                $hotel->total_habitaciones += 0;
            }else {
                $hotel->total_habitaciones = +$hotel->total_habitaciones;
            }

            if ($hotel->calificacion == null) {
                $hotel->calificacion = +0;
            }

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
                    'Hotel not found')
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
            if ($newHotel->id == null) $newHotel->id = 1;
            if ($newHotel->id == 0) $newHotel->id = 1;
            if ($newHotel->id == '') $newHotel->id = 1;

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
                    'Hotel not created')
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
                    'Hotel not found')
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
                    'Hotel not found')
                , 500
            );
        }
    }
}
