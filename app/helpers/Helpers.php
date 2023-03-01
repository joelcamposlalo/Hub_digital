<?php

use App\Http\Controllers\trabajos_menores;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use App\model\Dictamen_trazos_usos_model;
use Illuminate\Support\Facades\Mail;
use App\model\Trabajos_menores_model;
use App\model\Solicitudes_model;


function menu_administrador($vista = '')
{

    switch ($vista) {
        case "ciudadanos":
            echo '
            <a href="' . url('administrador/ciudadanos') . '" class="font ml-4 enlace active">Ciudadanos</a>
            <a href="' . url('administrador/predios') . '" class="font enlace">Predios</a>
            <div style="transform: translateY(-3px) !important;" class="dropdown">
            <a href="' . url('administrador/predios') . '" class="font enlace dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . url('administrador/revisores') . '">Revisores</a></li>        
            <li><a class="dropdown-item" href="' . url('administrador/dias_inhabiles') . '">Días inhábiles</a></li>          
            </ul>
            </div>
            <a href="' . url('administrador/reportes') . '" class="font enlace">Reportes</a>
            ';
            break;
        case "predios":
            echo '
            <a href="' . url('administrador/ciudadanos') . '" class="font ml-4 enlace">Ciudadanos</a>
            <a href="' . url('administrador/predios') . '" class="font enlace active">Predios</a>
            <div style="transform: translateY(-3px) !important;" class="dropdown">
            <a href="' . url('administrador/predios') . '" class="font enlace dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . url('administrador/revisores') . '">Revisores</a></li>  
            <li><a class="dropdown-item" href="' . url('administrador/dias_inhabiles') . '">Días inhábiles</a></li>            
            </ul>
            </div>
            <a href="' . url('administrador/reportes') . '" class="font enlace">Reportes</a>
            ';
            break;
        case "catalogos":
            echo '
            <a href="' . url('administrador/ciudadanos') . '" class="font ml-4 enlace">Ciudadanos</a>
            <a href="' . url('administrador/predios') . '" class="font enlace">Predios</a>
            <div style="transform: translateY(-3px) !important;" class="dropdown">
            <a href="' . url('administrador/predios') . '" class="font enlace dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . url('administrador/revisores') . '">Revisores</a></li>   
            <li><a class="dropdown-item" href="' . url('administrador/dias_inhabiles') . '">Días inhábiles</a></li>           
            </ul>
            </div>
            <a href="' . url('administrador/reportes') . '" class="font enlace">Reportes</a>
            ';
            break;
        case "reportes":
            echo '
            <a href="' . url('administrador/ciudadanos') . '" class="font enlace ml-4">Ciudadanos</a>
            <a href="' . url('administrador/predios') . '" class="font enlace">Predios</a>
            <div style="transform: translateY(-3px) !important;" class="dropdown">
            <a href="' . url('administrador/predios') . '" class="font enlace dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . url('administrador/revisores') . '">Revisores</a></li>  
            <li><a class="dropdown-item" href="' . url('administrador/dias_inhabiles') . '">Días inhábiles</a></li>            
            </ul>
            </div>
            <a href="' . url('administrador/reportes') . '" class="font enlace active">Reportes</a>
            ';
            break;
        default:
            echo '
            <a href="' . url('administrador/ciudadanos') . '" class="font enlace ml-4">Ciudadanos</a>
            <a href="' . url('administrador/predios') . '" class="font enlace">Predios</a>
            <div style="transform: translateY(-3px) !important;" class="dropdown">
            <a href="' . url('administrador/predios') . '" class="font enlace dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . url('administrador/revisores') . '">Revisores</a></li>     
            <li><a class="dropdown-item" href="' . url('administrador/dias_inhabiles') . '">Días inhábiles</a></li>         
            </ul>
            </div>
            <a href="' . url('administrador/reportes') . '" class="font enlace">Reportes</a>
            ';
            break;
    }
}

