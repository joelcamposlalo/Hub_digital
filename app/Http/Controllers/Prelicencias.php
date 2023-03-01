<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Prelicencias_model;
use App\model\Solicitudes_model;
use Illuminate\Support\Facades\Storage;
use App\model\Predios_model;
use Illuminate\Support\Facades\Redirect;
use PDF;


class Prelicencias extends Controller
{


    public function solicitud()
    {

        if ($folio = Prelicencias_model::solicitud()) {

            $vars = [
                'folio'     => $folio,
                'giros'     => Prelicencias_model::get_giros(),
                'calles'    => Prelicencias_model::get_calles(),
                'colonias'  => Prelicencias_model::get_colonias(),
                'files'    => Prelicencias_model::get_files($folio),
                'id_precaptura' => 0
            ];
        }

        $result = Solicitudes_model::consulta_solicitud(intval($folio));

        if ($result) {

            $solicitud  = $result[0];
            $id_etapa   = $solicitud->id_etapa;
            $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 4, $id_etapa);

            foreach ($result2 as $obj) {
                $vars += [$obj->campo => $obj->dato];
            }

            $vars += ["id_etapa" => $id_etapa];
        } else {
            $vars += ["id_etapa" => 13];
        }


        return view('prelicencias/solicitud', $vars);
    }

    public function get_requisitos(Request $request)
    {
        return Prelicencias_model::get_requisitos($request->idGiro);
    }

    public function requisitos($giro)
    {
        $result = Prelicencias_model::get_nombre($giro);

        if ($requisitos = Prelicencias_model::get_requisitos($giro)) {

            $nombre = $result[0];

            $data = [
                'requisitos' => $requisitos,
                'giro'       => $nombre->Nombre
            ];

            $pdf = PDF::loadView('prelicencias.requisitos', $data);
            return $pdf->download('requisitos.pdf');
        }
    }

    public function ingresa_solicitud(Request $request)
    {
        if ($id_precaptura = Prelicencias_model::guarda_precaptura($request)) {

            $obj = $id_precaptura[0];

            $requisitos=Prelicencias_model::get_archivos_terminados($request->id_solicitud);
            

            foreach ($requisitos as $r) {
                $id_cat_archivo = $r->id_cat_archivo;
                $ext = pathinfo($r->nombre, PATHINFO_EXTENSION);
                $id_documento = $r->id_documento;
                $nombre_archivo = $obj->id_precaptura. "_" . $id_documento . "." . $ext;
    
                    if (Storage::disk('s3')->exists('public/' . session('id_usuario') . '/' . $nombre_archivo)) {    
                        Storage::disk('s3')->delete('public/' . session('id_usuario') . '/' . $nombre_archivo);    
                        DB::table('archivos')
                            ->where('id_cat_archivo', $id_cat_archivo)
                            ->where('id_solicitud', $request->id_solicitud)
                            ->delete();
                
                    }
                
            }

            foreach ($_FILES as $key => $file) {

                if ($file["size"] > 0 && $file["name"] != "") {
    
                    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
                    $id_documento = str_replace("file_", "", $key);
                    $filename = $obj->id_precaptura. "_" . $id_documento . "." . $ext;
    
                
                    $files_s3=0;
                    $path = $request->file($key)->storeAs('public/' . session('id_usuario'), $filename, 's3');
                    if (Storage::disk('s3')->setVisibility($path, 'public')) {
                        $files_s3++;
                        $val= Prelicencias_model::inserta_requisito(                           
                            $id_documento,
                            $filename,
                            $ext,
                            $request->id_solicitud
                        );
                        
                    } else {
                        $files_s3--;
                    }
                        
                }
            }
            
            Solicitudes_model::inserta_dato_solicitud("id_precaptura", $obj->id_precaptura, 4, $request->id_solicitud, 15);

            Predios_model::post($request);

            if (Solicitudes_model::inserta_datos_solicitud($request, 4, $request->id_solicitud, 15)) {

                if ($obj->id_precaptura > 0) {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 16, 'en revision', 0, 0);

                    $titulo = "Notificación de Registro de Trámite en Línea";

                    $mensaje = "<font color='#000000'>Tu solicitud para la Prelicencia fue recibida por la Dirección de Padrón y Licencias con el <strong>folio:  $request->id_solicitud</strong>.</font> 
                                <br><br><font color='#000000'>
                                Te invitamos a estar al pendiente de tu correo electrónico para conocer el estatus de la solicitud.
                                <br><br>
                                Si deseas información adicional, consulta el portal.</font>";

                    $correo = session('correo');

                    Prelicencias_model::notifica($request, $titulo, $mensaje, $correo);


                    return view('ciudadano/descanso');
                } else {

                    Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 17, 'cancelado', 0, 0);

                    $titulo = "Notificación de Registro de Trámite en Línea";

                    $mensaje = "<font color='#000000'>Tu solicitud para la Prelicencia con el <strong>folio:  $request->id_solicitud</strong> fue <strong>cancelada</strong> por el sigueinte motivo: </font>  
                                <br><br><font color='#000000'><p style='text-align: center;'>
                                " . $obj->mensaje . " </p></font>
                                <br><br><font color='#000000'>
                                Si deseas información adicional, consulta el portal.</font>";

                    $correo = session('correo');

                    $data = [
                        'id_emisor'         => session('id_usuario'),
                        'id_receptor'       => session('id_usuario'),
                        'id_coordinacion'   => 3,
                        'titulo'            => $titulo,
                        'id_solicitud'      => $request->id_solicitud,
                        'descripcion'       => $mensaje
                    ];

                    Solicitudes_model::inserta_notificacion($data);

                    Prelicencias_model::notifica($request, $titulo, $mensaje, $correo);

                    session()->flash('alert', [
                        'type' => 'danger',
                        'msg'  => 'La solicitud fue cancelada el motivo siguiente: ' . $obj->mensaje
                    ]);


                    Redirect::to(url('ciudadano/tramites'))->send();
                }
            } else {

                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'No se puedieron guardar correctamente los datos de la solicitud, por favor intente más tarde'
                ]);


                Redirect::to(url('ciudadano/tramites'))->send();
            }
        }
    }

    public function rechazar(Request $request)
    {

        if (Prelicencias_model::rechazar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se rechazó correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de rechazar la solicitud'
            ]);
        }

        Redirect::to(url('revisor/solicitudes'))->send();
    }

    public function condicionar(Request $request)
    {

        if (Prelicencias_model::condicionar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se autorizó con condición correctamente'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de autorizar con condicion la solicitud'
            ]);
        }

        Redirect::to(url('revisor/solicitudes'))->send();
    }

    public function autorizar(Request $request)
    {

        if (Prelicencias_model::autorizar($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La solicitud se autorizó correctamente'
            ]);
            return true;
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de autorizar la solicitud'
            ]);
            return false;
        }
    }

    public function reenviar($id_solicitud)
    {

        if (Prelicencias_model::reenviar($id_solicitud)) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se reenvió correctamente el correo'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de reenviar el correo'
            ]);
        }

        Redirect::to(url('revisor/solicitudes'))->send();
    }
}
