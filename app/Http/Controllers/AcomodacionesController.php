<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acomodaciones;

class AcomodacionesController extends Controller
{
    private $acomodaciones;

    public function __construct(Acomodaciones $acomodaciones)
    {
        $this->acomodaciones = $acomodaciones;
    }

    public function index()
    {
        $acomodaciones = $this->acomodaciones->getAllAcomodaciones();

        return response()->json($acomodaciones);
    }
}