function menu_ciudadano($vista)
{

    switch ($vista) {
        case "expediente":
            echo '       
            <h4 class="mt-3 mb-0 font text-white" style="text-align: center">' . ((session('tipo_persona') == "fisica") ? session('nombre') : session('razon_social')) . '</h4> 
            <span class="badge badge-pill badge-warning mt-2">' . ((session('tipo_persona') == "fisica") ? "Ciudadano" : "Empresa") . '</span>
            <ul class="items mt-5">
            <a id="drive-expediente" href="' . url('ciudadano/expediente') . '">
            <li class="font active">
            <i class="fas fa-folder"></i>
            <small class="font-500 f-16 ml-2">Mi expediente</small>
            </li>
            </a>
            <a href="' . url('ciudadano/tramites') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-grip-horizontal"></i>
            <small class="font-500 f-16 ml-2">Mis trámites</small>
            </li>
            </a>
            <a href="' . url('ciudadano/nuevo_tramite') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-plus"></i>
            <small class="font-500 f-16 ml-2">Nuevo trámite</small>
            </li>
            </a>
            <a href="' . url('ciudadano/predios') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-home"></i>
            <small class="font-500 f-16 ml-2">Mis predios</small>
            </li>
            </a>
            </ul>
            ';
            break;
        case "tramites":
            echo '            
            <h4 class="mt-3 mb-0 font text-white" style="text-align: center">' . ((session('tipo_persona') == "fisica") ? session('nombre') : session('razon_social')) . '</h4>
            <span class="badge badge-pill badge-warning mt-2">' . ((session('tipo_persona') == "fisica") ? "Ciudadano" : "Empresa") . '</span>
            <ul class="items mt-5">
            <a href="' . url('ciudadano/expediente') . '">
            <li class="font">
            <i class="fas fa-folder"></i>
            <small class="font-500 f-16 ml-2">Mi expediente</small>
            </li>
            </a>
            <a href="' . url('ciudadano/tramites') . '" >
            <li class="font active">
            <i class="fas fa-grip-horizontal"></i>
            <small class="font-500 f-16 ml-2">Mis trámites</small>
            </li>
            </a>
            <a href="' . url('ciudadano/nuevo_tramite') . '">
            <li class="font">
            <i class="fas fa-plus"></i>
            <small class="font-500 f-16 ml-2">Nuevo trámite</small>
            </li>
            </a>
            <a href="' . url('ciudadano/predios') . '">
            <li class="font">
            <i class="fas fa-home"></i>
            <small class="font-500 f-16 ml-2">Mis predios</small>
            </li>
            </a>
            </ul>
            ';
            break;
        case "nuevo_tramite":
            echo '            
            <h4 class="mt-3 mb-0 font text-white" style="text-align: center">' . ((session('tipo_persona') == "fisica") ? session('nombre') : session('razon_social')) . '</h4>
            <span class="badge badge-pill badge-warning mt-2">' . ((session('tipo_persona') == "fisica") ? "Ciudadano" : "Empresa") . '</span>
            <ul class="items mt-5">
            <a href="' . url('ciudadano/expediente') . '">
            <li class="font">
            <i class="fas fa-folder"></i>
            <small class="font-500 f-16 ml-2">Mi expediente</small>
            </li>
            </a>
            <a href="' . url('ciudadano/tramites') . '">
            <li class="font ">
            <i class="fas fa-grip-horizontal"></i>
            <small class="font-500 f-16 ml-2">Mis trámites</small>
            </li>
            </a>
            <a href="' . url('ciudadano/nuevo_tramite') . '">
            <li class="font active">
            <i class="fas fa-plus"></i>
            <small class="font-500 f-16 ml-2">Nuevo trámite</small>
            </li>
            </a>
            <a href="' . url('ciudadano/predios') . '">
            <li class="font">
            <i class="fas fa-home"></i>
            <small class="font-500 f-16 ml-2">Mis predios</small>
            </li>
            </a>
            </ul>
            ';
            break;
        case "predios":
            echo '            
            <h4 class="mt-3 mb-0 font text-white" style="text-align: center">' . ((session('tipo_persona') == "fisica") ? session('nombre') : session('razon_social')) . '</h4>
            <span class="badge badge-pill badge-warning mt-2">' . ((session('tipo_persona') == "fisica") ? "Ciudadano" : "Empresa") . '</span>
            <ul class="items mt-5">
            <a href="' . url('ciudadano/expediente') . '">
            <li class="font">
            <i class="fas fa-folder"></i>
            <small class="font-500 f-16 ml-2">Mi expediente</small>
            </li>
            </a>
            <a href="' . url('ciudadano/tramites') . '">
            <li class="font">
            <i class="fas fa-grip-horizontal"></i>
            <small class="font-500 f-16 ml-2">Mis trámites</small>
            </li>
            </a>
            <a href="' . url('ciudadano/nuevo_tramite') . '">
            <li class="font">
            <i class="fas fa-plus"></i>
            <small class="font-500 f-16 ml-2">Nuevo trámite</small>
            </li>
            </a>
            <a href="' . url('ciudadano/predios') . '">
            <li class="font active">
            <i class="fas fa-home"></i>
            <small class="font-500 f-16 ml-2">Mis predios</small>
            </li>
            </a>
            </ul>
            ';
            break;
        default:
            echo '
            <h4 class="mt-3 mb-0 font text-white" style="text-align: center">' . ((session('tipo_persona') == "fisica") ? session('nombre') : session('razon_social')) . '</h4>
            <span class="badge badge-pill badge-warning mt-2">' . ((session('tipo_persona') == "fisica") ? "Ciudadano" : "Empresa") . '</span>
            <ul class="items mt-5">
            <a href="' . url('ciudadano/expediente') . '">
            <li class="font">
            <i class="fas fa-folder"></i>
            <small class="font-500 f-16 ml-2">Mi expediente</small>
            </li>
            </a>
            <a href="' . url('ciudadano/tramites') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-grip-horizontal"></i>
            <small class="font-500 f-16 ml-2">Mis trámites</small>
            </li>
            </a>
            <a href="' . url('ciudadano/nuevo_tramite') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-plus"></i>
            <small class="font-500 f-16 ml-2">Nuevo trámite</small>
            </li>
            </a>
            <a href="' . url('ciudadano/predios') . '" class="' . ((session('primera_vista') == 0) ? "ocultar" : "") . '">
            <li class="font">
            <i class="fas fa-home"></i>
            <small class="font-500 f-16 ml-2">Mis predios</small>
            </li>
            </a>
            </ul>
            ';
            break;
    }
}

