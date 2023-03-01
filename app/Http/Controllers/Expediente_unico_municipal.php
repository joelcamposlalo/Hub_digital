<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\model\Expediente_unico_municipal_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Predios_model;
use App\model\Solicitudes_model;
use PDF;

class Expediente_unico_municipal extends Controller
{

    public static function solicitud()
    {

        if ($folio = Expediente_unico_municipal_model::solicitud()) {

            $vars = [
                'files'    => Expediente_unico_municipal_model::get_files($folio),
                'folio'    => $folio
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));

            if ($result) {

                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 9, $id_etapa);

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 50];
            }

            return view('expediente_unico_municipal/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }



    public function ingresa_solicitud(Request $request)
    {


        if ($response = Expediente_unico_municipal_model::ingresa_solicitud($request)) {
            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add(['id_captura' => $obj->idcaptura]);

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 9, $request->id_solicitud, $request->etapa);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 51, 'pendiente', $obj->idcaptura, null);
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


        $requisitos = Expediente_unico_municipal_model::consulta_requisitos_dtu($request->id_solicitud);

        foreach ($requisitos as $r) {

            $nombre_archivo = $r->nombre;

            if ($r->estatus != 'validado') {

                if (Storage::disk('s3')->exists('public_pruebas/' . session('id_usuario') . '/' . $nombre_archivo)) {

                    Storage::disk('s3')->delete('public_pruebas/' . session('id_usuario') . '/' . $nombre_archivo);

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

                $path = $request->file($key)->storeAs('public_pruebas/' . session('id_usuario'), $filename, 's3');
                if (Storage::disk('s3')->setVisibility($path, 'public')) {
                    $files_s3++;
                } else {
                    $files_s3--;
                }
                $rows += Expediente_unico_municipal_model::inserta_requisito_ord(
                    $id_documento,
                    $filename,
                    $ext,
                    $request->id_solicitud
                );
            }
        }

        $pendientes = Expediente_unico_municipal_model::consulta_archivos_faltantes($request->id_solicitud);

        if ($pendientes || $rows <> $files_s3) {

            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 52, 'pendiente', $id_captura, null);

            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);

            if ($result) {

                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;



                $result2 = Solicitudes_model::consulta_datos_solicitud($request->id_solicitud, $id_tramite, 50);

                $vars = [
                    'files'    => Expediente_unico_municipal_model::get_files($id_tramite, $folio),
                    'folio'    => $folio,
                    'error'   => 'Debe de completar todos los archivos obligatorios',
                    'id_etapa' => $solicitud->id_etapa
                ];

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('expediente_unico_municipal/solicitud', $vars);
            }
        } else {
            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 53, 'en revision', $id_captura, 9);

            if ($request->id_etapa == 71) {
                $descripcion_estatus = "reingresado";
                $ing = 2;
            } else {
                $descripcion_estatus = "ingresado";
                $ing = 1;
            }

            $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">' . $descripcion_estatus . '</font><font color="#000000"> el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Dictamen de Trazo, Usos y Destinos Específicos Web</strong>.</font><br><br><font color="#000000"> Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
            $titulo = "Notificación de Registro de Trámite en Línea";
            $correo = session('correo');
            //Expediente_unico_municipal_model::actualiza_edo_act($request->id_captura, $ing);
           // Expediente_unico_municipal_model::notifica($request, $titulo, $mensaje, $correo);


            return view('ciudadano/descanso');
        }
    }
    public function actualiza_solicitud(Request $request)
    {
        if ($response = Expediente_unico_municipal_model::actualiza_solicitud_dtu($request)) {

            $obj = $response[0];

            if ($obj->idcaptura > 0) {


                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 9, $request->id_solicitud, 51);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 51, 'pendiente', $obj->idcaptura, null);
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
    public function upload(Request $request)
    {

        if ($response = Expediente_unico_municipal_model::upload($request->all())) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(503);
        }
    }
    public function carta($fecha, $id_captura)
    {
        $data = [
            'fecha'      => $fecha,
            'id_captura' => $id_captura
        ];

        $pdf = PDF::loadView('dictamen_trazos_usos.carta', $data);
        return $pdf->download('carta responsiva.pdf');
    }
}