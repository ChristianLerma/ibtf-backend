<?php

namespace App\Models;

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
        return $this->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createAcomodacion($data)
    {
        return $this->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateAcomodacion($id, $data)
    {
        $acomodacion = $this->find($id);
        if ($acomodacion) {
            $acomodacion->update($data);
            return $acomodacion;
        }
        return null;
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
