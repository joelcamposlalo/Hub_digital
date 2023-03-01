<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Ciudadano_model;
use App\model\Revisor_model;
use App\model\Graficas_model;
use App\model\Dias_inhabiles_model;

class Administrador extends Controller
{

    /**
     * Obtiene todos los usuarios para mostrarlos
     * en administrador
     * 
     */

    public function ciudadanos()
    {
        return view('administrador/ciudadanos');
    }

    public function detalle($id_usuario)
    {

        $vars = [
            'ciudadano' => Ciudadano_model::get_detalle($id_usuario)
        ];

        return view('administrador/detalle_ciudadano', $vars);
    }

    public function predios()
    {
        return view('administrador/predios');
    }

    public function reportes()
    {
        return view('administrador/reportes');
    }

    public function revisores()
    {

        $vars = [
            'revisores' => Revisor_model::get_all_by_coordinacion()
        ];

        return view('administrador/revisor/revisores', $vars);
    }

    public function dias_inhabiles()
    {

        $vars = [
            'dias' => Dias_inhabiles_model::get_all()
        ];

        return view('administrador/dias_inhabiles/dias', $vars);
    }
}
