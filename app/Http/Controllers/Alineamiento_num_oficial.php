<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\model\Predios_model;
use App\model\Alineamiento_num_oficial_model;
use App\model\Solicitudes_model;
use App\model\Notificaciones_model;
use App\model\Ciudadano_model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class Alineamiento_num_oficial extends Controller
{
    //

    public function solicitud()
    {

        if ($folio = Alineamiento_num_oficial_model::solicitud()) {

            $vars = [
                'predios'  => Predios_model::get_all(0),
                'ultimo'   => Predios_model::get_count(), 
                'files'    => Alineamiento_num_oficial_model::get_files($folio),
                'folio'    => $folio,
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));
            if ($result) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2    = Solicitudes_model::consulta_datos_solicitud($folio, 5, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 26];
            }

            return view('alineamiento_num_oficial/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    /**
     * 
     * Subir archivos
     * 
     */

    public function upload(Request $request)
    {

        if ($response = Alineamiento_num_oficial_model::upload($request->all())) {
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(503);
        }
    }

    public function ingresa_solicitud(Request $request)
    {


        if ($response = Alineamiento_num_oficial_model::ingresa_solicitud_op($request)) {
            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add([
                    'id_captura' => $obj->idcaptura
                ]);

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 5, $request->id_solicitud, $request->etapa);



                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 27, 'pendiente', $obj->idcaptura, null);
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
        $id_captura = $request->id_captura;
        $rows = 0;
        $files_s3 = 0;
        $rows_elimina = 0;

        $requisitos = Alineamiento_num_oficial_model::consulta_requisitos_op($request->id_captura);

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

        $rows_elimina = Alineamiento_num_oficial_model::elimina_requisito_op($request->id_captura);


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
                    $rows += Alineamiento_num_oficial_model::inserta_requisito_op(
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

        $pendientes = Alineamiento_num_oficial_model::consulta_archivos_faltantes($request->id_solicitud);



        if ($pendientes || $rows <> $files_s3) {


            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 28, 'pendiente', $id_captura, null);



            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);
            if ($result) {

                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;


                if ($id_tramite == 5) {

                    $result2 = Solicitudes_model::consulta_datos_solicitud($request->id_solicitud, $id_tramite, 27);

                    $vars = [
                        'predios'  => Predios_model::get_all(),
                        'files'    => Alineamiento_num_oficial_model::get_files($id_tramite, $folio),
                        'folio'    => $folio,
                        'error'   => 'Debe de completar todos los archivos obligatorios',
                        'id_etapa' => $solicitud->id_etapa
                    ];

                    if ($solicitud->id_etapa == 31) {
                        $vars += ['notificacion' => Notificaciones_model::get_observacion($request->id_solicitud)];
                    }

                    foreach ($result2 as $obj) {
                        $vars += [$obj->campo => $obj->dato];
                    }

                    return view('alineamiento_num_oficial/solicitud', $vars);
                }
            }
        } else {


            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 29, 'en revision', $id_captura, 5);



            if ($request->id_etapa == 31) {
                $descripcion_estatus = "reingresado";
                $ing = 2;
            } else {
                $descripcion_estatus = "ingresado";
                $ing = 1;
            }

            $mensaje = '<font color="#000000">Gracias por utilizar esta herramienta electrónica. Has </font><font color="#000000">' . $descripcion_estatus . '</font><font color="#000000"> el trámite en línea con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital del </font><strong><font color="#000000">Certificado de Alineamiento y Número Oficial</strong>.</font><br><br><font color="#000000">Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse. Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos. Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda.</font>';
            $leyendaVac = Ciudadano_model::get_leyenda_vac(1, '');
            if (!empty($leyendaVac[0]) && ($leyendaVac[0]->fecha_inicio < date("Y-m-d H:i:s")) && ($leyendaVac[0]->fecha_fin > date("Y-m-d H:i:s"))) {
                $mensaje += '<br><br><font color="#000000"> ' . $leyendaVac[0]->nota . ' </font>';
            }
            $titulo = "Notificación de Registro de Trámite en Línea";
            $correo = session('correo');
            Alineamiento_num_oficial_model::actualiza_edo_act($request->id_captura, $ing);
            Alineamiento_num_oficial_model::notifica($request, $titulo, $mensaje, $correo);


            return view('ciudadano/descanso');
        }
    }

    public function actualiza_solitud(Request $request)
    {

        if ($response = Alineamiento_num_oficial_model::actualiza_solitud_op($request)) {

            $obj = $response[0];

            if ($obj->idcaptura > 0) {


                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 5, $request->id_solicitud, 27);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 27, 'pendiente', $obj->idcaptura, null);
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

        $pdf = PDF::loadView('alineamiento_num_oficial.carta', $data);
        return $pdf->download('carta responsiva.pdf');
    }
}
