<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;


class Capacitaciones_Model extends Model
{
    use HasFactory;

    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {
            $result = Solicitudes_model::consulta_ultimo_folio(12);
            $folio = $result[0]->folio;
        } else {
            $id_revisor = Solicitudes_model::balanza(65);
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 12,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  65,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  $id_revisor
            ], 'id_solicitud');

            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_revisor'    => $id_revisor,
                'id_tramite'    => 12,
                'id_etapa'      => 65,
                'estatus'       => 'pendiente',

            ];

            DB::table('solicitudes_hist')
                ->insert($data1);
        }

        session(['lastpage' => __FILE__]);


        return $folio;
    }

    public static function ingresa_solicitud($request)
    {
        $sql = "EXECUTE dfa_inserta_dictfinca ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?
        ,?,?,?";

        if (session('tipo_persona') == "fisica") {
            $tipo_persona = "F";
        } else {
            $tipo_persona = "M";
        }

        if ($request->interior) {
            $numero = $request->numero . " " . $request->interior;
        } else {
            $numero = $request->numero;
        }

        $params = array(
            $request->calle, $numero, $request->fraccionamiento, $request->manzana, $request->lote, $request->condominio,
            $request->calle_1, $request->calle_2, $request->cuenta,
            $request->nombre, $request->apellido_p, $request->apellido_m, $request->domicilio, $request->telefono, $request->correo_propietario,
            session('id_usuario'), $request->nombre, $request->apellido_p, $request->apellido_m, $request->id_solicitud, $tipo_persona, $request->correo, $request->tipo_tramite
        );

        $result = DB::connection('captura_op')->select($sql, $params);

        return $result;
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
