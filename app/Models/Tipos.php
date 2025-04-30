<?php

namespace App\Models;

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
        return $this->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createTipo($data)
    {
        return $this->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed|null
     */
    public function updateTipo($id, $data)
    {
        $tipo = $this->find($id);
        if ($tipo) {
            $tipo->update($data);
            return $tipo;
        }
        return null;
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

    /**
     * @param $tipo
     * @return mixed
     */
    public function getTipoByName($tipo)
    {
        return $this->where('tipo', $tipo)->first();
    }

    /**
     * @param $created_at
     * @return mixed
     */
    public function getTipoByCreatedAt($created_at)
    {
        return $this->where('created_at', $created_at)->first();
    }

    /**
     * @param $updated_at
     * @return mixed
     */
    public function getTipoByUpdatedAt($updated_at)
    {
        return $this->where('updated_at', $updated_at)->first();
    }
}
