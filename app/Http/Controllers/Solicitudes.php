<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Trabajos_menores_model;
use App\model\RevisionProyecto_model;
use App\model\Acreditaciones_model;
use App\model\Prelicencias_model;
use App\model\Licencias_model;
use App\model\Licencia_construccion_model;
use App\model\Solicitudes_model;
use App\model\Alineamiento_num_oficial_model;
use App\model\Dictamen_img_urbana_model;
use App\model\Dictamen_trazos_usos_model;
use App\model\Dictamen_finca_antigua_model;
use App\model\Dictamen_rea_Model;
use App\model\Notificaciones_model;
use Illuminate\Support\Facades\Redirect;
use App\model\Predios_model;
use App\model\Verificacion_Riesgos_Model;
use App\model\Rectificacion_model;
use App\model\Evaluacion_riesgos_model;
use App\model\Capacitaciones_Model;

class Solicitudes extends Controller
{
    public function consulta_solicitudes($id_solicitud)
    {

        $result = Solicitudes_model::consulta_solicitud(intval($id_solicitud));

        if ($result) {

            $solicitud  = $result[0];
            $folio      = $solicitud->id_solicitud;
            $id_tramite = $solicitud->id_tramite;
            $id_etapa   = $solicitud->id_etapa;
            $estatus    = $solicitud->estatus;

            if ($id_tramite == 1) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'predios'      => Predios_model::get_all(0),
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Trabajos_menores_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];


                if ($solicitud->id_etapa == 6) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('trabajos_menores/solicitud', $vars);
            } else if ($id_tramite == 11) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'files'        => Dictamen_trazos_usos_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];


                if ($solicitud->id_etapa == 71) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('dictamen_trazos_usos/solicitud', $vars);
            } else if ($id_tramite == 9) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'files'        => Dictamen_trazos_usos_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];


                if ($solicitud->id_etapa == 91) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('expediente_unico_municipal/solicitud', $vars);
            } else if ($id_tramite == 2) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'predios'      => Predios_model::get_all(0),
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Licencia_construccion_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];

                if ($solicitud->id_etapa == 24) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('licencia_construccion/solicitud', $vars);
            } else if ($id_tramite == 3) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($id_solicitud, $id_tramite, 3);

                $vars = [
                    'folio'    => $folio,
                    'id_etapa' => $solicitud->id_etapa,
                    'files'    => Acreditaciones_model::get_files($folio),
                    'estatus'  => $estatus
                ];

                /**
                 * Si la etapa es regresado al ciudadano, enviamos
                 * la observación
                 */

                if ($solicitud->id_etapa == 12) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('acreditaciones/solicitud', $vars);
            } else if ($id_tramite == 4) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, 4);
                $giros      = Prelicencias_model::get_giros();
                $calles     = Prelicencias_model::get_calles();
                $colonias   = Prelicencias_model::get_colonias();

                $vars = [
                    'folio'      => $folio,
                    'id_etapa'   => $id_etapa,
                    'estatus'    => $estatus,
                    'giros'     => $giros,
                    'files'        => Prelicencias_model::get_files($folio),
                    'calles'    => $calles,
                    'colonias'  => $colonias,
                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }



                return view('prelicencias/solicitud', $vars);
            } else if ($id_tramite == 5) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, 27);

                $vars = [
                    'predios'  => Predios_model::get_all(0),
                    'ultimo'   => Predios_model::get_count(),
                    'files'    => Alineamiento_num_oficial_model::get_files($folio),
                    'folio'    => $folio,
                    'id_etapa' => $id_etapa,
                    'estatus'  => $estatus,
                ];

                /**
                 * Si la etapa es regresado al ciudadano, enviamos
                 * la observación
                 */

                if ($solicitud->id_etapa == 31) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }


                return view('alineamiento_num_oficial/solicitud', $vars);
            } else  if ($id_tramite == 6) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 6, $id_etapa);
                //var_dump($result2);
                $vars = [
                    'predios'  => Predios_model::get_all(0),
                    'ultimo'   => Predios_model::get_count(),
                    'files'      => RevisionProyecto_model::get_files($folio),
                    'folio'      => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'estatus'    => $estatus

                ];


                if ($solicitud->id_etapa == 36) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];

                return view('revision_proyecto/solicitud', $vars);
            } else if ($id_tramite == 7) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, 7);

                $vars = [
                    'predios'  => Predios_model::get_all(0),
                    'ultimo'   => Predios_model::get_count(),
                    'calles'    => Prelicencias_model::get_calles(),
                    'colonias'  => Prelicencias_model::get_colonias(),
                    'giros'     => Licencias_model::get_giros(),
                    'plazas'    => Licencias_model::get_plazas(),
                    'anuncios'  => Licencias_model::get_anuncios(),
                    'folio'     => $folio,
                    'id_etapa'  => $solicitud->id_etapa,

                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                if ($solicitud->id_etapa == 40) {
                    return view('licencias/solicitud_uso_suelo', $vars);
                } else if ($solicitud->id_etapa == 42) {
                    return view('licencias/solicitud_requisitos', $vars);
                }
            } else if ($id_tramite == 8) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'folio'     => $folio,
                    'id_etapa'  => $solicitud->id_etapa,
                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                return view('horas_extras/solicitud', $vars);
            } else if ($id_tramite == 10) { //Dictamen de imagen urbana

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 10, $id_etapa);

                $vars = [
                    'predios'       => Predios_model::get_all(0),
                    'ultimo'        => Predios_model::get_count(),
                    'files'         => Dictamen_img_urbana_model::get_files($folio),
                    'folio'         => $folio,
                    'notificacion'  => Notificaciones_model::get_observacion($folio),
                    'estatus'       => $estatus
                ];


                if ($solicitud->id_etapa == 58) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];

                return view('dictamen_img_urbana/solicitud', $vars);
            } else  if ($id_tramite == 13) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'predios'      => Predios_model::get_all(0),
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Trabajos_menores_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];


                if ($solicitud->id_etapa == 78) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('certificado_habitabilidad/solicitud', $vars);
            } else  if ($id_tramite == 14) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $id_etapa);

                $vars = [
                    'predios'      => Predios_model::get_all(0),
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Trabajos_menores_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];


                if ($solicitud->id_etapa == 84) { //regresado al ciudadano
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('constancia_habitabilidad/solicitud', $vars);
            } else if ($id_tramite == 12) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Dictamen_finca_antigua_model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];

                if ($solicitud->id_etapa == 68) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }


                return view('dictamen_finca_antigua/solicitud', $vars);
            } else  if ($id_tramite == 15) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 15, $id_etapa);
                //var_dump($result2);
                $vars = [
                    'predios'  => Predios_model::get_all(0),
                    'ultimo'   => Predios_model::get_count(),
                    'files'      => RevisionProyecto_model::get_files($folio),
                    'folio'      => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'estatus'    => $estatus

                ];


                if ($solicitud->id_etapa == 96) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];

                return view('revision_proyectoot/solicitud', $vars);
            }

            //MEDIO AMBIENTE

            ///REA
            else if ($id_tramite == 17) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'ultimo'       => Predios_model::get_count(),
                    'files'        => Dictamen_rea_Model::get_files($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];

                if ($solicitud->id_etapa == 109) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }


                return view('dictamen_rea/solicitud', $vars);
            }

            ///Proteccion Civil
            //Bomberos
            else if ($id_tramite == 27) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'ultimo'       => Predios_model::get_count(),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];

                if ($solicitud->id_etapa == 171) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                return view('bombero_capacitacion/solicitud', $vars);
            } else if ($id_tramite == 28) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'ultimo'       => Evaluacion_riesgos_model::get_count(),
                    'folio'        => $folio,
                    'files'        => Evaluacion_riesgos_model::get_files($folio),
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus

                ];

                if ($solicitud->id_etapa >= 172) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                //dd($result2);exit;
                return view('evaluacion_riesgos/solicitud', $vars);
            } else if ($id_tramite == 29) {



                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'ultimo'       => Verificacion_Riesgos_Model::get_count(),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];

                if ($solicitud->id_etapa >= 174) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                return view('Verificacion_tecnica_riesgos/solicitud', $vars);
            } else if ($id_tramite == 30) {

                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, $id_tramite, $solicitud->id_etapa);

                $vars = [
                    'files'        => Rectificacion_model::get_files_rechazado($folio),
                    'folio'        => $folio,
                    'notificacion' => Notificaciones_model::get_observacion($folio),
                    'id_etapa'     => $id_etapa,
                    'estatus'      => $estatus
                ];



                if ($solicitud->id_etapa >= 183) {
                    $vars += ['notificacion' => Notificaciones_model::get_observacion($id_solicitud)];
                }

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                
                return view('rectificacion/solicitud', $vars);
            }
        }
    }


    /**
     * Obtener todas las solicitudes del
     * ciudadano
     *
     * @return json
     */

    public function get_all(Request $request)
    {
        if ($response = Solicitudes_model::get_all(session('tipo'), $request->search, $request->filtro, $request->filtro_2)) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            abort(503);
        }
    }

    /**
     *
     * Eliminar solicitud
     *
     * @method post
     *
     */


    public function deleted(Request $request)
    {

        $id_solicitud = $request->id_solicitud;

        if (Solicitudes_model::deleted($id_solicitud)) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se eliminó correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurró un problema al tratar de eliminar la solicitud'
            ]);

            abort(503);
        }
    }


    /**
     *
     * Detalles de solicitud
     *
     * @method post
     *
     */


    public function detalles(Request $request)
    {

        $id_solicitud = $request->id_solicitud;

        if ($detalles = Solicitudes_model::detalles($id_solicitud)) {

            http_response_code(200);
            echo json_encode($detalles);
        } else {

            abort(503);
        }
    }

    /**
     *
     * Rechazar la solicitud
     *
     */

    public function rechazar(Request $request)
    {

        if (Solicitudes_model::rechazar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se rechazó correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de rechazar la solicitud'
            ]);
        }

        Redirect::to(url('revisor/solicitudes'))->send();
    }

    /**
     *
     * Regresar la solicitud
     *
     */

    public function regresar(Request $request)
    {
        if (Solicitudes_model::regresar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se regresó correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de regresar la solicitud'
            ]);
        }

        Redirect::to(url('revisor/solicitudes'))->send();
    }

    /**
     *
     * Continuar con el siguiente paso
     *
     */

    public function continuar(Request $request)
    {
        if (Solicitudes_model::continuar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se continuó correctamente'
            ]);

            return true;
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de continuar la solicitud'
            ]);

            abort(503);
            return false;
        }
    }
}
