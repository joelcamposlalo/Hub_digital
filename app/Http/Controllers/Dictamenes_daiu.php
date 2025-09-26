<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\model\Daiu_model;
use App\model\Solicitudes_model;
use Throwable;

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
            'cuenta' => 'required|string',
            'id_captura' => 'nullable|integer'

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

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));
            $this->guardarCampos($datos['id_solicitud'], 237, [
                $campo => $cuenta,
                'id_captura' => (string) $idCaptura
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible iniciar la precaptura del trámite.'
            ], 500);
        }

        return response()->json([
            'message' => 'Datos de consulta guardados correctamente.',
            'id_captura' => $idCaptura
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
            'correo' => 'nullable|string',
            'id_captura' => 'nullable|integer'

        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except([
            '_token',
            'id_solicitud',
            'id_captura',
            'id_captura_frm4',
            'origen'
        ]);

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $this->actualizarPrecargaCampos($idCaptura, [
                'NomP' => $this->limpiarCampoTexto($request->input('nombre')),
                'APaternoP' => $this->limpiarCampoTexto($request->input('apellido_1')),
                'AMaternoP' => $this->limpiarCampoTexto($request->input('apellido_2')),
                'nomPropietario' => $this->construirNombrePropietario($datos),
                'domPropietario' => $this->construirDomicilioPropietario($datos),
                'telPropietario' => $this->limpiarCampoTexto($request->input('telefono')),
                'emailPropietario' => $this->limpiarCampoTexto($request->input('correo')),
            ]);

            $this->guardarCampos($datos['id_solicitud'], 237, array_merge($campos, [
                'id_captura' => (string) $idCaptura
            ]));
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible actualizar la precaptura con los datos del solicitante.'
            ], 500);
        }

        return response()->json([
            'message' => 'Datos del solicitante guardados correctamente.',
            'id_captura' => $idCaptura
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
            'otro_otro' => 'nullable|string',
            'id_captura' => 'nullable|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);
        $campos['mantenimiento'] = $request->input('mantenimiento', []);
        $campos['anuncio'] = $request->input('anuncio', []);
        $campos['otro'] = $request->input('otro', []);

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $selecciones = array_merge(
                $request->input('mantenimiento', []),
                $request->input('anuncio', []),
                $request->input('otro', [])
            );

            $selecciones = array_values(array_filter(array_map(function($valor) {
                return $this->limpiarCampoTexto($valor);
            }, $selecciones)));

            $detalles = [];
            foreach ([
                'gama' => 'Gama',
                'molduras' => 'Molduras',
                'macizo' => 'Macizo',
                'marca_pintura' => 'Marca de pintura',
                'otro_mantenimiento' => 'Otro mantenimiento',
                'dimensiones_toldo' => 'Dimensiones toldo',
                'otro_otro' => 'Otro'
            ] as $campo => $etiqueta) {
                $valor = $this->limpiarCampoTexto($request->input($campo));
                if ($valor !== null) {
                    $detalles[] = $etiqueta . ': ' . $valor;
                }
            }

            $this->actualizarPrecargaCampos($idCaptura, [
                'usoSolicita' => empty($selecciones) ? null : implode(', ', $selecciones)
            ]);

            $this->actualizarSegmentoObservaciones(
                $idCaptura,
                'Adecuaciones',
                empty($detalles) ? null : implode('; ', $detalles)
            );

            $this->guardarCampos($datos['id_solicitud'], 237, array_merge($campos, [
                'id_captura' => (string) $idCaptura
            ]));
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible guardar la información de adecuaciones en la precaptura.'
            ], 500);
        }

        return response()->json([
            'message' => 'Adecuaciones guardadas correctamente.',
            'id_captura' => $idCaptura
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
            'nombre_plaza' => 'nullable|string',
            'id_captura' => 'nullable|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $this->actualizarPrecargaCampos($idCaptura, [
                'longFrente' => $this->limpiarCampoTexto($request->input('dimension_fachada')),
                'niveles' => $this->limpiarCampoTexto($request->input('altura')),
                'giroContruccion' => $this->limpiarCampoTexto(
                    $request->input('giro_comercial') ?: $request->input('tipo')
                ),
                'razonSocial' => $this->limpiarCampoTexto($request->input('razon_social')),
                'numLicConst' => $this->limpiarCampoTexto($request->input('cedula_comercial')),
            ]);

            $this->guardarCampos($datos['id_solicitud'], 238, array_merge($campos, [
                'id_captura' => (string) $idCaptura
            ]));
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible registrar la información del inmueble en la precaptura.'
            ], 500);
        }

        return response()->json([
            'message' => 'Información del inmueble guardada correctamente.',
            'id_captura' => $idCaptura
        ]);
    }

    public function guardarCroquis(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'latitud' => 'required|string',
            'longitud' => 'required|string',
            'id_captura' => 'nullable|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $this->actualizarPrecargaCampos($idCaptura, [
                'coordSitio' => $this->limpiarCampoTexto($datos['latitud']),
                'zoomSitio' => $this->limpiarCampoTexto($datos['longitud'])
            ]);

            $this->guardarCampos($datos['id_solicitud'], 238, [
                'latitud' => $datos['latitud'],
                'longitud' => $datos['longitud'],
                'id_captura' => (string) $idCaptura
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible guardar el croquis en la precaptura.'
            ], 500);
        }

        return response()->json([
            'message' => 'Croquis guardado correctamente.',
            'id_captura' => $idCaptura
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
            'dim_observaciones' => 'nullable|string',
            'id_captura' => 'nullable|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);

        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $altura = $this->limpiarCampoTexto($request->input('dim_altura'));
            $ancho = $this->limpiarCampoTexto($request->input('dim_ancho'));
            $fondo = $this->limpiarCampoTexto($request->input('dim_fondo'));

            $superficie = null;
            if (is_numeric($altura) && is_numeric($ancho)) {
                $superficie = number_format((float) $altura * (float) $ancho, 2, '.', '');
            }

            $resumenDimensiones = [];
            if ($altura !== null) {
                $resumenDimensiones[] = 'Altura: ' . $altura . ' m';
            }
            if ($ancho !== null) {
                $resumenDimensiones[] = 'Ancho: ' . $ancho . ' m';
            }
            if ($fondo !== null) {
                $resumenDimensiones[] = 'Fondo: ' . $fondo . ' m';
            }

            $observacionDimensiones = $this->limpiarCampoTexto($request->input('dim_observaciones'));
            if ($observacionDimensiones !== null) {
                $resumenDimensiones[] = 'Observaciones: ' . $observacionDimensiones;
            }

            $this->actualizarPrecargaCampos($idCaptura, [
                'suRemodelaTxt' => $this->limpiarCampoTexto($request->input('memoria_descriptiva')),
                'superficie' => $superficie,
            ]);

            $this->actualizarSegmentoObservaciones(
                $idCaptura,
                'Dimensiones',
                empty($resumenDimensiones) ? null : implode('; ', $resumenDimensiones)
            );

            $this->guardarCampos($datos['id_solicitud'], 238, array_merge($campos, [
                'id_captura' => (string) $idCaptura
            ]));
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible actualizar la precaptura con la memoria descriptiva.'
            ], 500);
        }

        return response()->json([
            'message' => 'Memoria descriptiva guardada correctamente.',
            'id_captura' => $idCaptura
        ]);
    }

    public function guardarDocumentacion(Request $request)
    {
        $datos = $request->validate([
            'id_solicitud' => 'required|integer',
            'id_captura' => 'nullable|integer'
        ]);

        $this->asegurarSolicitudDelUsuario((int) $datos['id_solicitud']);

        $campos = $request->except(['_token', 'id_solicitud']);
      
        try {
            $idCaptura = $this->obtenerOcrearPrecarga((int) $datos['id_solicitud'], $request->input('id_captura'));

            $archivos = [];
            foreach ($campos as $nombreCampo => $valor) {
                if (strpos($nombreCampo, 'documento_') === 0) {
                    $texto = $this->limpiarCampoTexto($valor);
                    if ($texto !== null) {
                        $archivos[] = $texto;
                    }
                }
            }

            $this->actualizarPrecargaCampos($idCaptura, []);
            $this->actualizarSegmentoObservaciones(
                $idCaptura,
                'Documentación',
                empty($archivos) ? null : implode(', ', $archivos)
            );

            $this->guardarCampos($datos['id_solicitud'], 238, array_merge($campos, [
                'id_captura' => (string) $idCaptura
            ]));
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'No fue posible actualizar la precaptura con la documentación.'
            ], 500);
        }

        return response()->json([
            'message' => 'Documentación registrada correctamente.',
            'id_captura' => $idCaptura
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

    private function obtenerOcrearPrecarga(int $idSolicitud, $idCaptura = null): int
    {
        $tabla = DB::connection('captura_op')->table('Precaptura');

        if ($idCaptura) {
            $registro = $tabla->where('IdCaptura', $idCaptura)->first();

            if ($registro) {
                if (empty($registro->id_solicitud) || (int) $registro->id_solicitud !== $idSolicitud) {
                    $tabla
                        ->where('IdCaptura', $registro->IdCaptura)
                        ->update([
                            'id_solicitud' => $idSolicitud,
                            'fechaModificacion' => DB::raw('GETDATE()')
                        ]);
                }

                return (int) $registro->IdCaptura;
            }
        }

        $registroExistente = $tabla
            ->where('id_solicitud', $idSolicitud)
            ->orderByDesc('IdCaptura')
            ->first();

        if ($registroExistente) {
            return (int) $registroExistente->IdCaptura;
        }

        return (int) $tabla->insertGetId([
            'tipoTramite' => 'Dictaminación Imagen Urbana',
            'fecha' => now(),
            'id_solicitud' => $idSolicitud,
            'EdoAct' => 'Precarga',
            'Usuario' => 'sistema_web'
        ], 'IdCaptura');
    }

    private function actualizarPrecargaCampos(int $idCaptura, array $campos): void
    {
        $datosActualizados = $campos;
        $datosActualizados['fechaModificacion'] = DB::raw('GETDATE()');

        DB::connection('captura_op')
            ->table('Precaptura')
            ->where('IdCaptura', $idCaptura)
            ->update($datosActualizados);
    }

    private function actualizarSegmentoObservaciones(int $idCaptura, string $etiqueta, ?string $contenido): void
    {
        $tabla = DB::connection('captura_op')->table('Precaptura');
        $registro = $tabla
            ->select('observaciones')
            ->where('IdCaptura', $idCaptura)
            ->first();

        $segmentos = [];

        if ($registro && isset($registro->observaciones)) {
            $segmentos = array_filter(array_map('trim', explode('|', (string) $registro->observaciones)));
        }

        $segmentos = array_filter($segmentos, function($segmento) use ($etiqueta) {
            return stripos($segmento, $etiqueta . ':') !== 0;
        });

        if ($contenido !== null && $contenido !== '') {
            $segmentos[] = $etiqueta . ': ' . $contenido;
        }

        $tabla
            ->where('IdCaptura', $idCaptura)
            ->update([
                'observaciones' => implode(' | ', $segmentos),
                'fechaModificacion' => DB::raw('GETDATE()')
            ]);
    }

    private function limpiarCampoTexto($valor): ?string
    {
        if ($valor === null) {
            return null;
        }

        if (is_array($valor)) {
            return null;
        }

        $texto = trim((string) $valor);

        return $texto === '' ? null : $texto;
    }

    private function construirNombrePropietario(array $datos): ?string
    {
        $partes = array_filter([
            $this->limpiarCampoTexto($datos['nombre'] ?? null),
            $this->limpiarCampoTexto($datos['apellido_1'] ?? null),
            $this->limpiarCampoTexto($datos['apellido_2'] ?? null),
        ]);

        if (empty($partes)) {
            return null;
        }

        return implode(' ', $partes);
    }

    private function construirDomicilioPropietario(array $datos): ?string
    {
        $componentes = [
            $datos['domicilio'] ?? null,
            $datos['no_oficial'] ?? null,
            $datos['interior'] ?? null,
            $datos['colonia'] ?? null,
            $datos['manzana'] ?? null,
            $datos['lote'] ?? null,
        ];

        $limpios = array_filter(array_map(function($valor) {
            return $this->limpiarCampoTexto($valor);
        }, $componentes));

        if (empty($limpios)) {
            return null;
        }

        return implode(' ', $limpios);
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
