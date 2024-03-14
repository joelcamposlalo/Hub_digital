<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Solicitudes_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Evaluacion_riesgos_model;
use App\Mail\contactoVerificacion;
use PDF;

class Evaluacion_riesgos extends Controller
{

    //Aqui ingresas la solicitud a la tabla solicitudes
    public function solicitud()
    {

        if ($folio = Evaluacion_riesgos_model::solicitud()) {

            $vars = [
                'files'    => Evaluacion_riesgos_model::get_files($folio),
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
                $vars += ["id_etapa" => 172];
            }

            return view('evaluacion_riesgos/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }


    public function ingresa_solicitud(Request $request)
    {

        if ($response = Evaluacion_riesgos_model::ingresa_solicitud($request)) {
            $obj = $response;


            if ($obj > 0) {

                $request->request->add([
                    'id_captura' => $obj
                ]);
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 28, $request->id_solicitud, 173, $request->id_captura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 173, 'pendiente', $obj, null);
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


    public function actualiza_solicitud(Request $request)
    {               //SP de el actualizar informacion
        if ($response = Evaluacion_riesgos_model::actualiza_solicitud($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 28, $request->id_solicitud, 173, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    //Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 2, 'pendiente');
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 173, 'pendiente', $obj->IdCaptura, null);
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
        if ($response = Evaluacion_riesgos_model::actualiza_solicitud_2($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 28, $request->id_solicitud, 174, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 174, 'pendiente', $obj->IdCaptura, null);
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

        $requisitos = Evaluacion_riesgos_model::consulta_requisitos_op(
            $request->id_solicitud
        );

        foreach ($requisitos as $r) {
            $nombre_archivo = $r->nombre;

            if ($r->estatus != 'validado') {

                if (Storage::disk('s3')->exists(env('AWS_FOLDER') . '/' . session('id_usuario') . '/' . $nombre_archivo)) {

                    Storage::disk('s3')->exists(env('AWS_FOLDER') . '/' . session('id_usuario') . '/' . $nombre_archivo);

                    DB::table('archivos')
                        ->where('nombre', $nombre_archivo)
                        ->where('id_solicitud', $request->id_solicitud)
                        ->delete();
                }
            }
        }
        $document_urls = [];

        foreach ($_FILES as $key => $file) {

            if ($file["size"] > 0 && $file["name"] != "") {

                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

                $uploadedFile = $request->file($key);

                $id_documento = str_replace("file_", "", $key);

                $filename = $request->id_captura . "_" . $id_documento . "." . $ext;
                $url = 'https://servicios.zapopan.gob.mx:8000/' . env('AWS_BUCKET') . '/' . env('AWS_FOLDER') . '/' . session('id_usuario') . '/' . $filename;
                $document_urls[$filename] = $url;

                $path = $request->file($key)->storeAs(env('AWS_FOLDER') . "/" . session('id_usuario'), $filename, 's3');
                if (Storage::disk('s3')->setVisibility($path, 'public')) {
                    $files_s3++;
                } else {
                    $files_s3--;
                }

                $rows += Evaluacion_riesgos_model::inserta_requisito_op(
                    $id_documento,
                    $filename,
                    $ext,
                    $request->id_solicitud
                );
            }
        }
        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 176,  'terminado', $id_captura, null);

        DB::connection('pgsql')->table('solicitudes_hist')->insert([
            'id_solicitud' => $request->id_solicitud,
            'id_usuario' => $request->id_usuario,
            'id_tramite' => 28,
            'id_etapa' => 176,
            'estatus' => "terminado",
            'id_usuario' => session('id_usuario'),
            'folio_externo' => $request->id_captura,
        ]);



        $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">'  . '</font><font color="#000000"> realizado el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Evaluación de Riesgos de Protección Civil Y Bomberos</strong>.</font><br><br><font color="#000000">Mantente atento a este correo, ya que a través de él te informarán sobre la validación de tu trámite y, posteriormente, te comunicarán las fechas de tu verificación. <br><br>Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
        $titulo = "Notificación de Registro de Trámite en Línea";
        $correo = session('correo');
        Evaluacion_riesgos_model::notificarPorCorreo($request, $titulo, $mensaje, $correo);
        Evaluacion_riesgos_model::sendMail($request, $document_urls);

        return view('/ciudadano/descanso_capacitacion');
    }
}
