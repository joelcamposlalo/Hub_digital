<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Daiu_model;
use App\model\Solicitudes_model;

class Dictamenes_daiu extends Controller
{

    public function solicitud()
    {
        // Inicia el trámite
        if ($folio = Daiu_model::solicitud()) {

            $vars = [
                'files'        => Daiu_model::get_files($folio),
                'folio'        => $folio,
                'id_solicitud' => $folio
            ];

            $result = Solicitudes_model::consulta_solicitud(intval($folio));
            if ($result && count($result) > 0) {
                $solicitud  = $result[0];
                $id_etapa   = $solicitud->id_etapa;
                $result2 = Solicitudes_model::consulta_datos_solicitud($folio, 1, $id_etapa);
                foreach ($result2 as $obj) {
                    $vars += [$obj->campo => $obj->dato];
                }
                $vars += ["id_etapa" => $id_etapa];
            } else {
                $vars += ["id_etapa" => 236];
            }

            return view('daiu/solicitud', $vars);
        }

        session(['lastpage' => __FILE__]);
    }

    public function consultaCuenta(Request $request)
    {
        $cuenta = trim($request->input('cuenta'));
        $sql = "SELECT * FROM vd_consulta_cuenta(?, ?)";

        if (strlen($cuenta) == 10) {
            $result = DB::connection('catastro')->select($sql, [$cuenta, null]);
        } elseif (strlen($cuenta) == 31) {
            $result = DB::connection('catastro')->select($sql, [null, $cuenta]);
        } else {
            return response()->json(['msg' => 'La cuenta debe tener 10 o 31 dígitos.'], 422);
        }
       
        if ($result && count($result) > 0) {

            return response()->json($result);
        }
        return response()->json(['msg' => 'No se encontró el predio'], 404);
    }

    public function informacion_inmueble(Request $request)
    {

    }
}
