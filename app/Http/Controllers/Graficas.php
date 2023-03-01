<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Graficas_model;

class Graficas extends Controller
{

    /**
     * -------------------------------------------------------------
     * Revisor
     * -------------------------------------------------------------
     */

    /**
     * Muestra cuantas solicitudes hay por
     * cada estatus
     */

    public function solicitudes_estatus(Request $request)
    {
        if ($response = Graficas_model::solicitudes_estatus($request->all())) {
            echo json_encode($response);
        } else {
            abort(503);
        }
    }


    /**
     * -------------------------------------------------------------
     * Administrador
     * -------------------------------------------------------------
     */

    /**
     * Total de solicitudes atendidos por
     * parte de revisores
     * 
     */

    public function solicitudes_revisor(Request $request)
    {
        if ($response = Graficas_model::solicitudes_revisor($request->all())) {
            echo json_encode($response);
        } else {
            abort(503);
        }
    }
}
