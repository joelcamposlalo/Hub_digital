<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\model\Solicitudes_model;
use App\model\Capacitaciones_Model;

class Capacitaciones_Proteccion_Civil extends Controller
{
    public function solicitud()
    {

        if ($folio = Capacitaciones_Model::solicitud()) {

            $vars = [
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
                $vars += ["id_etapa" => 169];
            }

            return view('bombero_capacitacion/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function ingresa_solicitud(Request $request)
    {

    //aqui declaras que ejecute la funcion de ingresa solicitud donde esta el procedimiento almacenado
        if ($response = Capacitaciones_Model::ingresa_solicitud($request)) {

            $obj = $response[0];

            if ($obj->idcaptura > 0) {

                $request->request->add([
                    'id_captura' => $obj->idcaptura
                ]);

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 1, $request->id_solicitud, $request->etapa, $obj->idcaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo ($rows);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 170, 'pendiente', $obj->idcaptura, null);
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

        if ($response = Capacitaciones_Model::actualiza_solicitud($request)) {

            if ($response[0]) {

                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 1, $request->id_solicitud, 170, $response[0]->IdCaptura);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 170, 'pendiente', $response[0]->IdCaptura, null);
                    http_response_code(200);
                    echo json_encode($response[0]->IdCaptura,);
                }
            } else {
                http_response_code(503);
                echo json_encode($response[0]->IdCaptura);
            }
        } else {
            http_response_code(503);
        }
    }

    public function guardar(Request $request)
    {

        for ($i = 1; $i <= $request->input('contador'); $i++) {
            $parti[] = $request->input('participantes' . $i);
        }

        if (Capacitaciones_Model::guardarParticipantes($request, $parti)) {

            Capacitaciones_Model::avanzarEtapa($request);
            Capacitaciones_Model::sendMail($request);

            $request->request->add([
                'IdCaptura' => $request->id_captura
            ]);

            $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">'  . '</font><font color="#000000">realizado el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Capacitación de Protección Civil Y Bomberos</strong>.</font><br><br><font color="#000000">Mantente atento a este correo, ya que a través de él te informarán sobre la validación de tu trámite y, posteriormente, te comunicarán las fechas de tu capacitación. <br><br>Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
            $titulo = "Notificación de Registro de Trámite en Línea";

            Capacitaciones_Model::notifica($request, $titulo, $mensaje);

            return view('/ciudadano/descanso_capacitacion');
        } else {
            return redirect()->route('bombero_capacitacion.solicitud')->with('error', 'Hubo un problema al guardar los participantes.');
        }
    }

}
