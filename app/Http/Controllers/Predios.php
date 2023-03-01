<?php

namespace App\Http\Controllers;

use App\model\Predios_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class Predios extends Controller
{

    public function index()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        $vars = [
            'predios' => Predios_model::get_all_predios()
        ];

        return view('ciudadano/predios', $vars);
    }

    public function form($accion, $id_precio = '')
    {
        $vars = [];

        if ($accion == 'editar') {
        }

        return view('ciudadano/form_predio', $vars);
    }


    public function post(Request $request)
    {
        return Predios_model::post($request);
    }

    public function update()
    {
    }

    public function deleted(Request $request)
    {

        if (Predios_model::deleted($request->id_predio)) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'El predio se elimino correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type'  => 'danger',
                'msg'   => 'Ocurrió un preblema al tratar de eliminar el predio, por favor intenta más tarde'
            ]);

            abort(503);
        }
    }

    /**
     * Muestra todos los predios junto con
     * sus propietarios
     */

    public function get_all_users(Request $request)
    {

        if ($response = Predios_model::get_all_users($request->total, $request->curt)) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            abort(503);
        }
    }

    public function get_all(Request $request){

        if ($response = Predios_model::get_all($request->n)) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            abort(503);
        }

    }
}
