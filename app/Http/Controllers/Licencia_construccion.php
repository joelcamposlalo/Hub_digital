<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Licencia_construccion_model;
use App\model\Solicitudes_model;
use App\model\Predios_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class Licencia_construccion extends Controller
{

    /**
     * 
     * Abre la vista del primer paso de licencia 
     * de construccion
     * 
     */
    public function solicitud()
    {

        if ($folio = Licencia_construccion_model::solicitud()) {

            $vars = [
                'predios'  => Predios_model::get_all(0),
                'ultimo'   => Predios_model::get_count(),
                'files'    => Licencia_construccion_model::get_files($folio),
                'folio'    => $folio
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));

            if ($result) {

                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 2, $id_etapa);

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 19];
            }

            return view('licencia_construccion/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }


    public function ingresa_solitud(Request $request)
    {


        if ($response = Licencia_construccion_model::ingresa_solitud_op($request)) {
            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add(['id_captura' => $obj->idcaptura]);

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 2, $request->id_solicitud, $request->etapa);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 20, 'pendiente', $obj->idcaptura, null);
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

        $requisitos = Licencia_construccion_model::consulta_requisitos_op($request->id_captura);

        foreach ($requisitos as $r) {

            $nombre_archivo = substr($r->ruta, (strrpos($r->ruta, "\\") + 1));

            if ($r->validado == 0 && $r->idRegistro > 0) {

                if (Storage::disk('s3')->exists('public/' . session('id_usuario') . '/' . $nombre_archivo)) {

                    Storage::disk('s3')->delete('public/' . session('id_usuario') . '/' . $nombre_archivo);

                    DB::table('archivos')
                        ->where('nombre', $nombre_archivo)
                        ->where('id_solicitud', $request->id_solicitud)
                        ->delete();

                    unlink("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $nombre_archivo);
                }
            }
        }

        $rows_elimina = Licencia_construccion_model::elimina_requisito_op($request->id_captura);


        foreach ($_FILES as $key => $file) {

            if ($file["size"] > 0 && $file["name"] != "") {

                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

                $uploadedFile = $request->file($key);

                $id_documento = str_replace("file_", "", $key);
                $filename = $request->id_captura . "_" . $id_documento . "." . $ext;

                $ruta_completa = "\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename;
                if (file_exists("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename)) {
                    chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename, 0777);
                    chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw", 0777);
                    unlink("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename);
                }

                chmod("\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\", 0777);


                $path = $request->file($key)->storeAs('public/' . session('id_usuario'), $filename, 's3');
                if (Storage::disk('s3')->setVisibility($path, 'public')) {
                    $files_s3++;
                } else {
                    $files_s3--;
                }

                if (move_uploaded_file($_FILES[$key]["tmp_name"], "\\\\172.16.4.125\\RespaldosBD\\ZAPOPC\\licenciaobp\\tw\\" . $filename)) {
                    $rows += Licencia_construccion_model::inserta_requisito_op(
                        $request->id_captura,
                        $id_documento,
                        $ruta_completa,
                        $filename,
                        $ext,
                        $request->id_solicitud
                    );
                } else {
                    $rows--;
                }
            }
        }

        $pendientes = Licencia_construccion_model::consulta_archivos_faltantes($request->id_solicitud);



        if ($pendientes || $rows <> $files_s3) {

            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 21, 'pendiente', $id_captura, null);
            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);
            if ($result) {

                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;

                if ($id_tramite == 2) {

                    $result2 = Solicitudes_model::consulta_datos_solicitud($request->id_solicitud, $id_tramite, null);

                    $vars = [
                        'predios'  => Predios_model::get_all(),
                        'files'    => Licencia_construccion_model::get_files($id_tramite, $folio),
                        'folio'    => $folio,
                        'error'    => 'Debe de completar todos los archivos obligatorios',
                        'id_etapa' => $solicitud->id_etapa
                    ];

                    foreach ($result2 as $obj) {
                        $vars += [$obj->campo => $obj->dato];
                    }

                    return view('licencia_construccion/solicitud', $vars);
                }
            }
        } else {


            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 22, 'en revision', $id_captura, 1);

            if ($request->id_etapa == 24) {
                $descripcion_estatus = "reingresado";
                $ing = 2;
            } else {
                $descripcion_estatus = "ingresado";
                $ing = 1;
            }

            $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">' . $descripcion_estatus . '</font><font color="#000000"> el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Licencia de construcción Web</strong>.</font><br><br><font color="#000000"> Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
            $titulo = "Notificación de Registro de Trámite en Línea";
            $correo = session('correo');

            Licencia_construccion_model::actualiza_edo_act($request->id_captura, $ing);
            Licencia_construccion_model::notifica($request, $titulo, $mensaje, $correo);


            return view('ciudadano/descanso');
        }
    }

    public function actualiza_solitud(Request $request)
    {

        if ($response = Licencia_construccion_model::actualiza_solitud_op($request)) {

            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 2, $request->id_solicitud, 20);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 20, 'pendiente', $obj->idcaptura, null);
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

    public function carta($fecha, $id_captura)
    {
        $data = [
            'fecha'      => $fecha,
            'id_captura' => $id_captura
        ];

        $pdf = PDF::loadView('licencia_construccion.carta', $data);
        return $pdf->download('carta responsiva.pdf');
    }
}
