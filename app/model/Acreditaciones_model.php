<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;

class Acreditaciones_model extends Model
{
    public static function solicitud()
    {

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            $result = Solicitudes_model::consulta_ultimo_folio(3);
            $folio = $result[0]->folio;
        } else {

            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 3,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  7,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  Solicitudes_model::balanza(10)
            ], 'id_solicitud');
        }
        session(['lastpage' => __FILE__]);

        return $folio;
    }


    /**
     * Obtiene toda la información que necesita el 
     * revisor
     */


    public static function get_by_id($id_solicitud)
    {

        $solicitud =  DB::table('solicitudes as s')
            ->select('s.id_solicitud as folio', 's.update_at as fecha', 's.estatus as status', '*')
            ->join('datos_personales as dp', 'dp.id_usuario', '=', 's.id_usuario')
            ->join('archivos as a', 'a.id_usuario', '=', 's.id_usuario')
            ->join('cat_archivos_acreditacion as ca', 'ca.id_archivo', '=', 'a.id_cat_archivo')
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

        $archivos = DB::table('archivos as a')
            ->select('a.nombre as archivo', 'ca.nombre as nombre', '*')
            ->join('cat_archivos_acreditacion as ca', 'ca.id_archivo', '=', 'a.id_cat_archivo')
            ->where('a.id_usuario', $solicitud->id_usuario)
            ->where('a.id_solicitud', $id_solicitud)
            ->get();

        return [
            'solicitud' => $solicitud,
            'datos'     => $datos_solicitud,
            'archivos'  => $archivos,
            'revisor'   => $revisor
        ];
    }


    public static function get_acreditaciones_previas($folio_expediente, $curp)
    {

        if (strlen($folio_expediente) > 0 && $folio_expediente != "") {
            $sql = "SELECT * FROM consulta_folio_ac(?);";
            $result = DB::connection('acreditaciones')->select($sql, array($folio_expediente));
            if (!$result && strlen($curp) == 18) {
                $sql = "SELECT id_acreditacion, tipo_acreditacion, folio_venanilla_unica, nombre,
                paterno, materno, correo_electronico, placa, curp, fecha_inicio, fecha_fin, fecha_solicitud, fecha_registro, folio_expediente, usuario_captura, telefono, pertenece_empresa, es_arrendado, pertenece_conyugue, trasladado, es_propio, token_qr, 
                case 
                when fecha_fin<current_date then 2
                when fecha_fin>=current_date then 1
                else estatus_acreditacion end as estatus, 
                acreditacion_previa, observaciones, tarjeta_circulacion, licencia, identificacion, insen, credencial_discapacidad, responsiva,
                 acta_nacimiento, acta_matrimonio, factura, constancia_medica, acta_constitutiva, usuario_temp, propiedad_vehiculo, menor_edad,
                  parentezco_acreditado, folio_acreditacion, curp_impresa, placa2, placa3, sistema, nuevo, oficina  FROM acreditaciones ac where 
                  trim(both from replace(replace(ac.curp,'-',''),' ','') )=trim(both from replace(replace(?,'-',''),' ','')) ;";

                $result = DB::connection('acreditaciones')->select($sql, array($curp));
            }
        } elseif (strlen($curp) == 18) {
            $sql = "SELECT id_acreditacion, tipo_acreditacion, folio_venanilla_unica, nombre,
             paterno, materno, correo_electronico, placa, curp, fecha_inicio, fecha_fin, fecha_solicitud, fecha_registro, folio_expediente, usuario_captura, telefono, pertenece_empresa, es_arrendado, pertenece_conyugue, trasladado, es_propio, token_qr, 
             case 
             when fecha_fin<current_date then 2
             when fecha_fin>=current_date then 1
             else estatus_acreditacion end as estatus, acreditacion_previa, observaciones, 
             tarjeta_circulacion, licencia, identificacion, insen, credencial_discapacidad, 
             responsiva, acta_nacimiento, acta_matrimonio, factura, constancia_medica, acta_constitutiva, usuario_temp,
              propiedad_vehiculo, menor_edad, parentezco_acreditado, folio_acreditacion, curp_impresa, placa2, placa3, sistema, nuevo, oficina 
               FROM acreditaciones ac where trim(both from replace(replace(ac.curp,'-',''),' ','') )=trim(both from replace(replace(?,'-',''),' ','')) ;";

            $result = DB::connection('acreditaciones')->select($sql, array($curp));
        } else
            $result = false;
        return $result;
    }

    public static function ingresa_solicitud($request)
    {


        $sql = "SELECT * from inserta_solicitud_ac( 
                 ?, ?, ?, ?, ?, ?, ?, ?,
                 ?, ?, ?, ?, ?, ?, ?, ?,
                 ?, ?);";

        $params = array(
            $request->tipo_acreditacion, $request->id_solicitud, $request->nombre, $request->paterno,
            $request->materno, $request->correo_electronico, str_replace(" ", "", strtoupper($request->placa)), strtoupper($request->curp),
            session('correo'), $request->telefono, $request->trasladado, $request->propiedad_vehiculo,
            $request->menor_edad, (($request->parentezco_acreditado == null) ? '' : $request->parentezco_acreditado), $request->id_acreditacion, $request->tipo_tramite,
            str_replace(" ", "", strtoupper($request->placa2)), str_replace(" ", "", strtoupper($request->placa3))

        );

        $result = DB::connection('acreditaciones')->select($sql, $params);
        //var_dump($result);
        return $result;
    }


    public static function actualiza_solicitud_ac($request)
    {
        $sql = "SELECT * from actualiza_solicitud_ac( 
                 ?, ?, ?, ?, ?, ?, ?, ?,
                 ?, ?, ?, ?, ?, ?, ?, ?,
                 ?, ?, ?, ? );";

        $params = array(
            $request->tipo_acreditacion, $request->id_solicitud, $request->nombre, $request->paterno,
            $request->materno, $request->correo_electronico, str_replace(" ", "", strtoupper($request->placa)), strtoupper($request->curp),
            session('correo'), $request->telefono, $request->trasladado, $request->propiedad_vehiculo,
            $request->menor_edad, (($request->parentezco_acreditado == null) ? '' : $request->parentezco_acreditado),
            $request->id_acreditacion, $request->tipo_tramite, $request->id_solicitud_ac, $request->folio_expediente,
            str_replace(" ", "", strtoupper($request->placa2)), str_replace(" ", "", strtoupper($request->placa3))
        );

        $result = DB::connection('acreditaciones')->select($sql, $params);

        return $result;
    }
    public static function inserta_requisito_ac($id_solicitud, $id_documento, $filename, $ext)
    {
        $sql = "INSERT INTO archivos(id_usuario,id_cat_archivo,nombre,extension,created_at,id_solicitud) 
        VALUES(?,?,?,?, current_timestamp,?);";

        $params = array(session('id_usuario'), $id_documento, $filename, $ext, $id_solicitud);
        $result = DB::connection()->insert($sql, $params);

        return $result;
    }

    public static function consulta_requisitos($request)
    {

        /*$sql_traslado = "";
        $sql_propiedad = "";
        $sql_menor_edad = "";
        if ($request->tipo_acreditacion == 1) {

            $sql = "select * from cat_archivos_acreditacion caa 
            where caa.ac_tercera_edad =1";
        } else if ($request->tipo_acreditacion == 2) {
            $sql = "select * from cat_archivos_acreditacion caa 
            where caa.ac_embarazo =1";
        } else if ($request->tipo_acreditacion == 3) {
            $sql = "select * from cat_archivos_acreditacion caa 
            where caa.ac_discapacidad_permanente =1";
        } else if ($request->tipo_acreditacion == 4) {
            $sql = "select * from cat_archivos_acreditacion caa 
            where  caa.ac_discapacidad_temporal =1";
        }
        $sql = $sql . " and caa.id_archivo not in(select a.id_cat_archivo from archivos
        a where a.id_usuario=" . session('id_usuario') . " and id_solicitud=" . $request->id_solicitud . ") ";
        $sql_traslado = $sql;
        $sql_menor_edad = $sql;
        $sql_propiedad = $sql;

        $sql = $sql . " and caa.menor_edad is null
            and caa.traslado is null and caa.propiedad is null ";

        if ($request->trasladado == "1") {
            $sql_traslado = " union " . $sql_traslado . " and caa.traslado=1";
        } else {
            $sql_traslado = " union " . $sql_traslado . " and caa.traslado=0";
        }
        if ($request->menor_edad == "1") {
            $sql_menor_edad = " union " . $sql_menor_edad . " and caa.menor_edad=1";
        } else {
            $sql_menor_edad = "";
        }

        if (intval($request->propiedad_vehiculo) > 1) {
            $sql_propiedad = " union " . $sql_propiedad . " and caa.propiedad=" . $request->propiedad_vehiculo;
        } else {
            $sql_propiedad = "";
        }

        $sql_ac = $sql . $sql_traslado . $sql_menor_edad . $sql_propiedad;*/
        if ($request->placa2 !== null && strlen($request->placa2) >= 3)
            $placa2 = 1;
        else
            $placa2 = 0;
        if ($request->placa3 !== null && strlen($request->placa3) >= 3)
            $placa3 = 1;
        else
            $placa3 = 0;

        $sql_ac = "select * from consulta_requisitos_acreditaciones(?, ?, ?, ?, ?, ?, ?, ?);";
        $result = DB::connection()->select($sql_ac, array(
            $request->tipo_acreditacion,
            $request->trasladado, $request->propiedad_vehiculo, $request->menor_edad, session('id_usuario'),
            $request->id_solicitud, $placa2, $placa3
        ));
        return $result;
    }
    /**
     * Obtiene todos los archivos del tramite y del usuario
     * logeado
     */

    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')

            ->join('cat_archivos_acreditacion as c', 'a.id_cat_archivo', '=', 'c.id_archivo')
            ->select('a.nombre as archivo', '*')
            ->where('a.id_usuario', '=', session('id_usuario'))
            ->where('a.id_solicitud', '=', $id_solicitud)
            ->get();


        /*$pendientes = DB::select('SELECT * FROM cat_archivos_acreditacion as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
        WHERE c.id_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '
        and a.id_usuario =' . session('id_usuario') . '
        )');*/

        return [
            'terminados'  => $terminados
            //'pendientes'  => $pendientes
        ];
    }

    public static function notifica($request, $titulo, $mensaje, $correo)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => 10,
            'estatus'       => 'en revision',

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);


        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => 2,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje,
        ];

        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            //Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_movilidad.png'));



            //Cambiamos el estatus de la solicitud 
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 10, 'estatus' => 'en revision']);
        } else {
            return false;
        }
    }

    public static function acepta_solicitud_ac($request)
    {
        $sql = "SELECT * from acepta_solicitud_ac( 
                 ?,  ?, ? );";

        $params = array(
            $request['id_solicitud_ac'], session('correo'), $request['vigencia']
        );

        $result = DB::connection('acreditaciones')->select($sql, $params);

        return $result;
    }

    public static function consulta_acreditacion_qr($id_solicitud)
    {

        $params = array($id_solicitud);
        $sql = "select * from acreditacion_id_ventanilla(?);";
        $result = DB::connection('acreditaciones')->select($sql, $params);

        return $result;
    }
}
