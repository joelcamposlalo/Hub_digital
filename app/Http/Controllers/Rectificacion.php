<?php

namespace App\Http\Controllers;

use App\model\Catastro_model as ModelCatastro_model;
use Illuminate\Http\Request;
use App\model\Solicitudes_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Rectificacion_model;
use Illuminate\Support\Carbon;



class Rectificacion extends Controller
{

    public function solicitud()
    {
        //inserta el inicio de tramite en las tablas
        if ($folio = Rectificacion_model::solicitud()) {
            //realiza un array llamado vars que tiene los archvios pendientes por subir del tramite y el numero de folio del tramite
            $vars = [
                'files'    => Rectificacion_model::get_files($folio),
                'folio'    => $folio
            ];
            //crear result para poder revisar el numero de datos para el tramite
            $result = Solicitudes_model::consulta_solicitud(intval($folio));
            //pone la condicional que si el resultado esta en mayor a 0 entonces es un tramite empezado asi que hace la consulta
            if ($result && count($result) > 0) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 1, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 182];
            }

            return view('rectificacion/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function ingresa_solicitud(Request $request)
    {
        if ($response = Rectificacion_model::ingresa_solicitud($request)) {
            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add([
                    'id_captura' => $obj->idcaptura
                ]);

                $rows = Rectificacion_model::actualiza_datos_solicitud($request, 30, $request->id_solicitud, 183, $request->id_captura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 183, 'pendiente', $obj->idcaptura, null);
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

    public function actualiza_solicitud(Request $request)
    {
        if ($response = Rectificacion_model::actualiza_solicitud($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Rectificacion_model::actualiza_datos_solicitud($request, 30, $request->id_solicitud, 183, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 183, 'pendiente', $obj->IdCaptura, null);
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
    {
        if ($response = Rectificacion_model::actualiza_solicitud_2($request)) {

            $obj = $response[0];

            if ($obj->IdCaptura > 0) {
                $rows = Rectificacion_model::actualiza_datos_solicitud($request, 30, $request->id_solicitud, 184, $obj->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 184, 'pendiente', $obj->IdCaptura, null);
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

        $requisitos = Rectificacion_model::consulta_requisitos_op(
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

                $rows += Rectificacion_model::inserta_requisito_op(
                    $id_documento,
                    $filename,
                    $ext,
                    $request->id_solicitud
                );
            }
        }

        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 186,  'terminado', $id_captura, null);

        DB::connection('pgsql')->table('solicitudes_hist')->insert([
            'id_solicitud' => $request->id_solicitud,
            'id_usuario' => $request->id_usuario,
            'id_tramite' => 30,
            'id_etapa' => 186,
            'estatus' => "terminado",
            'id_usuario' => session('id_usuario'),
            'folio_externo' => $request->id_captura,
        ]);

        DB::connection('pgsql')->table('archivos_rec')
            ->where('id_solicitud', $request->id_solicitud)
            ->where('estatus', 'rechazado')
            ->update(['estatus' => '',]);

        $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has realizado </font><font color="#000000">'  . '</font><font color="#000000"> el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Trámite web de rectificación de domicilio y ubicación</strong>.</font><br><br><font color="#000000">Mantente atento a este correo, ya que a través de él te informarán sobre la validación de tu trámite y, posteriormente, te comunicarán las fechas de tu rectificación. <br><br>Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
        $titulo = "Notificación de Registro de Trámite en Línea";
        $correo = session('correo');
        Rectificacion_model::notificarPorCorreo($request, $titulo, $mensaje, $correo);
        Rectificacion_model::sendMail($request, $document_urls);
        Rectificacion_model::insert_Seg($request);

        return view('ciudadano/descanso');
    }

    

}
