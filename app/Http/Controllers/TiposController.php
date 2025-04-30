<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;

class TiposController extends Controller
{
    private $tipos;

    public function __construct(Tipos $tipos)
    {
        $this->tipos = $tipos;
    }

    public function index()
    {
        $tipos = $this->tipos->getAllTipos();

        return response()->json($tipos);
    }
}