function menu_mobil_ciudadano()
{
    echo '
            <div class="menu-mobile background-color">
            <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="font bold">Menú</h3>
            <div class="row">
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url('ciudadano/expediente') . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas fa-folder c-primary-color"></i>
            </span>            
            <p class="font text-center">Mi expediente</p>
            </div>
            </div>
            </a>
            </div>
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url('ciudadano/tramites') . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas fa-grip-horizontal c-primary-color"></i>
            </span>            
            <p class="font text-center">Mis trámites</p>
            </div>
            </div>
            </a>
            </div>        
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url('ciudadano/nuevo_tramite') . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas fa-plus c-primary-color"></i>
            </span>            
            <p class="font text-center">Nuevo trámite</p>
            </div>
            </div>
            </a>
            </div>
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url('ciudadano/predios') . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas  fa-home c-primary-color"></i>
            </span>            
            <p class="font text-center">Mis predios</p>
            </div>
            </div>
            </a>
            </div>
            </div>          
            </div>
            ';
}

function menu_revisor($vista)
{

    switch ($vista) {
        case "solicitudes":
            echo '       
            <h4 class="mt-3 mb-0 font text-white">' . session('nombre') . '</h4>
            <span class="badge badge-pill badge-warning mt-2">Revisor</span>
            <ul class="items mt-5">
                <a href="' . url("revisor/solicitudes") . '">
                    <li class="font active">
                        <i class="fas fa-grip-horizontal"></i>
                        <small class="font-500 f-16 ml-2">Solicitudes</small>
                    </li>
                </a>
                <a href="' . url("revisor/reportes") . '">
                    <li class="font">
                        <i class="fas fa-chart-pie"></i>
                        <small class="font-500 f-16 ml-2">Reportes</small>
                    </li>
                </a>
            </ul>
            ';
            break;
        case "reportes":
            echo '            
            <h4 class="mt-3 mb-0 font text-white">' . session('nombre') . '</h4>
            <span class="badge badge-pill badge-warning mt-2">Revisor</span>
            <ul class="items mt-5">
                <a href="' . url("revisor/solicitudes") . '">
                    <li class="font">
                        <i class="fas fa-grip-horizontal"></i>
                        <small class="font-500 f-16 ml-2">Solicitudes</small>
                    </li>
                </a>
                <a href="' . url("revisor/reportes") . '">
                    <li class="font active">
                    <i class="fas fa-chart-pie"></i>
                        <small class="font-500 f-16 ml-2">Reportes</small>
                    </li>
                </a>
            </ul>
            ';
            break;
        case "notificaciones":
            echo '            
            <h4 class="mt-3 mb-0 font text-white">' . session('nombre') . '</h4>
            <span class="badge badge-pill badge-warning mt-2">Revisor</span>
            <ul class="items mt-5">
                <a href="' . url("revisor/solicitudes") . '">
                    <li class="font">
                    <i class="fas fa-grip-horizontal"></i>
                        <small class="font-500 f-16 ml-2">Solicitudes</small>
                    </li>
                </a>
                <a href="' . url("revisor/reportes") . '">
                    <li class="font">
                    <i class="fas fa-chart-pie"></i>
                        <small class="font-500 f-16 ml-2">Reportes</small>
                    </li>
                </a>
            </ul>
            ';
            break;
        case "detalles":
            echo '            
            <h4 class="mt-3 mb-0 font text-white">' . session('nombre') . '</h4>
            <span class="badge badge-pill badge-warning mt-2">Revisor</span>
            <ul class="items mt-5">
                <a href="' . url("revisor/solicitudes") . '">
                    <li class="font">
                    <i class="fas fa-grip-horizontal"></i>
                        <small class="font-500 f-16 ml-2">Solicitudes</small>
                    </li>
                </a>
                <a href="' . url("revisor/reportes") . '">
                    <li class="font">
                    <i class="fas fa-chart-pie"></i>
                        <small class="font-500 f-16 ml-2">Reportes</small>
                    </li>
                </a>
            </ul>
            ';
            break;
        default:
            echo '
            <h4 class="mt-3 mb-0 font text-white">' . session('nombre') . '</h4>
            <span class="badge badge-pill badge-warning mt-2">Revisor</span>
            <ul class="items mt-5">
                <a href="' . url("revisor/solicitudes") . '">
                    <li class="font">
                    <i class="fas fa-grip-horizontal"></i>
                        <small class="font-500 f-16 ml-2">Solicitudes</small>
                    </li>
                </a>
                <a href="' . url("revisor/reportes") . '">
                    <li class="font">
                    <i class="fas fa-chart-pie"></i>
                        <small class="font-500 f-16 ml-2">Reportes</small>
                    </li>
                </a>
            </ul>
            ';
            break;
    }
}

