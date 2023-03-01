<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Dictamen_img_urbana_model;
use App\model\Solicitudes_model;
use App\model\Predios_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Dictamen_img_urbana extends Controller
{
    //

    public static function solicitud()
    {

        if ($folio = Dictamen_img_urbana_model::solicitud()) {

            $vars = [
                'predios'  => Predios_model::get_all(0),
                'ultimo'   => Predios_model::get_count(),
                'files'    => Dictamen_img_urbana_model::get_files($folio),
                'folio'    => $folio
            ];
            $result = Solicitudes_model::consulta_solicitud(intval($folio));
            if ($result) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 10, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 55];
            }


            $result = Solicitudes_model::consulta_solicitud(intval($folio));
            if ($result) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 10, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 55];
            }


            return view('dictamen_img_urbana/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }


    public function ingresa_solicitud(Request $request)
    {


        if ($response = Dictamen_img_urbana_model::ingresa_solitud_ord($request)) {
            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add([
                    'id_captura' => $obj->idcaptura
                ]);

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 10, $request->id_solicitud, $request->etapa);


                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {
                    if ($request->etapa == 70) {
                        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 70, 'pendiente', $obj->idcaptura, null);
                    } else {
                        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 56, 'pendiente', $obj->idcaptura, null);
                    }



                    http_response_code(200);
                    echo json_encode($obj->idcaptura);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->idcaptura);
            }
        } else {
            http_response_code(503);
        }
    }


    public function ingresa_tramite(Request $request)
    {
        $id_captura   = $request->id_captura;
        $rows         = 0;
        $files_s3     = 0;
        $rows_elimina = 0;

        $requisitos = Dictamen_img_urbana_model::consulta_requisitos_ord($request->id_solicitud);

        foreach ($requisitos as $r) {

            $nombre_archivo = $r->nombre;

            if ($r->estatus != 'validado') {

                if (Storage::disk('s3')->exists('public/' . session('id_usuario') . '/' . $nombre_archivo)) {

                    Storage::disk('s3')->delete('public/' . session('id_usuario') . '/' . $nombre_archivo);

                    DB::table('archivos')
                        ->where('nombre', $nombre_archivo)
                        ->where('id_solicitud', $request->id_solicitud)
                        ->delete();

                    // unlink("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $nombre_archivo);
                }
            }
        }

        //$rows_elimina = Dictamen_trazos_usos_model::elimina_requisito_dtu($request->id_captura);

        foreach ($_FILES as $key => $file) {

            if ($file["size"] > 0 && $file["name"] != "") {

                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

                $uploadedFile = $request->file($key);

                $id_documento = str_replace("file_", "", $key);

                $filename = $request->id_captura . "_" . $id_documento . "." . $ext;

                /*$ruta_completa = "\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename;
                if (file_exists("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename)) {
                    chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename, 0777);
                    chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw", 0777);
                    unlink("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename);
                }

                chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\", 0777);
                */

                $path = $request->file($key)->storeAs('public/' . session('id_usuario'), $filename, 's3');
                if (Storage::disk('s3')->setVisibility($path, 'public')) {
                    $files_s3++;
                } else {
                    $files_s3--;
                }
                $rows += Dictamen_img_urbana_model::inserta_requisito_ord(
                    $id_documento,
                    $filename,
                    $ext,
                    $request->id_solicitud
                );
            }
        }

        $pendientes = Dictamen_img_urbana_model::consulta_archivos_faltantes($request->id_solicitud);



        if ($pendientes || $rows <> $files_s3) {

            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 57, 'pendiente', $id_captura, null);

            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);

            if ($result) {

                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;

                $result2 = Solicitudes_model::consulta_datos_solicitud($request->id_solicitud, $id_tramite, 55);

                $vars = [
                    'predios'  => Predios_model::get_all(0),
                    'ultimo'   => Predios_model::get_count(),
                    'files'    => Dictamen_img_urbana_model::get_files($id_tramite, $folio),
                    'folio'    => $folio,
                    'error'   => 'Debe de completar todos los archivos obligatorios',
                    'id_etapa' => $solicitud->id_etapa
                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('dictamen_img_urbana/solicitud', $vars);
            }
        } else {


            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 63, 'en revision', $id_captura, 11);

            if ($request->id_etapa == 70) {
                $descripcion_estatus = "reingresado";
                $ing = 2;
            } else {
                $descripcion_estatus = "ingresado";
                $ing = 1;
            }

            $mensaje = '<font color="#000000">Usted está recibiendo este mensaje porque ha iniciado el trámite de </font><font color="#000000"><strong>Dictamen Técnico de Imagen Urbana para Inmuebles en Áreas de Protección o Transición Patrimonial</strong>, el cual tiene el siguiente folio de PreCaptura: ' . $request->id_captura . '<br><br></font><font color="#000000">La documentación que adjuntó a la plataforma será revisada y en su caso, se harán las observaciones pertinentes, para que dentro del término que la ley señala, las  subsane. Lo anterior, con fundamento en el Reglamento para la Protección del Patrimonio Edificado y Mejoramiento de la Imagen Urbana del Municipio de Zapopan, Jalisco, el  artículo 37, Sección Segunda, Título Primero, Del Procedimiento Administrativo, Capítulo Primero, de las Disposiciones Generales de la Ley del Procedimiento Administrativo del Estado de Jalisco y sus Municipios.</font><br><br><font color="#000000"><strong>Favor de no responder este correo ya que es informativo para su seguimiento, cualquier duda favor de comunicarse al teléfono 3338182200 extensiones 3064 y 3070.</strong></font>';
            $titulo = "Notificación de Registro de Trámite en Línea";
            $correo = session('correo');
            Dictamen_img_urbana_model::actualiza_edo_act($request->id_captura, $ing);
            Dictamen_img_urbana_model::notifica($request, $titulo, $mensaje, $correo);


            return view('ciudadano/descanso');
        }
    }

    public function actualiza_solitud(Request $request)
    {
        //var_dump($_POST);

        if ($response = Dictamen_img_urbana_model::actualiza_solitud_ord($request)) {

            $obj = $response[0];

            if ($obj->idcaptura > 0) {


                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 10, $request->id_solicitud, 56);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    if ($request->etapa == 70) {
                        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 70, 'pendiente', $obj->idcaptura, null);
                    } else {
                        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 56, 'pendiente', $obj->idcaptura, null);
                    }

                    http_response_code(200);
                    echo json_encode($obj->idcaptura);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->idcaptura);
            }
        } else {
            http_response_code(503);
        }
    }
}
