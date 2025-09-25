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

    public function guardarConsulta(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'cuenta' => 'required|string'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $cuenta = trim($datos['cuenta']);
        $longitud = strlen($cuenta);

        if (!in_array($longitud, [10, 31], true)) {
            return response()->json([
                'message' => 'La cuenta debe tener 10 o 31 dígitos.'
            ], 422);
        }

        $campo = $longitud === 31 ? 'curt' : 'cuenta';

        $this->guardarCampos($datos['id_solicitud'], 237, [
            $campo => $cuenta
        ]);

        return response()->json([
            'message' => 'Datos de consulta guardados correctamente.'
        ]);
    }

    public function guardarVerificacion(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'nombre' => 'nullable|string',
            'apellido_1' => 'nullable|string',
            'apellido_2' => 'nullable|string',
            'domicilio' => 'nullable|string',
            'no_oficial' => 'nullable|string',
            'interior' => 'nullable|string',
            'entrecalle1' => 'nullable|string',
            'entrecalle2' => 'nullable|string',
            'colonia' => 'nullable|string',
            'manzana' => 'nullable|string',
            'lote' => 'nullable|string',
            'telefono' => 'nullable|string',
            'correo' => 'nullable|string'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except([
            '_token',
            'id_solicitud',
            'id_captura',
            'id_captura_frm4',
            'origen'
        ]);

        $this->guardarCampos($datos['id_solicitud'], 237, $campos);

        return response()->json([
            'message' => 'Datos del solicitante guardados correctamente.'
        ]);
    }

    public function guardarAdecuaciones(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'mantenimiento' => 'nullable|array',
            'anuncio' => 'nullable|array',
            'otro' => 'nullable|array',
            'gama' => 'nullable|string',
            'molduras' => 'nullable|string',
            'macizo' => 'nullable|string',
            'marca_pintura' => 'nullable|string',
            'otro_mantenimiento' => 'nullable|string',
            'dimensiones_toldo' => 'nullable|string',
            'otro_otro' => 'nullable|string'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);
        $campos['mantenimiento'] = $request->input('mantenimiento', []);
        $campos['anuncio'] = $request->input('anuncio', []);
        $campos['otro'] = $request->input('otro', []);

        $this->guardarCampos($datos['id_solicitud'], 237, $campos);

        return response()->json([
            'message' => 'Adecuaciones guardadas correctamente.'
        ]);
    }

    public function guardarInmueble(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'dimension_fachada' => 'nullable|string',
            'altura' => 'nullable|string',
            'tipo' => 'nullable|string',
            'giro_comercial' => 'nullable|string',
            'plaza_comercial' => 'nullable|string',
            'ancho_ingreso' => 'nullable|string',
            'anuncio_instalado' => 'nullable|string',
            'razon_social' => 'nullable|string',
            'cedula_comercial' => 'nullable|string',
            'nombre_plaza' => 'nullable|string'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);

        $this->guardarCampos($datos['id_solicitud'], 238, $campos);

        return response()->json([
            'message' => 'Información del inmueble guardada correctamente.'
        ]);
    }

    public function guardarCroquis(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'latitud' => 'required',
            'longitud' => 'required'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $this->guardarCampos($datos['id_solicitud'], 238, [
            'latitud' => $datos['latitud'],
            'longitud' => $datos['longitud']
        ]);

        return response()->json([
            'message' => 'Croquis guardado correctamente.'
        ]);
    }

    public function guardarAnexos(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'memoria_descriptiva' => 'nullable|string',
            'numero_color' => 'nullable|string',
            'tipo_letra' => 'nullable|string',
            'dim_altura' => 'nullable|string',
            'dim_ancho' => 'nullable|string',
            'dim_fondo' => 'nullable|string',
            'dim_observaciones' => 'nullable|string'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);

        $this->guardarCampos($datos['id_solicitud'], 238, $campos);

        return response()->json([
            'message' => 'Memoria descriptiva guardada correctamente.'
        ]);
    }

    public function guardarDocumentacion(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);

        $this->guardarCampos($datos['id_solicitud'], 238, $campos);

        return response()->json([
            'message' => 'Documentación registrada correctamente.'
        ]);
    }

    private function asegurarSolicitudDelUsuario(int $idSolicitud): void
    {
        $resultado = Solicitudes_model::consulta_solicitud($idSolicitud);

        if (!$resultado || count($resultado) === 0) {
            abort(404, 'Solicitud no encontrada.');
        }
    }

    private function guardarCampos(int $idSolicitud, int $idEtapa, array $campos): void
    {
        $idUsuario = session('id_usuario');

        if (!$idUsuario) {
            abort(403, 'Sesión no válida.');
        }

        DB::transaction(function () use ($idSolicitud, $idEtapa, $campos, $idUsuario) {
            foreach ($campos as $campo => $valor) {
                $campoNormalizado = trim((string) $campo);

                if ($campoNormalizado === '') {
                    continue;
                }

                if (is_array($valor)) {
                    $valores = $this->limpiarArreglo($valor);

                    DB::table('datos_solicitudes')
                        ->where('id_solicitud', $idSolicitud)
                        ->where('id_usuario', $idUsuario)
                        ->where('id_tramite', 38)
                        ->where('id_etapa', $idEtapa)
                        ->where('campo', $campoNormalizado)
                        ->delete();

                    foreach ($valores as $dato) {
                        DB::table('datos_solicitudes')->insert([
                            'id_solicitud' => $idSolicitud,
                            'id_usuario' => $idUsuario,
                            'id_tramite' => 38,
                            'id_etapa' => $idEtapa,
                            'campo' => $campoNormalizado,
                            'dato' => $dato,
                            'created_at' => now()
                        ]);
                    }

                    continue;
                }

                $dato = $this->limpiarValor($valor);

                DB::table('datos_solicitudes')->updateOrInsert(
                    [
                        'id_solicitud' => $idSolicitud,
                        'id_usuario' => $idUsuario,
                        'id_tramite' => 38,
                        'id_etapa' => $idEtapa,
                        'campo' => $campoNormalizado
                    ],
                    [
                        'dato' => $dato,
                        'created_at' => now()
                    ]
                );
            }
        });
    }

    private function limpiarValor($valor): string
    {
        if (is_string($valor)) {
            $valor = trim($valor);
        }

        if ($valor === null) {
            return '';
        }

        if (is_bool($valor)) {
            return $valor ? '1' : '0';
        }

        if (is_scalar($valor)) {
            return (string) $valor;
        }

        return json_encode($valor);
    }

    private function limpiarArreglo(array $valores): array
    {
        $resultado = [];

        foreach ($valores as $valor) {
            if (is_string($valor)) {
                $valor = trim($valor);
            }

            if ($valor === null || $valor === '') {
                continue;
            }

            if (is_bool($valor)) {
                $resultado[] = $valor ? '1' : '0';
            } elseif (is_scalar($valor)) {
                $resultado[] = (string) $valor;
            } else {
                $resultado[] = json_encode($valor);
            }
        }

        return $resultado;
    }
}
