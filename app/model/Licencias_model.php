<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Licencias_model extends Model
{


    public static function get_plazas()
    {

        $sql = "SELECT * FROM PLAZAS WHERE NOMBREPLAZA IS NOT NULL ORDER BY NOMBREPLAZA ASC";

        return DB::connection('pyl')->select($sql);
    }

    public static function get_giros()
    {
        $sql = "SELECT g.* FROM Giros g WHERE g.tipoGiro in('A','B','C')  order by g.nombre";


        return DB::connection('pyl')->select($sql);
    }

    public static function get_anuncios()
    {
        $sql = "SELECT g.* FROM Giros g WHERE g.anuncio = 1 and (g.nombre= 'ANUNCIO SIN ESTRUCTURA OPACO' or g.nombre='ANUNCIO SIN ESTRUCTURA LUMINOSO') order by g.nombre";

        return DB::connection('pyl')->select($sql);
    }

    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            $result = Solicitudes_model::consulta_ultimo_folio(7);
            $folio = $result[0]->folio;
        } else {

            $id_revisor = Solicitudes_model::balanza(41);

            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 7,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   => 40,
                'estatus'    => 'pendiente',
                'id_revisor' => $id_revisor
            ], 'id_solicitud');

            $data = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_revisor'    => $id_revisor,
                'id_tramite'    => 7,
                'id_etapa'      => 40,
                'estatus'       => 'pendiente',

            ];

            DB::table('solicitudes_hist')
                ->insert($data);
        }

        session(['lastpage' => __FILE__]);


        return $folio;
    }

    public static function ingresa_solicitud_pyl($request)
    {
        $sql = "EXECUTE sp_GuardarPrecapturaLicFuncionamiento
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?";

        if ($request->tipo_persona == 'F') {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = $request->apellido_paterno;
            $apellido_materno = (($request->apellido_materno == null) ? '' : $request->apellido_materno);
        } else {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = '';
            $apellido_materno = '';
        }

        $no_exterior = (($request->no_exterior != null) ? $request->no_exterior : '') . (($request->letra_exterior != null) ? $request->letra_exterior : '');
        $no_interior = (($request->no_interior != null) ? $request->no_interior : '') . (($request->letra_interior != null) ? $request->letra_interior : '');

        $domicilio = $request->calle . " " . $no_exterior . " " . $no_interior . " " . $request->colonia . ", " . $request->municipio;

        $no_exterior_negocio = (($request->no_exterior_negocio != null) ? $request->no_exterior_negocio : '') . (($request->letra_exterior_negocio != null) ? $request->letra_exterior_negocio : '');
        $no_interior_negocio = (($request->no_interior_negocio != null) ? $request->no_interior_negocio : '') . (($request->letra_interior_negocio != null) ? $request->letra_interior_negocio : '');

        $curp = (($request->curp != null) ? $request->curp : '');
        $plaza_negocio = (($request->plaza_negocio != null) ? $request->plaza_negocio : '');

        $fecha_inicio = str_replace("-", "", $request->fecha_inicio);

        $params = array(
            $nombreSolicitante, $request->rfc, $domicilio, $request->colonia, $request->calle1, $request->calle2, $request->municipio, $request->telefono, $request->cp,
            $request->correo, $request->nombre_negocio, $request->actividad_negocio, $request->calle_negocio, $no_exterior_negocio, $no_interior_negocio,
            $request->colonia_negocio, $request->cp_negocio, $request->sup_negocio, $request->cajones_negocio, $request->niveles_negocio, $request->inversion_negocio,
            $request->empleos_negocio, $request->calle3_negocio, $curp, $request->calle, $no_exterior, $no_interior, $apellido_paterno,
            $apellido_materno, $request->tipo_persona, $request->telefono_negocio, $request->curt, $request->cuenta, $fecha_inicio, $plaza_negocio,
            $request->id_solicitud, $request->calle1_negocio, $request->calle2_negocio
        );

        $result = DB::connection('pyl')->select($sql, $params);
        return $result;
    }

    public static function guarda_giro_precaptura($request)
    {
        $query = "execute sp_GuardaGiroPrecapturaVDigital ?,?,?,?,?,?";

        $params = array(
            $request->id_folio, $request->giro, $request->giro2, $request->giro3,
            $request->giro4, $request->giro5
        );

        return DB::connection('pyl')->select($query, $params);
    }

    public static function actualiza_solicitud_pyl($request)
    {
        $sql = "EXECUTE sp_ActualizaPrecapturaLicFuncionamiento
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?";

        if ($request->tipo_persona == 'F') {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = $request->apellido_paterno;
            $apellido_materno = (($request->apellido_materno == null) ? '' : $request->apellido_materno);
        } else {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = '';
            $apellido_materno = '';
        }

        $no_exterior = (($request->no_exterior != null) ? $request->no_exterior : '') . (($request->letra_exterior != null) ? $request->letra_exterior : '');
        $no_interior = (($request->no_interior != null) ? $request->no_interior : '') . (($request->letra_interior != null) ? $request->letra_interior : '');

        $domicilio = $request->calle . " " . $no_exterior . " " . $no_interior . " " . $request->colonia . ", " . $request->municipio;

        $no_exterior_negocio = (($request->no_exterior_negocio != null) ? $request->no_exterior_negocio : '') . (($request->letra_exterior_negocio != null) ? $request->letra_exterior_negocio : '');
        $no_interior_negocio = (($request->no_interior_negocio != null) ? $request->no_interior_negocio : '') . (($request->letra_interior_negocio != null) ? $request->letra_interior_negocio : '');

        $curp = (($request->curp != null) ? $request->curp : '');
        $plaza_negocio = (($request->plaza_negocio != null) ? $request->plaza_negocio : '');

        $fecha_inicio = str_replace("-", "", $request->fecha_inicio);

        $params = array(
            $nombreSolicitante, $request->rfc, $domicilio, $request->colonia, $request->calle1, $request->calle2, $request->municipio, $request->telefono, $request->cp,
            $request->correo, $request->nombre_negocio, $request->actividad_negocio, $request->calle_negocio, $no_exterior_negocio, $no_interior_negocio,
            $request->colonia_negocio, $request->cp_negocio, $request->sup_negocio, $request->cajones_negocio, $request->niveles_negocio, $request->inversion_negocio,
            $request->empleos_negocio, $request->calle3_negocio, $curp, $request->calle, $no_exterior, $no_interior, $apellido_paterno,
            $apellido_materno, $request->tipo_persona, $request->telefono_negocio, $request->curt, $request->cuenta, $fecha_inicio, $plaza_negocio,
            $request->id_solicitud, $request->calle1_negocio, $request->calle2_negocio, $request->id_folio
        );

        $result = DB::connection('pyl')->select($sql, $params);
        return $result;
    }

    public static function ingresa_solicitud_uso_suelo($request)
    {

        $sql = "EXECUTE sp_GuardarUsoSueloVdgitial
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?,?,?,
                    ?,?,?";


        if ($request->tipo_persona == 'F') {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = $request->apellido_paterno;
            $apellido_materno = (($request->apellido_materno == null) ? '' : $request->apellido_materno);
        } else {
            $nombreSolicitante = $request->nombre;
            $apellido_paterno = '';
            $apellido_materno = '';
        }

        $no_exterior_negocio = (($request->no_exterior_negocio != null) ? $request->no_exterior_negocio : '') . (($request->letra_exterior_negocio != null) ? $request->letra_exterior_negocio : '');
        $no_interior_negocio = (($request->no_interior_negocio != null) ? $request->no_interior_negocio : '') . (($request->letra_interior_negocio != null) ? $request->letra_interior_negocio : '');


        $params = array(
            $nombreSolicitante, $request->calle_negocio, $no_exterior_negocio, $no_interior_negocio, $request->colonia_negocio,
            $request->sup_negocio, $request->calle3_negocio,  $apellido_paterno, $apellido_materno, $request->id_solicitud,
            $request->calle1_negocio, $request->calle2_negocio, $request->giro, $request->cuenta, $request->curt,
            $request->plaza_negocio, session('id_usuario'), $request->tipo_persona
        );

        $result = DB::connection('pyl')->select($sql, $params);
        return $result;
    }



    /* Revisor */

    public static function get_by_id($id_solicitud)
    {

        $datos = DB::table('datos_solicitudes')
            ->select('id_tramite')
            ->where('id_solicitud', $id_solicitud)
            ->first();

        $solicitud = DB::table('solicitudes as s')
            ->select('s.id_solicitud as folio', 's.update_at as fecha', 's.estatus as status', '*')
            ->join('datos_personales as dp', 'dp.id_usuario', '=', 's.id_usuario')
            ->join('usuarios as u', 'u.id_usuario', '=', 's.id_usuario')
            ->join('cat_tramites as ct', 'ct.id_tramite', '=', 's.id_tramite')
            ->join('cat_coordinaciones as cc', 'cc.id_coordinacion', '=', 'ct.id_coordinacion')
            ->where('s.id_solicitud', '=', $id_solicitud)
            ->first();

        $datos = DB::table('datos_solicitudes')
            ->where('id_solicitud', $id_solicitud)
            ->get();

        $revisor = DB::table('datos_personales as d')
            ->join('solicitudes as s', 's.id_revisor', '=', 'd.id_usuario')
            ->where('s.id_solicitud', '=', $id_solicitud)
            ->first();

        $datos_solicitud = [];

        foreach ($datos as $value) {
            $datos_solicitud += [$value->campo => $value->dato];
        }

        return [
            'solicitud' => $solicitud,
            'datos'     => $datos_solicitud,
            'giros'     => Licencias_model::get_giros(),
            'calles'    => Prelicencias_model::get_calles(),
            'colonias'  => Prelicencias_model::get_colonias(),
            'plazas'    => Licencias_model::get_plazas(),
            'revisor'   => $revisor,
        ];
    }

    /* Fin revisor */
}
