<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DAIUController extends Controller
{
    /**
     * Muestra la vista principal del wizard DAIU (card 1 visible).
     */
    public function solicitud()
    {
        return view('daiu.solicitud');  // resources/views/daiu/solicitud.blade.php
    }

    /**
     * Paso 1 (AJAX): consulta Cuenta Predial o CURT usando SP.
     */
    public function consultaCuenta(Request $request)
    {
        $request->validate([
            'cuenta' => 'required|string',
        ]);

        // Ajusta el nombre del SP y la conexión si tuvieras otra
        $params = [
            'cuenta' => $request->cuenta,
        ];
        $predio = DB::selectOne('EXEC sp_ConsultarPredialCurt :cuenta', $params);

        if (!$predio) {
            return response()->json([
                'error' => 'No se encontró la cuenta predial o CURT.'
            ], 404);
        }

        // Mapea los campos del SP a las keys que usarás en la Card 2
        return response()->json([
            'nombre'           => $predio->Nombre,
            'apellido_paterno' => $predio->ApellidoPaterno,
            'apellido_materno' => $predio->ApellidoMaterno,
            'domicilio'        => $predio->Domicilio,
            'numero_oficial'   => $predio->NumeroOficial,
            'numero_interior'  => $predio->Interior,
            'entre_calle_1'    => $predio->EntreCalle1,
            'entre_calle_2'    => $predio->EntreCalle2,
            'colonia'          => $predio->Colonia,
            'manzana'          => $predio->Manzana,
            'lote'             => $predio->Lote,
            'telefono'         => $predio->Telefono,
            'correo'           => $predio->Email,
        ]);
    }

    /**
     * Paso final: guarda todo el trámite DAIU mediante SP.
     */
    public function store(Request $request)
    {
        // Valida todos los campos de los 8 pasos
        $data = $request->validate([
            'cuenta_predial'      => 'required_without:curt|string',
            'curt'                => 'required_without:cuenta_predial|string',
            'nombre'              => 'required|string',
            'apellido_paterno'    => 'required|string',
            'apellido_materno'    => 'nullable|string',
            'domicilio'           => 'required|string',
            'numero_oficial'      => 'nullable|string',
            'numero_interior'     => 'nullable|string',
            'entre_calle_1'       => 'nullable|string',
            'entre_calle_2'       => 'nullable|string',
            'colonia'             => 'required|string',
            'manzana'             => 'nullable|string',
            'lote'                => 'nullable|string',
            'telefono'            => 'nullable|string',
            'correo'              => 'nullable|email',
            'adecuacion'          => 'nullable|string',
            'info_inmueble'       => 'nullable|string',
            'latitud'             => 'nullable|numeric',
            'longitud'            => 'nullable|numeric',
            'memoria_descriptiva' => 'nullable|string',
            'dimensiones_fachada' => 'nullable|string',
            'documentos.*'        => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        // Si hay archivos adjuntos, guárdalos y arma un JSON con rutas
        $rutasDocs = [];
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $rutasDocs[] = $file->store('daiu_docs');
            }
        }
        $jsonDocs = json_encode($rutasDocs, JSON_UNESCAPED_UNICODE);

        // Prepara parámetros para tu SP de inserción
        $params = [
            'cuenta_predial'      => $data['cuenta_predial'] ?? null,
            'curt'                => $data['curt'] ?? null,
            'nombre'              => $data['nombre'],
            'apellido_paterno'    => $data['apellido_paterno'],
            'apellido_materno'    => $data['apellido_materno'],
            'domicilio'           => $data['domicilio'],
            'numero_oficial'      => $data['numero_oficial'],
            'numero_interior'     => $data['numero_interior'],
            'entre_calle_1'       => $data['entre_calle_1'],
            'entre_calle_2'       => $data['entre_calle_2'],
            'colonia'             => $data['colonia'],
            'manzana'             => $data['manzana'],
            'lote'                => $data['lote'],
            'telefono'            => $data['telefono'],
            'correo'              => $data['correo'],
            'adecuacion'          => $data['adecuacion'],
            'info_inmueble'       => $data['info_inmueble'],
            'latitud'             => $data['latitud'],
            'longitud'            => $data['longitud'],
            'memoria_descriptiva' => $data['memoria_descriptiva'],
            'dimensiones_fachada' => $data['dimensiones_fachada'],
            'documentos_json'     => $jsonDocs,
        ];

        // Ejecuta tu SP de inserción (ajusta nombre de SP y placeholders)
        DB::statement(
            'EXEC sp_InsertarDAIU
                :cuenta_predial, :curt, :nombre, :apellido_paterno, :apellido_materno,
                :domicilio, :numero_oficial, :numero_interior, :entre_calle_1,
                :entre_calle_2, :colonia, :manzana, :lote, :telefono, :correo,
                :adecuacion, :info_inmueble, :latitud, :longitud,
                :memoria_descriptiva, :dimensiones_fachada, :documentos_json',
            $params
        );

        return redirect()
            ->route('daiu.solicitud')
            ->with('status', '¡Tu trámite DAIU se ha registrado correctamente!');
    }
}