function menu_mobil_revisor()
{
    echo '
            <div class="menu-mobile background-color">
            <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="font bold">Menú</h3>
            <div class="row">
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url("revisor/solicitudes") . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas fa-grip-horizontal c-primary-color"></i>
            </span>            
            <p class="font text-center">Solicitudes</p>
            </div>
            </div>
            </a>
            </div>
            <div class="col-6 mt-4">
            <a class="c-negro" style="text-decoration: none" href="' . url("revisor/reportes") . '">
            <div class="card shadow-sm">
            <div class="card-body">            
            <span style="font-size: 30px">
            <i class="fas fa-chart-pie c-primary-color"></i>
            </span>            
            <p class="font text-center">Reportes</p>
            </div>
            </div>
            </a>
            </div>        
            </div>          
            </div>
            ';
}

function get_notificaciones()
{
    echo DB::table('notificaciones as n')
        ->join('usuarios as u', 'u.id_usuario', '=', 'n.id_emisor')
        ->where('id_receptor', session('id_usuario'))
        ->where('visto', '=', false)
        ->where('eliminado', '=', false)
        ->count();
}

/**
 * Funcion para cancelar trámites despues de 
 * 3 dias habiles para trabajos menores
 */


function cancelacion_tres_dias()
{
    $fechas      = [];

    //Trámites de obras públicas
    $solicitudes = DB::table('solicitudes as s')
        ->select('s.id_solicitud', 's.id_tramite', 's.id_etapa', 's.estatus', 'ds.campo', 's.update_at', 'u.correo', 'ds.dato as id_captura', 's.id_usuario', 's.id_revisor')
        ->join('datos_solicitudes as ds', 's.id_solicitud', '=', 'ds.id_solicitud')
        ->join('usuarios as u', 'u.id_usuario', '=', 's.id_usuario')
        ->where([
            ['s.id_tramite', '=', 1],
            ['s.id_etapa', '=', 6],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 2],
            ['s.id_etapa', '=', 24],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 5],
            ['s.id_etapa', '=', 31],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 13],
            ['s.id_etapa', '=', 78],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 14],
            ['s.id_etapa', '=', 84],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 11],
            ['s.id_etapa', '=', 71],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->orWhere([
            ['s.id_tramite', '=', 12],
            ['s.id_etapa', '=', 72],
            ['s.estatus', '=', 'pendiente'],
            ['ds.campo', '=', 'id_captura']
        ])
        ->get();


    if (count($solicitudes) >= 1) {
        foreach ($solicitudes as $value) {
            $dias_festivos = DB::table('dias_festivos_dependencia')
                ->select('fecha')
                ->where('id_tramite', $value->id_tramite)
                ->get();

            foreach ($dias_festivos as $item) {
                array_push($fechas, $item->fecha);
            }
            $total = count(getDiasHabiles(date('Y-m-d', strtotime($value->update_at)), date('Y-m-d'), $fechas));

            if ($total > 3) {

                switch ($value->id_tramite) {
                    case 1:
                        /**
                         * Trabajos menores
                         * Se cancela la solicitud en vdigital
                         */

                        Trabajos_menores_model::cancela_solicitud_op($value->id_captura);

                        DB::table('solicitudes')
                            ->where('id_solicitud', $value->id_solicitud)
                            ->update([
                                'id_etapa' => 5,
                                'estatus'  => 'cancelado'
                            ]);
                        break;
                    case 2:

                        /**
                         * Licencia de construccion
                         * Se cancela la solicitud en vdigital
                         */
                        return;
                        break;
                    case 5:
                        /**
                         * Certificado de alineamiento y no. oficial
                         * Se cancela la solicitud en vdigital
                         */
                        return;
                        break;
                        case 11:

                            Dictamen_trazos_usos_model::cancela_solicitud_dtu($value->id_captura);

                            DB::table('solicitudes')
                                ->where('id_solicitud', $value->id_solicitud)
                                ->update([
                                    'id_etapa' => 64,
                                    'estatus'  => 'cancelado'
                                ]);

                            break;

                    default:
                        return;
                        break;
                }

                //Consulta trámite
                $result = DB::table('cat_tramites')
                    ->select('tramite')
                    ->where('id_tramite', $value->id_tramite)
                    ->first();

                //Variables
                $titulo      = 'Trámite cancelado por falta de respuesta';
                $descripcion = '<font color="#000000">Estimado contribuyente: <br><br> Tu solicitud de ' . $result->tramite . ' <strong>folio: ' . $value->id_solicitud . '</strong>, ha sido cancelada por no dar seguimiento antes de 3 días hábiles a las observaciones </font>';

                $data = [
                    'id_emisor'       => $value->id_revisor,
                    'id_receptor'     => $value->id_usuario,
                    'id_coordinacion' => 1,
                    'titulo'          => $titulo,
                    'descripcion'     => $descripcion,
                ];

                if (DB::table('notificaciones')->insert($data)) {
                    //Envio del correo 
                    Mail::to($value->correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($value->correo, $titulo, $descripcion, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_op.png'));
                }
            }
        }
    }
}


function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array())
{
    // Convirtiendo en timestamp las fechas
    $fechainicio = strtotime($fechainicio);
    $fechafin    = strtotime($fechafin);

    // Incremento en 1 dia
    $diainc = 24 * 60 * 60;

    // Arreglo de dias habiles
    $diashabiles = [];

    // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
    for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {

        if (!in_array(date('N', $midia), array(6, 7))) {
            if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                array_push($diashabiles, date('Y-m-d', $midia));
            }
        }
    }

    return $diashabiles;
}
