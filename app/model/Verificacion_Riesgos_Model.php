<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\model\Solicitudes_model;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;
use Psy\VersionUpdater\IntervalChecker;

class Verificacion_Riesgos_Model extends Model
{
    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {
            $result = Solicitudes_model::consulta_ultimo_folio(29);
            $folio = $result[0]->folio;
        } else {
            $id_revisor = Solicitudes_model::balanza(65);
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 29,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  177,
                'estatus'    =>  'pendiente',
                //'id_revisor' =>  $id_revisor
            ], 'id_solicitud');

            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
             //   'id_revisor'    => $id_revisor,
                'id_tramite'    => 29,
                'id_etapa'      => 177,
                'estatus'       => 'pendiente',

            ];

            DB::table('solicitudes_hist')
                ->insert($data1);
        }

        session(['lastpage' => __FILE__]);


        return $folio;
    }

    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 12],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])

            ->get();

        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga,
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '
            and a.id_usuario =' . session('id_usuario') . '
            ) and c.id_documento>0 and c.id_tramite = 12');

        //$resv = Dictamen_finca_antigua_model::consulta_requisitos_validados($id_solicitud);
        $resv = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga,
        c.id_documento,c.obligatorio FROM
        cat_archivo c join archivos a on c.id_cat_archivo =a.id_cat_archivo
        join archivosodt ao  on ao.id_archivo =a.id_archivo
        where a.id_solicitud =' . $id_solicitud . ' and a.id_usuario =' . session('id_usuario') . ' and ao.estatus=\'validado\'');

        $validados = array();

        foreach ($resv as $validado) {
            array_push($validados, $validado->id_documento);
        }


        return [
            'terminados'  => $terminados,
            'pendientes'  => $pendientes,
            'validados'  => $validados
        ];
        //$sql ="execute tw_consulta_requisitos ?,?"

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

    public static function consulta_requisitos_validados($id_solicitud)
    {
        $sql = "SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga,
        c.id_documento,c.obligatorio,ao.* FROM   cat_archivo c join archivos a
        on c.id_cat_archivo =a.id_cat_archivo join archivosodt ao  on ao.id_archivo =a.id_archivo
        where a.id_solicitud =" . $id_solicitud . " and a.id_usuario =" . session('id_usuario') . "
        and ao.estatus='validado'";
        $result = DB::select($sql, [$id_solicitud]);
        return $result;
    }

    public static function ingresa_solicitud($request)
    {


        $sql = "EXECUTE proteccion_verificacion_inserta
        ?,?,?,?,?,
        ?,?,?,?,?";

        if ($request->giro_comercio != null) {
            $giro = $request->giro_comercio;
        } else {
            $giro = '-';
        }
        if ($request->razonSocial != null) {
            $razon = $request->razonSocial;
        } else {
            $razon = '-';
        }

        $params = array(
            $request->nombre  ?? '-',
            $request->apellido_1 ?? '-',
            $request->apellido_2 ?? '-',
            $request->telefono ?? '-',
            $request->correo ?? '-',
            $request->personaJ ?? '-',
            $request->giro_comercio ?? '-',
            $request->razonSocial ?? '-',
            session('id_usuario') ?? '-',
            intval($request->id_solicitud)  ?? 1,
        );

        $result = DB::connection('captura_op')->select($sql, $params);
        return $result[0]->idcaptura;
    }

    //SP de el primer actualiza card
    public static function actualiza_solicitud($request)
    {

        $sql = "EXECUTE proteccion_verificacion_actualiza
        ?,?,?,?,?,
        ?,?,?,?,?";

        if ($request->giro_comercio != null) {
            $giro = $request->giro_comercio;
        } else {
            $giro = '-';
        }
        if ($request->razonSocial != null) {
            $razon = $request->razonSocial;
        } else {
            $razon = '-';
        }


        $params = array(
            $request->nombre  ?? '-',
            $request->apellido_1 ?? '-',
            $request->apellido_2 ?? '-',
            $request->telefono ?? '-',
            $request->correo ?? '-',
            $request->personaJ ?? '-',
            $request->giro_comercio ?? '-',
            $request->razonSocial ?? '-',
            session('id_usuario') ?? '-',
            $request->id_captura ?? '-',
        );



        return DB::connection('captura_op')->select($sql, $params);

    }


    //Segundo actualiza sp para actualizar y ahcer insert a los datos de verificacion
    public static function actualiza_solicitud_2($request)
    {
        dd($request);

        $sql = "EXECUTE proteccion_verificacion_actualiza_2
        ?,?,?,?,?,
        ?,?,?,?,?";

        $params = array(
            $request-> domicilio  ?? '-',
            $request-> numero  ?? '-',
            $request-> entreCalle_1 ?? '-',
            $request-> entreCalle_2 ?? '-',
            $request-> colonia ?? '-',
            $request-> municipio ?? '-',
            $request-> problematica ?? '-',
            session('id_usuario') ?? '-',
            $request->id_captura ?? '-',
        );

        return DB::connection('captura_op')->select($sql, $params);
    }


    public static function consulta_archivos_faltantes($id_solicitud)
    {
        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga,
        c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a
        WHERE c.id_cat_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '
        and a.id_usuario =' . session('id_usuario') . '
        ) and c.id_documento>0 and c.obligatorio=1 and c.id_tramite = 12');
        return $pendientes;
    }

    public static function  actualiza_edo_act($id_captura, $ing)
    {

        //$sql = "UPDATE capturaweb.dbo.PRECAPTURA SET edoact=1,ing=? where IdCaptura=?";
        $sql = "EXECUTE tw_ingresa_precaptura ?";


        $params = array($id_captura);
        $result = DB::connection('tramites_op')->select($sql, $params);

        return $result;
    }

    public static function notifica($request, $titulo, $mensaje, $correo)
    {

        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => 4,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje
        ];

        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo->cc(env('MAIL_CC'))
            Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_ord.png'));

            //Cambiamos el estatus de la solicitud

            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 68, 'estatus' => 'en revision']);
        } else {
            return false;
        }
    }
}
