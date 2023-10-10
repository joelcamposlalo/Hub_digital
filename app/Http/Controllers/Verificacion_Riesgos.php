<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\Solicitudes_model;
use App\model\Predios_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Verificacion_Riesgos_Model;
use App\model\Dictamen_trazos_usos_model;
use PDF;

class Verificacion_Riesgos extends Controller
{

//Aqui ingresas la solicitud a la tabla solicitudes
    public function solicitud()
    {

        if ($folio = Verificacion_Riesgos_Model::solicitud()) {

            $vars = [
                'files'    => Verificacion_Riesgos_Model::get_files($folio),
                'folio'    => $folio
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));

            if ($result) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 1, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 178];
            }

            return view('verificacion_tecnica_riesgos/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }



    //Aqui esta la funcion general para ingreso de solicitud y el primer procedimiento

    public function ingresa_solicitud(Request $request)
    {
                    //Primer procedimiento almacenado
        if ($response = Verificacion_Riesgos_Model::ingresa_solicitud($request)) {
            $obj = $response;


            if ($obj > 0) {

                $request->request->add([
                    'id_captura' => $obj
                ]);
                    //Temas de la table solicitud cambia el estado y datos
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 1, $request->id_solicitud, $request->etapa, $request->id_captura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {
                        //Cambia el status de la etapa
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 178, 'pendiente', $obj, null);
                    http_response_code(200);
                    echo json_encode($obj);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj);
            }
        } else {
            http_response_code(503);
        }
    }
                    //El procdimiento almacenado de actualizar el primer card
    public function actualiza_solicitud(Request $request)
    {               //SP de el actualizar informacion
        if ($response = Verificacion_Riesgos_Model::actualiza_solicitud($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 1, $request->id_solicitud, 178, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    //Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 2, 'pendiente');
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 178, 'pendiente', $obj->IdCaptura, null);
                    http_response_code(200);
                    echo json_encode($obj->IdCaptura);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->IdCaptura);
            }
        } else {
            http_response_code(503);
        }
    }

    public function actualiza_solicitud_2(Request $request)
    {               //SP de el actualizar informacion
        if ($response = Verificacion_Riesgos_Model::actualiza_solicitud_2($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 1, $request->id_solicitud, 179, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 179, 'pendiente', $obj->IdCaptura, null);
                    http_response_code(200);
                    echo json_encode($obj->IdCaptura);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->IdCaptura);
            }
        } else {
            http_response_code(503);
        }
    }


    public function ingresa_tramite(Request $request)
    {
        $id_captura = $request->id_captura;
        $rows = 0;
        $files_s3 = 0;
        $rows_elimina = 0;

        $requisitos = Verificacion_Riesgos_Model::consulta_requisitos_op(
            $request->id_solicitud
        );

        foreach ($requisitos as $r) {
            $nombre_archivo = $r->nombre;

            if ($r->estatus != 'validado') {

                if (Storage::disk('s3')->exists('public/' . session('id_usuario') . '/' . $nombre_archivo)) {

                    Storage::disk('s3')->delete('public/' . session('id_usuario') . '/' . $nombre_archivo);

                    DB::table('archivos')
                        ->where('nombre', $nombre_archivo)
                        ->where('id_solicitud', $request->id_solicitud)
                        ->delete();
                }
            }
        }

        foreach ($_FILES as $key => $file) {

            if ($file["size"] > 0 && $file["name"] != "") {

                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

                $uploadedFile = $request->file($key);

                $id_documento = str_replace("file_", "", $key);
                $filename = $request->id_captura . "_" . $id_documento . "." . $ext;


                $path = $request->file($key)->storeAs('public/' . session('id_usuario'), $filename, 's3');
                if (Storage::disk('s3')->setVisibility($path, 'public')) {
                    $files_s3++;
                } else {
                    $files_s3--;
                }
                $rows += Verificacion_Riesgos_Model::inserta_requisito_op(
                    $id_documento,
                    $filename,
                    $ext,
                    $request->id_solicitud
                );
            }
        }

        $pendientes = Verificacion_Riesgos_Model::consulta_archivos_faltantes($request->id_solicitud);

        if ($pendientes || $rows <> $files_s3) {

            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 67, 'pendiente', $id_captura, null);

            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);

            if ($result) {

                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;

                $result2 = Solicitudes_model::consulta_datos_solicitud($request->id_solicitud, $id_tramite, 65);

                $vars = [
                    'files'    => Dictamen_finca_antigua_model::get_files($id_tramite, $folio),
                    'folio'    => $folio,
                    'error'   => 'Debe de completar todos los archivos obligatorios',
                    'id_etapa' => $solicitud->id_etapa
                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('dictamen_finca_antigua/solicitud', $vars);
            }
        } else {

            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 68, 'en revision', $id_captura, 1);

            if ($request->id_etapa == 72) {
                $descripcion_estatus = "reingresado";
                $ing = 2;
            } else {
                $descripcion_estatus = "ingresado";
                $ing = 1;
            }

            $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">' . $descripcion_estatus . '</font><font color="#000000"> el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Dictamen de Finca Antigua Web</strong>.</font><br><br><font color="#000000"> Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
            $titulo = "Notificación de Registro de Trámite en Línea";
            $correo = session('correo');
            Dictamen_finca_antigua_model::actualiza_edo_act($request->id_captura, $ing);
            Dictamen_finca_antigua_model::notifica($request, $titulo, $mensaje, $correo);

            return view('ciudadano/descanso');
        }
    }
}
