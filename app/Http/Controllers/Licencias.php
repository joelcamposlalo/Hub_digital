<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Licencias_model;
use App\model\Predios_model;
use App\model\Prelicencias_model;
use App\model\Solicitudes_model;
use App\model\Geo_model;
use Illuminate\Support\Facades\Redirect;

class licencias extends Controller
{


    public function solicitud()
    {

        if ($folio = Licencias_model::solicitud()) {

            $vars = [
                'predios'   => Predios_model::get_all(0),
                'calles'    => Prelicencias_model::get_calles(),
                'colonias'  => Prelicencias_model::get_colonias(),
                'giros'     => Licencias_model::get_giros(),
                'plazas'    => Licencias_model::get_plazas(),
                'anuncios'  => Licencias_model::get_anuncios(),
                'folio'     => $folio
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));

            if ($result) {

                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 7, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 40];
            }

            return view('licencias/solicitud_uso_suelo', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function ingresa_solicitud_uso_suelo(Request $request)
    {

        if ($response = Licencias_model::ingresa_solicitud_uso_suelo($request)) {
            $obj = $response[0];

            if ($obj->Folio > 0) {

                $request->request->add([
                    'id_folio' => $obj->Folio
                ]);

                if (Solicitudes_model::inserta_datos_solicitud($request, 7, $request->id_solicitud, 40)) {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 41, 'en revision', $obj->Folio, null);

                    $titulo = "Notificación de Registro de Trámite en Línea";

                    $mensaje = "<font color='#000000'>Tu solicitud para <strong>Consulta de Uso de Suelo</strong> fue recibida por la Dirección de Padrón y Licencias con el <strong>folio:  $request->id_solicitud</strong>.</font> 
                    <br><br><font color='#000000'>
                    Te invitamos a estar al pendiente de tu correo electrónico para conocer el estatus de la solicitud.
                    <br><br>
                    Si deseas información adicional, consulta el portal.</font>";

                    $correo = session('correo');

                    Prelicencias_model::notifica($request, $titulo, $mensaje, $correo);


                    Redirect::to(url('ciudadano/descanso'))->send();
                } else {
                    session()->flash('alert', [
                        'type' => 'danger',
                        'msg'  => 'Ocurrio un problema al tratar de ingresar su solicitud, por favor intente más tarde.'
                    ]);

                    Redirect::to(url('ciudadano/tramites'))->send();
                }
            } else {
                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'Ocurrio un problema al tratar de ingresar su solicitud, por favor intente más tarde.'
                ]);

                Redirect::to(url('ciudadano/tramites'))->send();
            }
        }
    }

    public function ingresa_solicitud(Request $request)
    {

        if ($response = Licencias_model::ingresa_solicitud_pyl($request)) {
            $obj = $response[0];

            if ($obj->Folio > 0) {

                $request->request->add([
                    'id_folio' => $obj->Folio
                ]);

                if (Licencias_model::guarda_giro_precaptura($request)) {

                    $rows = Solicitudes_model::actualiza_datos_solicitud($request, 7, $request->id_solicitud, $request->etapa);

                    if ($rows == 0) {
                        http_response_code(503);
                        echo ($rows);
                        echo json_encode("0");
                    } else {
                        Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, $request->etapa_sig, 'pendiente', $obj->Folio, null);
                        http_response_code(200);
                        echo json_encode($obj->Folio);
                    }
                } else {
                    http_response_code(503);
                    echo json_encode($obj->Folio);
                }
            }
        } else {
            http_response_code(503);
        }
    }

    public function actualiza_solicitud(Request $request)
    {
        if ($response = Licencias_model::actualiza_solicitud_pyl($request)) {

            $obj = $response[0];

            if ($obj->folio > 0) {


                $rows = Solicitudes_model::actualiza_datos_solicitud($request, 7, $request->id_solicitud, $request->etapa);

                if ($rows == 0) {
                    http_response_code(503);
                    echo json_encode("0");
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, $request->etapa_sig, 'pendiente', $obj->folio, null);
                    http_response_code(200);
                    echo json_encode($obj->folio);
                }
            } else {
                http_response_code(503);
                echo json_encode($obj->folio);
            }
        } else {
            http_response_code(503);
        }
    }

    public function get_uso_zona(Request $request)
    {

        if ($response = Geo_model::get_uso_suelo($request->lat,$request->lon)) {

            $obj = $response[0];

            if ($obj->num_dist !=""&&$obj->cve_mpio==120) {


                $res = Geo_model::get_plan_parcial($request->lat,$request->lon);

                if (!$res) {
                    http_response_code(503);
                    
                } else {
                    $plan=$res[0];
                    if($plan->uso_suelo=="MIXTAS"){
                        $arr=["nombre_dis"=>$obj->nombre_dis,
                              "num_dist"=>$obj->num_dist,
                              "uso_suelo"=>$obj->uso_suelo,
                              "clas_area"=>$obj->clas_area1];
                        http_response_code(200);
                        echo json_encode($arr);
                    }else{
                        $arr=["nombre_dis"=>"USO NO VALIDO",
                              "num_dist"=>"-1"];
                        http_response_code(503);
                        echo json_encode($arr);
                    }
                    
                }
            } else {
                http_response_code(503);
                
            }
        } else {
            http_response_code(503);
        }
    }

    public function get_uso_zona_giro(Request $request)
    {

        if ($response = Geo_model::get_uso_suelo($request->lat,$request->lon)) {

            $obj = $response[0];

            if ($obj->num_dist !=""&&$obj->cve_mpio==120) {


                $res = Geo_model::get_plan_parcial($request->lat,$request->lon);

                if (!$res) {
                    http_response_code(503);
                    
                } else {
                    $plan=$res[0];
                    if($plan->uso_suelo=="MIXTAS"){
                        $arr=["nombre_dis"=>$obj->nombre_dis,
                              "num_dist"=>$obj->num_dist,
                              "uso_suelo"=>$obj->uso_suelo,
                              "clas_area"=>$obj->clas_area1];
                        http_response_code(200);
                        echo json_encode($arr);
                    }else{
                        $arr=["nombre_dis"=>"USO NO VALIDO",
                              "num_dist"=>"-1"];
                        http_response_code(503);
                        echo json_encode($arr);
                    }
                    
                }
            } else {
                http_response_code(503);
                
            }
        } else {
            http_response_code(503);
        }
    }
}
