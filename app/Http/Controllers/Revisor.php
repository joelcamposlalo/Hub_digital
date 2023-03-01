<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Solicitudes_model;
use App\model\Notificaciones_model;
use App\model\Revisor_model;
use App\model\Ciudadano_model;
use App\model\Tramites_model;
use App\model\Acreditaciones_model;
use App\model\Trabajos_menores_model;
use App\model\Prelicencias_model;
use App\model\Licencias_model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;



class Revisor extends Controller
{

    /**
     * Obtiene la vista del listado del revisor
     * 
     * @return view 
     */

    public function solicitudes()
    {
        
        return view('revisor/solicitudes');
    }

    public function reportes()
    {
        return view('revisor/reportes');
    }

    public function detalle(Request $request)
    {

        if ($request->id_tramite == 1) {
            $vars = ['ciudadano' => Trabajos_menores_model::get_by_id($request->id_solicitud)];
            return view('revisor/trabajos_menores/detalle', $vars);
        } else if ($request->id_tramite == 2) {
            //Licencia de contruccion
            return view('revisor/#/detalles');
        } else if ($request->id_tramite == 3) {
            $vars = ['ciudadano' => Acreditaciones_model::get_by_id($request->id_solicitud)];
            return view('revisor/acreditaciones/detalle', $vars);
        } else if ($request->id_tramite == 4) {
            $vars = ['ciudadano' => Prelicencias_model::get_by_id($request->id_solicitud)];
            return view('revisor/prelicencias/detalle', $vars);
        } else if ($request->id_tramite == 7) {
            $vars = ['ciudadano' => Licencias_model::get_by_id($request->id_solicitud)];
            if ($request->id_etapa == 41) {
                return view('revisor/licencias/detalles_uso_suelo', $vars);
            }
        }
    }

    public function notificaciones()
    {

        $vars = [
            'notificaciones' => Notificaciones_model::get_all_by_session()
        ];

        return view('revisor/notificaciones', $vars);
    }

    /**
     * Administrador
     * 
     * Muestra el formulario para crear o editar un 
     * revisor
     * 
     */

    public function form($accion, $id_usuario = '')
    {
        $vars = [
            'accion'   => $accion,
            'tramites' => Tramites_model::get_all_by_coordinacion()
        ];

        if ($accion == 'Editar') {
            $vars += ['usuario' => Ciudadano_model::get_by_id($id_usuario)];
        }

        return view('administrador/revisor/form', $vars);
    }

    public function post(Request $request)
    {

        $request->validate([
            'correo'      => 'required|email|unique:usuarios',
            'contrasena'  => 'required|min:8',
            'ccontrasena' => 'same:contrasena|min:8'
        ]);

        if (Revisor_model::post($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se agregó el revisor correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de agregar el revisor'
            ]);
        }

        Redirect::to(url('administrador/revisores'))->send();
    }

    public function put(Request $request)
    {

        if (!empty($request['contrasena']) && !empty($request['ccontrasena'])) {
            $request->validate([
                'contrasena'  => 'required|min:8',
                'ccontrasena' => 'same:contrasena|min:8'
            ]);
        }

        //Validar que no exista el correo
        $usuario = DB::table('usuarios')
            ->where('id_usuario', $request->id_usuario)
            ->first();

        if ($usuario->correo != $request->correo) {
            $request->validate([
                'correo'      => 'required|email|unique:usuarios',
            ]);
        }

        if (Revisor_model::put($request->all())) {
            session()->flash('alert', [
                'type' => 'info',
                'msg'  => 'Se actualizó el revisor correctamente'
            ]);

            Redirect::to(url('administrador/revisores'))->send();
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Debe al menos dejar un revisor activo para el trámite'
            ]);

            Redirect::to(url('revisor/form/Editar/' . $request->id_usuario))->send();
        }
    }

    public function remove()
    {
    }
}
