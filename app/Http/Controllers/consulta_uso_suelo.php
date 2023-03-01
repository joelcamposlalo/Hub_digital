<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Predios_model;
use App\model\Licencias_model;
use App\model\Prelicencias_model;

class consulta_uso_suelo extends Controller
{
    //
    public function pre_consulta()
    {
        $vars = [
            'predios'   => Predios_model::get_all(0),
            'ultimo'    => Predios_model::get_count(),
            'giros'     => Licencias_model::get_giros(),
            'calles'    => Prelicencias_model::get_calles(),
            'colonias'  => Prelicencias_model::get_colonias(),
            'plazas'    => Licencias_model::get_plazas(),
        ];

        return view('consulta_uso_suelo/pre_consulta', $vars);
    }
}
