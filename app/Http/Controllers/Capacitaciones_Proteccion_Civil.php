<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;
use App\model\Capacitaciones_Model;
use App\model\Dictamen_finca_antigua_model;
use App\Mail\contactoCapacitacion;
use PDF;
use App\model\Mail;
use App\model\Notificacion;


class Capacitaciones_Proteccion_Civil extends Controller
{
    public function solicitud()
    {

        if ($folio = Capacitaciones_Model::solicitud()) {

            $vars = [
                'files'    => Dictamen_finca_antigua_model::get_files($folio),
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

            return view('bombero_uno/solicitud', $vars);
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


    public function ingresa_tramite(Request $request)
    {
        $id_captura = $request->id_captura;
        $rows = 0;
        $files_s3 = 0;
        $rows_elimina = 0;

        $requisitos = Capacitaciones_Model::consulta_requisitos_op(
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

            $mensaje = '<font color="#000000">Gracias  por utilizar esta herramienta electrónica. Has </font><font color="#000000">'  . '</font><font color="#000000"> el trámite en línea  con el </font><strong><font color="#000000">No. de precaptura </font><font color="#000000">' . $request->id_captura . '</font><font color="#000000"></strong> en el proceso de revisión digital de </font><strong><font color="#000000">Capacitación de Protección Civil Y Bomberos</strong>.</font><br><br><font color="#000000">Mantente atento a este correo, ya que a través de él te informarán sobre la validación de tu trámite y, posteriormente, te comunicarán las fechas de tu capacitación. <br><br>Al dar click de aceptación bajo esta modalidad manifiestas tu voluntad para dar seguimiento al desarrollo de tu trámite y estar al pendiente por el mismo medio electrónico, de las notificaciones y observaciones que pudieran suscitarse.  Recuerda, la terminación de tu trámite dependerá del tiempo en el que subsanes tus observaciones y documentos.  Así mismo el anexar información apócrifa o falsa y/o incorrecta será responsabilidad del titular del acto administrativo que se solicita haciéndose acreedores a las sanciones civiles, administrativas y penales que corresponda</font>.';
            $titulo = "Notificación de Registro de Trámite en Línea";

            Capacitaciones_Model::notifica($request, $titulo, $mensaje);

            return view('/ciudadano/descanso');
        } else {
            echo "no funciono, favor de intentar de nuevo";
        }
        exit;
        return redirect()->route('bombero_uno.solicitud');
    }

    public static function consulta_requisitos_op($id_solicitud)
    {
        $sql = "SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga,
        c.id_documento,c.obligatorio,ao.* FROM   cat_archivo c join archivos a
        on c.id_cat_archivo =a.id_cat_archivo join archivosodt ao  on ao.id_archivo =a.id_archivo
        where a.id_solicitud = ? and a.id_usuario ="     . session('id_usuario') . "
        and ao.estatus='validado'";
        $result = DB::select($sql, [$id_solicitud]);
        return $result;
    }
}
