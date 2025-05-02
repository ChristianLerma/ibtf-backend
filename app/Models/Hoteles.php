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

    /**
     * @return mixed
     */
    public function getAllHoteles()
    {
        return $this->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getHotelById($id)
    {
        try {
            $hotel = $this->findOrFail($id);

            return $hotel;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Hotel not found',
            ], 404);
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

            return $newHotel;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating hotel',
                'error' => $th->getMessage(),
            ], 500);
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

            return $hotel;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating hotel',
                'error' => $th->getMessage(),
            ], 500);
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

            return response()->json([
                'message' => 'Hotel deleted successfully',
                'message' => 'Acomodacion deleted sussesfull',
            ], 204);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error deleting hotel',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @param $hotel
     * @return mixed
     */
    public function getHotelByName($hotel)
    {
        return $this->where('hotel', $hotel)->first();
    }

    /**
     * @param $descripcion
     * @return mixed
     */
    public function getHotelByDescripcion($descripcion)
    {
        return $this->where('descripcion', $descripcion)->first();
    }

    /**
     * @param $telefono
     * @return mixed
     */
    public function getHotelByTelefono($telefono)
    {
        return $this->where('telefono', $telefono)->first();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getHotelByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * @param $pagina_web
     * @return mixed
     */
    public function getHotelByPaginaWeb($pagina_web)
    {
        return $this->where('pagina_web', $pagina_web)->first();
    }

    /**
     * @param $calificacion
     * @return mixed
     */
    public function getHotelByCalificacion($calificacion)
    {
        return $this->where('calificacion', $calificacion)->first();
    }

    /**
     * @param $numero_habitaciones
     * @return mixed
     */
    public function getHotelByNumeroHabitaciones($numero_habitaciones)
    {
        return $this->where('numero_habitaciones', $numero_habitaciones)->first();
    }

    /**
     * @return mixed
     */
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
}
