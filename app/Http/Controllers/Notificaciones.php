<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Notificaciones_model;

class Notificaciones extends Controller
{


    public function visto(Request $request)
    {

        if (Notificaciones_model::visto($request->id_notificacion)) {
            http_response_code(200);
        } else {

            abort(503);
        }
    }


    public function eliminar(Request $request)
    {

        if (Notificaciones_model::eliminar($request->id_notificacion)) {
            http_response_code(200);
        } else {

            abort(503);
        }
    }
}
