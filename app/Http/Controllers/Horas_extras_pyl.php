<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Horas_extras_pyl_model;
use App\model\Solicitudes_model;
use Illuminate\Support\Facades\View;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use PDF;
use PhpParser\Node\Stmt\Foreach_;

class Horas_extras_pyl extends Controller
{
    public function solicitud()
    {
        if ($folio = Horas_extras_pyl_model::solicitud()) {

            $vars = [
                'folio'      => $folio,
                'files'      => Horas_extras_pyl_model::get_files($folio),
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));

            if ($result) {

                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2    = Solicitudes_model::consulta_datos_solicitud($folio, 8, $id_etapa);

                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }

                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 45];
            }

            return view('horas_extras/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function get_datos_licencia(Request $request)
    {
        $licencia = $request->licencia;
        $result = Horas_extras_pyl_model::get_datos_licencia($licencia);

        if (!is_null($result) && !empty($result)) {
            $result2 = Horas_extras_pyl_model::get_licencia_no_tramitar($licencia);
            $result3 = Horas_extras_pyl_model::get_licencia_tramite_pendiente($licencia);
            $tramitar = 0;
            $tramite_pendiente = 0;
            $giro = $result[0]->Giro;
            if ($result2)
                $tramitar = $result2[0]->NoTramitar;
            if ($result3)
                $tramite_pendiente = $result3[0]->TramitePendiente;

            if ($tramitar == 0 && $tramite_pendiente == 0) {
                http_response_code(200);
                echo json_encode($result);
            } else if ($tramitar == 1) {
                http_response_code(404);
                echo json_encode(['msg' => 'Licencia con Alerta', 'Giro' => $giro] + $result);
            } else if ($tramite_pendiente == 1) {
                http_response_code(404);
                echo json_encode(['msg' => 'Licencia con Tramite pendiente', 'Giro' => $giro] + $result);
            }
        } else {

            http_response_code(404);
            echo json_encode(['msg' => 'No se encontraron resultados, verifica el número de licencia e intente nuevamente', 'Giro' => '']);
        }
    }

    public function get_permisos_giro(Request $request)
    {
        $id_giro = $request->id_giro;
        /*$result = Horas_extras_pyl_model::get_permisos_giro($id_giro);
        $result = Horas_extras_pyl_model::get_horas_giro($id_giro);*/

        $result = [
            'permisos' => Horas_extras_pyl_model::get_permisos_giro($id_giro),
            'horas'    => $result = Horas_extras_pyl_model::get_horas_giro($id_giro)
        ];

        if (!is_null($result) && !empty($result)) {

            http_response_code(200);
            echo json_encode($result);
        } else {

            http_response_code(404);
            echo json_encode(['msg' => 'Sin restricciones']);
        }
    }

    public function guarda_permiso(Request $request)
    {
        $id_giro = $request->id_giro;
        $result = Horas_extras_pyl_model::get_permisos_giro($id_giro);

        if (!is_null($result) && !empty($result)) {

            http_response_code(200);
            echo json_encode($result);
        } else {

            http_response_code(404);
            echo json_encode(['msg' => 'Sin restricciones']);
        }
    }

    public function procesa_dias(Request $request)
    {
        $licencia = $request->TxtNoLicencia;
        $fechas = explode(",", $request->fechas);
        $result = 0;
        foreach ($fechas as &$dia) {
            $result += Horas_extras_pyl_model::guarda_dias($licencia, $dia);
        }


        if (!is_null($result) && !empty($result) && $result == (count($fechas) - 1)) {

            http_response_code(200);
            echo json_encode($result);
        } else {

            http_response_code(404);
            echo json_encode(['msg' => 'Sin restricciones']);
        }
    }

    public function ingresa_solitud(Request $request)
    {

        $licencia   = $request->TxtNoLicencia;
        $fechas     = explode(",", $request->fechas);
        $numDias    = count($fechas);
        $per        = $request->per;
        $fechaActual = new DateTime('today');

        $result = 0;
        foreach ($fechas as &$dia) {
            $result += Horas_extras_pyl_model::guarda_dias($licencia, $dia);
        }

        $request->request->add([
            'fechaSol' => date('d/m/Y', time())
        ]);

        if (!is_null($result) && !empty($result) && $result == (count($fechas) - 1)) {

            http_response_code(200);
            echo json_encode($result);
        } else {

            $rows = Solicitudes_model::actualiza_datos_solicitud($request, 8, $request->id_solicitud, $request->etapa);

            if ($rows == 0) {

                http_response_code(503);
                echo ($rows);
                echo json_encode("0");
            } else {

                $datosLic           = Horas_extras_pyl_model::get_datos_licencia_orden($licencia);
                $obs                = Horas_extras_pyl_model::genera_dias($licencia);
                $vigIni             = Horas_extras_pyl_model::get_vigencia_ini($licencia);
                $vigIni             = $vigIni[0] . '-' . $vigIni[1] . '-' . $vigIni[2];
                $vigFin             = Horas_extras_pyl_model::get_vigencia_fin($licencia);
                $vigFin             = $vigFin[0] . '-' . $vigFin[1] . '-' . $vigFin[2];
                $guardaPermiso      = Horas_extras_pyl_model::guarda_permiso($licencia, '', $vigFin, $obs, $numDias, $per);
                $solicitud          = $guardaPermiso[0];
                $folio              = $guardaPermiso[1];
                $agregaDatosSol     = Horas_extras_pyl_model::agregar_datos_solicitud($solicitud, $folio);
                $idGiro             = Horas_extras_pyl_model::get_idGiro($licencia);
                $leyendas           = Horas_extras_pyl_model::get_permisos_giro($idGiro);
                $guardaPermisoVD    = Horas_extras_pyl_model::guardar_permiso_vdigital($licencia, $vigFin, $numDias, $solicitud, $folio, $request->idUsuario, $request->idSolicitud, $idGiro, $request->correo);
                $generaAdeudos      = Horas_extras_pyl_model::genera_adeudos_pyl($solicitud, $folio, $per);
                $generaPorcentaje   = Horas_extras_pyl_model::genera_porcentaje_pyl($folio);
                $giro               = Horas_extras_pyl_model::get_giro($licencia);
                $adeudos            = Horas_extras_pyl_model::get_adeudos($folio, '103',  $fechaActual->format('d/m/Y'));
                $adeudosSir         = Horas_extras_pyl_model::get_adeudo_sir($folio);

                foreach ($adeudos as $adeudo) {
                    foreach ($adeudosSir as $adeudoSir) {
                        Horas_extras_pyl_model::genera_adeudo_permiso($adeudoSir[0], $adeudoSir[5], $adeudoSir[1], $adeudoSir[2]);
                    }
                }

                if ($per == 10) {
                    $observacion = 'EVENTO CON HORAS EXTRA CON CONSUMO DE BEBIDAS ALCOHOLICAS Y MUSICA EN VIVO Y/O GRABADA PARA AMBIENTAR LOS DIAS: ' . $fechas . ' HASTA LAS ' . $request->horas;
                    $restriccion = 'Favor de No exceder decibeles permitidos por la NOM. La musica es dentro del establecimiento.';
                } elseif ($per == 22) {
                    $observacion = 'EVENTO CON CONSUMO DE BEBIDAS ALCOHOLICAS, PERMISO DE MUSICA EN VIVO Y/O GRABADA PARA AMBIENTAR LOS DIA(S): ' . $fechas . ' HASTA LAS ' . $request->horas;
                    $restriccion = 'Favor de No exceder decibeles permitidos por la NOM. La musica es dentro del establecimiento.';
                }

                $restricciones = 'Prohibido el consumo y venta de bebidas alcoholicas a menores de edad. ' . $restriccion;

                Horas_extras_pyl_model::guarda_restricciones($folio, $leyendas, $restricciones);

                Solicitudes_model::actualiza_etapa_solicitud($request->id_solicitud, 47, 'pendiente', null, null);

                http_response_code(200);
                echo json_encode(1);
            }
        }
    }

    public function permiso($id_permiso)
    {
        $datos      = Horas_extras_pyl_model::get_datos_recibo($id_permiso);
        $firma      = Horas_extras_pyl_model::get_firma();
        $conceptos  = Horas_extras_pyl_model::get_conceptos($id_permiso);
        $recibo     = Horas_extras_pyl_model::get_recibo($id_permiso);
        $fechaInicio    = new DateTime($datos[0]->Autorizacion);
        $fechaFin       = new DateTime($datos[0]->Vencimiento);
        $fechaActual    = new DateTime('today');
        $fechaPago      = new DateTime($conceptos[0]->FechaPago);
        $folio      = Horas_extras_pyl_model::get_folio($conceptos[0]->Recibo);

        $data = [
            'NumeroReferenciaPagoTerceros'  => $recibo[0]->NumeroReferenciaPagoTerceros,
            'Contribuyente'                 => $recibo[0]->ContribuyenteNombre,
            'NumeroLicencia'                => $datos[0]->NumeroLicencia,
            'Domicilio'                     => $recibo[0]->ContribuyenteDomicilio,
            'RFC'                           => $datos[0]->RFC,
            'FolioLicenciaCedula'           => $folio[0]->Folio,
            'Conceptos'                     => $conceptos,
            'FechaPago'                     => $fechaPago->format('d/m/Y'),
            'ImporteRedondeo'               => '$ ' .  number_format($recibo[0]->ImporteRedondeo, 2, ".", ","),
            'Total'                         => '$ ' .  number_format($recibo[0]->Total, 2, ".", ","),
            'OID'                           => $recibo[0]->OID,
            'FolioPermiso'                  => $datos[0]->FolioPermiso,
            'TipoPermiso'                   => $datos[0]->TipoPermiso,
            'Nombre'                        => $datos[0]->Nombre,
            'NombreCalle'                   => $datos[0]->NombreCalle,
            'Exterior'                      => $datos[0]->Exterior,
            'Interior'                      => $datos[0]->Interior,
            'EntreCalles'                   => $datos[0]->EntreCalle1 . ' y ' . $datos[0]->EntreCalle2,
            'NombreColonia'                 => $datos[0]->NombreColonia,
            'Giro'                          => $datos[0]->Giro,
            'Vigencia'                      => $fechaInicio->format('d/m/Y') . ' al ' . $fechaFin->format('d/m/Y'),
            'Observaciones'                 => $datos[0]->Observaciones,
            'Restricciones'                 => $datos[0]->Restricciones,
            'FechaActual'                   => 'Zapopan, Jalisco ' . $fechaActual->format('d/m/Y'),
            'FirmaNombre'                   => $firma[0]->FirmaDirector,
            'FirmaLeyenda'                  => $firma[0]->Leyenda,
            'FirmaImagen'                   => $firma[0]->Firma,
        ];

        $pdf = PDF::loadView('horas_extras.permiso', $data);
        return $pdf->download($id_permiso . '.pdf');
    }

    public function orden()
    {

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML(View::make('horas_extras.orden'))
            ->setPaper('Letter')
            ->setOptions([
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'enable-javascript', true,
                'javascript-delay', 5000,
                'enable-smart-shrinking', true,
                'no-stop-slow-scripts', true
            ]);





        return  $pdf->stream('orden.pdf');
    }
}
