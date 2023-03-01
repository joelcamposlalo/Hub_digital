<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\model\Tramites_model;
use App\model\Dias_inhabiles_model;

class Dias_inhabiles extends Controller
{

    /**
     * Abre la vista 
     */
    public function form($accion, $id = '')
    {

        $vars = [
            'accion'   => $accion,
            'tramites' => Tramites_model::get_all_by_coordinacion()
        ];

        if ($accion == 'Editar') {
            $vars += ['usuario' =>  Dias_inhabiles_model::get_by_id($id)];
        }

        return view('administrador/dias_inhabiles/form', $vars);
    }

    /**
     * Agrega la fecha
     */
    public function post(Request $request)
    {

        if (Dias_inhabiles_model::post($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se agregó el día inhábil correctamente'
            ]);

            Redirect::to(url('administrador/dias_inhabiles'))->send();
        } else {

            Redirect::to(url('dias_inhabiles/form/Agregar'))->send();
        }
    }

    /**
     * Actualiza la fecha
     */
    public function put(Request $request)
    {

        if (Dias_inhabiles_model::put($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se actualizó el día inhábil correctamente'
            ]);

            Redirect::to(url('administrador/dias_inhabiles'))->send();
        } else {
            Redirect::to(url('dias_inhabiles/form/Editar/' . $request['id_dia']))->send();
        }
    }

    /**
     * Elimina la fecha
     */

    public function remove(Request $request)
    {
        if (Dias_inhabiles_model::remove($request->id_dia)) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se eliminó el día correctamente'
            ]);

            http_response_code(200);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de eliminar el día'
            ]);

            abort(503);
        }
    }
}
