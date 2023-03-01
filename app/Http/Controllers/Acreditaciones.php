<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\Acreditaciones_model;
use App\model\Solicitudes_model;
use Illuminate\Support\Facades\Storage;
use PDF;

class Acreditaciones extends Controller
{
    public function solicitud()
    {

        if ($folio = Acreditaciones_model::solicitud()) {

            $vars = [
                'folio'      => $folio,
                'files'      => Acreditaciones_model::get_files($folio),
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));


            if ($result) {

                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2    = Solicitudes_model::consulta_datos_solicitud($folio, 3, $id_etapa);

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 7];
            }


            return view('acreditaciones/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function get_acreditaciones_previas(Request $request)
    {
        $folio_expediente = $request->folio_expediente;
        $curp = $request->curp;
        if ($response = Acreditaciones_model::get_acreditaciones_previas($folio_expediente, $curp)) {

            $obj = $response[0];
            if ($obj->id_acreditacion > 0) {

                //Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 2, 'pendiente');
                http_response_code(200);
                echo json_encode($obj);
            } else {
                http_response_code(503);
                echo json_encode($obj->id_acreditacions);
            }
        } else {
            http_response_code(503);
        }
    }




    public function ingresa_solicitud(Request $request)
    {
        if ($request->id_solicitud_ac > 0)
            $response = Acreditaciones_model::actualiza_solicitud_ac($request);
        else
            $response = Acreditaciones_model::ingresa_solicitud($request);

        if ($response) {
            $obj = $response[0];
            if ($obj->id > 0) {

                $folio_expediente = $request->id_acreditacion;
                if (!$folio_expediente)
                    $folio_expediente = 0;

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 3, $request->id_solicitud, 8);
                Solicitudes_model::inserta_dato_solicitud("id_solicitud_ac", $obj->id, 3, $request->id_solicitud, 8);
                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 8, 'pendiente', $folio_expediente, 0);
                    http_response_code(200);
                    echo json_encode($obj->id);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->id);
            }
        } else {
            http_response_code(503);
        }
    }


    public function actualiza_solicitud(Request $request)
    {
        if ($response = Acreditaciones_model::actualiza_solitud($request)) {
            $obj = $response[0];
            if ($obj->id > 0) {

                $folio_expediente = $request->id_acreditacion;
                if (!$folio_expediente)
                    $folio_expediente = 0;
                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 3, $request->id_solicitud, 8);
                Solicitudes_model::inserta_dato_solicitud("id_solicitud_ac", $obj->id, 3, $request->id_solicitud, 8);
                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {
                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 8, 'pendiente', $folio_expediente, 0);
                    http_response_code(200);
                    echo json_encode($obj->id);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->id);
            }
        } else {
            http_response_code(503);
        }
    }

    public function consulta_requisitos(Request $request)
    {

        if ($response = Acreditaciones_model::consulta_requisitos($request)) {
            //var_dump($response);
            echo json_encode($response);
        } else {
            http_response_code(503);
        }
    }


    public function ingresa_tramite(Request $request)
    {
        $id_captura = $request->id_captura;
        $rows = 0;

        foreach ($_FILES as $key => $file) {

            if ($file["size"] > 0 && $file["name"] != "") {

                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

                $uploadedFile = $request->file($key);

                $id_documento = str_replace("file_", "", $key);
                $filename = $request->id_solicitud . "_" . $id_documento . "." . $ext;
                $path = $request->file($key)->storeAs('public/' . session('id_usuario'), $filename, 's3');

                if (Storage::disk('s3')->setVisibility($path, 'public')) {

                    $rows += Acreditaciones_model::inserta_requisito_ac($request->id_solicitud, $id_documento, $filename, $ext);
                } else {
                    $rows--;
                }
            }
        }

        $pendientes = Acreditaciones_model::consulta_requisitos($request);

        $cuenta_pendientes = 0;
        foreach ($pendientes as $f) {
            if ($f->id_archivo_usuario == null) {
                $cuenta_pendientes++;
            }
        }
        if ($cuenta_pendientes > 0) {

            $folio_expediente = $request->id_acreditacion;
            if (!$folio_expediente)
                $folio_expediente = 0;
            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 9, 'pendiente', $folio_expediente, 0);
            $result = Solicitudes_model::consulta_solicitud($request->id_solicitud);


            if ($result) {
                $solicitud  = $result[0];
                $folio      = $solicitud->id_solicitud;
                $id_tramite = $solicitud->id_tramite;

                $result2 = Solicitudes_model::consulta_datos_solicitud(
                    $request->id_solicitud,
                    $id_tramite,
                    7
                );
                $vars = [
                    'folio'      => $folio,
                    'id_etapa' => $solicitud->id_etapa,
                    'error'   => 'Debes completar todos los archivos obligatorios',
                    'files'      => Acreditaciones_model::get_files($folio),
                ];


                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                return view('acreditaciones/solicitud', $vars);
            }
        } else {
            $folio = $request->id_solicitud;
            $folio_expediente = $request->id_acreditacion;
            if (!$folio_expediente)
                $folio_expediente = 0;
            Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 10, 'en revision', $folio_expediente, 0);


            if ($request->id_etapa == 12) {
                $descripcion_estatus = "reingresado";

                $titulo = "Notificación de Reingreso de Trámite en Línea";

                $mensaje = "<font color='#000000'>Tu solicitud para la acreditación fue reingresada a la Dirección de Movilidad y Transporte con el <strong>folio:  $folio</strong>.</font> 
                <br><br><font color='#000000'>
                Te invitamos a estar al pendiente de tu correo electrónico para conocer el estatus de la solicitud.
                <br><br>
                Si deseas información adicional, consulta el portal.</font>";
            } else {
                $descripcion_estatus = "ingresado";

                $titulo = "Notificación de Registro de Trámite en Línea";

                $mensaje = "<font color='#000000'>Tu solicitud para la acreditación fue recibida por la Dirección de Movilidad y Transporte con el <strong>folio:  $folio</strong>.</font> 
                <br><br><font color='#000000'>
                Te invitamos a estar al pendiente de tu correo electrónico para conocer el estatus de la solicitud.
                <br><br>
                Si deseas información adicional, consulta el portal.</font>";
            }

            $correo = session('correo');

            Acreditaciones_model::notifica($request, $titulo, $mensaje, $correo);


            return view('ciudadano/descanso');
        }
    }
    public function acreditacion_movilidad($id_solicitud)
    {


        $res_tramite = Solicitudes_model::consulta_solicitud($id_solicitud);


        if ($res_tramite) {

            $result = Acreditaciones_model::consulta_acreditacion_qr($id_solicitud);


            if ($result) {
                $ac = $result[0];
                $placa = $ac->placa;
                $curp = $ac->curp;
                if ($ac->placa2 != null) {
                    $placa = $placa . "," . $ac->placa2;
                }
                if ($ac->placa3 != null) {
                    $placa = $placa . "," . $ac->placa3;
                }

                $data = array(
                    "curp" => $ac->curp,
                    "tipo_acreditacion" => $ac->desc_tipo_acreditacion,
                    "vigencia" => $ac->fecha_fin,
                    "placa" => $placa,
                    "curp" => $curp,
                    "folio" => $ac->folio_expediente,
                );
                //$pdf = PDF::loadView('acreditaciones.acreditacion',$data);
                $contxt = stream_context_create([
                    'ssl' => [
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                        'allow_self_signed' => TRUE
                    ]
                ]);

                $pdf = PDF::loadView('acreditaciones.acreditacion', $data);
                //return view('acreditaciones.acreditacion',$data);                
                return $pdf->download('acreditacion.pdf');
            }
            /*$data=array("usuario"=>$usuario,
                        "mis_tramites"=>$result_tramite,
                        "error_msg"=>$error_msg,
                        "success_msg"=>$success_msg,
                        "procesos"=>$result_procesos);    */
            //var_dump($data);

        }
        //return view('pdf.acreditacion');    

    }
}
