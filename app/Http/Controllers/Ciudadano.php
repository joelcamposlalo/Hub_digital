<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Ciudadano_model;
use App\model\Solicitudes_model;
use App\model\Notificaciones_model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use League\Flysystem\Filesystem;

class Ciudadano extends Controller
{

    /**
     * Obtiene la vista de expediente del ciudadano
     * 
     * @return view 
     */

    public function expediente()
    {
        session(['lastpage' => __FILE__]);

        $vars = [
            'usuario' => Ciudadano_model::get_all_by_id(),
            'files'   => Ciudadano_model::get_files()
        ];

        return view('ciudadano/expediente', $vars);
    }

    /**
     * Obtiene todos los tramites del
     * ciudadano
     * 
     * @return view 
     */

    public function tramites()
    {

        /**
         * Funcion para cancelar trámites despues de 
         * 3 dias habiles para trabajos menores
         */

        cancelacion_tres_dias();

        // primera_vista valida que el usuario haya llenado sus d <atos
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        $vars = [
            'solicitudes'        => Solicitudes_model::get_all('ciudadano'),
            'count_calificacion' => Ciudadano_model::get_count_calificacion()
        ];

        session(['lastpage' => __FILE__]);

        return view('ciudadano/tramites', $vars);
    }

    /**
     * Muestra la vista para seleccionar un
     * trámite a realizar
     * 
     * @return view 
     */

    public function nuevo()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }
        session(['lastpage' => __FILE__]);
        return view('ciudadano/nuevo_tramite');
    }

    public function descanso()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        return view('ciudadano/descanso');
    }

    public function notificaciones()
    {

        $vars = [
            'notificaciones' => Notificaciones_model::get_all_by_session()
        ];

        return view('ciudadano/notificaciones', $vars);
    }

    public function citas()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }
        session(['lastpage' => __FILE__]);
        return view('ciudadano/citas_linea');
    }

    public function pagos()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }
        session(['lastpage' => __FILE__]);
        return view('ciudadano/pagos_linea');
    }

    public function padron_licencias()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }
        session(['lastpage' => __FILE__]);
        return view('ciudadano/padron_licencias');
    }

    public function obras_publicas()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        $vars = [
            'leyendaVac' => Ciudadano_model::get_leyenda_vac(1, ''),
            'hoy'        => date("Y-m-d H:i:s")
        ];

        
        session(['lastpage' => __FILE__]);
        return view('ciudadano/obras_publicas', $vars);
    }

    public function catastro()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }
        session(['lastpage' => __FILE__]);
        return view('ciudadano/catastro');
    }

    public function ordenamiento_territorio()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        $vars = [
            'leyendaVac' => Ciudadano_model::get_leyenda_vac(4, ''),
            'leyendaVacDIU' => Ciudadano_model::get_leyenda_vac(4, 'DIUW'),
            'hoy'        => date("Y-m-d H:i:s")
        ];

        
        session(['lastpage' => __FILE__]);
        return view('ciudadano/ordenamiento_territorio', $vars);
    }

    public function expediente_unico_municipal()
    {
        if(!session('primera_vista')){
            Redirect::to(url('ciudadano/expediente_unico_municipal'))->send();
        }
        
            return view('ciudadano/expediente_unico_municipal');
  
    }

    public function medio_ambiente()
    {
        if (!session('primera_vista')) {
            Redirect::to(url('ciudadano/expediente'))->send();
        }

        $vars = [
            'leyendaVac' => Ciudadano_model::get_leyenda_vac(4, ''),
            'hoy'        => date("Y-m-d H:i:s")
        ];

        
        session(['lastpage' => __FILE__]);
        return view('ciudadano/medio_ambiente', $vars);
    }

    /**
     * Función para cambiar la foto 
     * de perfil 
     */

    public function perfil(Request $request)
    {

        $path = $request->file->storeAs('public/' . session('id_usuario'), 'perfil.jpg', 's3');

        session(['lastpage' => __FILE__]);

        if (Storage::disk('s3')->setVisibility($path, 'public')) {

            Ciudadano_model::perfil();

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se cambió tu foto de perfil correctamente'
            ]);

            session(['perfil' => 'perfil.jpg']);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de cambiar tu foto de perfil'
            ]);
        }
    }


    /**
     * 
     * Guardar datos de vista expediente
     * 
     */

    public function post(Request $request)
    {

        if (Ciudadano_model::post($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se guardaron correctamente tus datos'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un error al intentar guardar tus datos'
            ]);
        }

        Redirect::to(url('ciudadano/expediente'))->send();
    }

    /**
     * 
     * Correo con notificación 
     * 
     */

    public function notificacion(Request $request)
    {

        if (Ciudadano_model::notificacion($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se envió correctamente la notificacion al usuario'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un error al intentar enviarle la notificación al usuario'
            ]);
        }
    }


    /**
     * Administrador
     * 
     * Obtiene usuarios segun su nombre
     * 
     * @return json
     * 
     */

    public function get_by_name(Request $request)
    {
        if ($response = Ciudadano_model::get_by_name($request->total, $request->name)) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            abort(404);
        }
    }


    public function post_file(Request $request)
    {

        if (Ciudadano_model::post_file($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se guardó el archivo correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de guardar el archivo'
            ]);
        }

        Redirect::to(url('ciudadano/expediente'))->send();
    }

    public function delete_file(Request $request)
    {

        if (Ciudadano_model::delete_file($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se eliminó el archivo correctamente'
            ]);

            http_response_code(200);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de eliminar el archivo'
            ]);

            abort(503);
        }
    }

    /**
     * Calificar la plataforma 
     * 
     */


    public function calificar(Request $request)
    {
        if (Ciudadano_model::calificar($request->all())) {
            http_response_code(200);
        } else {
            abort(503);
        }
    }
}
