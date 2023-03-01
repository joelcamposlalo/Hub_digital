<?php

namespace App\model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;

class Dictamen_trazos_usos_model extends Model
{

    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 11],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])
            /*->orWhere([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.universal', '=', true],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.id_documento', '>', 0]
            ])*/
            ->orderBy('c.obligatorio', 'DESC')
            ->get();

        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
        c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
        WHERE c.id_cat_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '         
        and a.id_usuario =' . session('id_usuario') . '
        ) and c.id_documento>0 and c.id_tramite = 11 ');

        $resv = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
        c.id_documento,c.obligatorio FROM         
        cat_archivo c join archivos a on c.id_cat_archivo =a.id_cat_archivo 
join archivosodt ao  on ao.id_archivo =a.id_archivo 
where a.id_solicitud =' . $id_solicitud . ' and a.id_usuario =' . session('id_usuario') . ' and ao.estatus=\'validado\'');

        //$resv = Dictamen_trazos_usos_model::consulta_requisitos_validados($id_solicitud);

        $validados = array();

        foreach ($resv as $validado) {
            array_push($validados, $validado->id_documento);
        }

        return [
            'terminados'  => $terminados,
            'pendientes'  => $pendientes,
            'validados'   => $validados
        ];
    }

    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');
        $folio = 0;
        $result = null;
        if (session('lastpage') !== null && session('lastpage') == __FILE__) {
            $result = Solicitudes_model::consulta_ultimo_folio(11);
            $folio = $result[0]->folio;
        } else {
            $id_revisor = Solicitudes_model::balanza(60);
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 11,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  60,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  $id_revisor
            ], 'id_solicitud');

            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_revisor'    => $id_revisor,
                'id_tramite'    => 11,
                'id_etapa'      => 60,
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
        $sql = "EXECUTE dtud_inserta_dictud ?,?,?,?,?,
                ?,?,?,?,?,
                ?,?,?,?,?,
                ?,?,?,?,?,
                ?,?,?,?,?,
                ?,?,?";

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
            $request->calle, $numero, $request->fraccionamiento, $request->manzana, $request->lote,
            $request->condominio,  $request->calle_1, $request->calle_2, $request->calle_3, $request->giro,
            $request->observaciones, $request->superficie, $request->largo, $request->ancho, $request->esquina,
            $request->nombre, $request->apellido_p, $request->apellido_m, $request->domicilio, $request->telefono,
            $request->correo_propietario, session('id_usuario'), $request->nombre, $request->apellido_p, $request->apellido_m,
            $request->id_solicitud, $tipo_persona, $request->correo
        );


        $result = DB::connection('captura_op')->select($sql, $params);

        return $result;
    }


    public static function actualiza_solicitud_dtu($request)
    {

        $sql = "EXECUTE dtu_actualiza_dictud ?,?,?,?,?
                ,?,?,?,?,?
                ,?,?,?,?,?
                ,?,?,?,?,?
                ,?,?,?,?,?
                ,?,?,?";



        if ($request->interior) {
            $numero = $request->numero . " " . $request->interior;
        } else {
            $numero = $request->numero;
        }
        $params = array(
            $request->calle, $numero, $request->fraccionamiento, $request->manzana, $request->lote,
            $request->condominio, $request->calle_1, $request->calle_2, $request->calle_3, $request->giro,
            $request->observaciones, $request->superficie, $request->largo, $request->ancho, $request->esquina,
            $request->nombre, $request->apellido_p, $request->apellido_m, $request->domicilio, $request->telefono,
            $request->correo_propietario, session('id_usuario'), $request->nombre, $request->apellido_p, $request->apellido_m,
            $request->id_solicitud, $request->id_captura, $request->correo
        );


        $result = DB::connection('captura_op')->select($sql, $params);
     
        return $result;
    }

    public static function cancela_solicitud_dtu($id_captura)
    {
        $sql = "EXECUTE dtu_cancela_dictamen ?";
        $params = array($id_captura);
        $result = DB::connection('captura_op')->select($sql, $params);
        return $result;
    }



    public static function actualiza_edo_act($id_captura, $ing)
    {

        $sql = "EXECUTE capturaweb.dbo.tw_ingresa_precaptura ?";

        $params = array(
            $id_captura
        );

        $result = DB::connection('tramites_op')->select($sql, $params);

        return $result;
    }


    public static function consulta_archivos_faltantes($id_solicitud)
    {
        return DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
        c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
        WHERE c.id_cat_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '         
        and a.id_usuario =' . session('id_usuario') . '
        ) and c.id_documento>0 and c.obligatorio=1 and c.id_tramite = 11');
    }

    public static function elimina_requisito_dtu($id_archivo, $id_solicitud)
    {
        DB::table('archivos')
            ->where('id_achivo', $id_archivo)
            ->where('id_solicitud', $id_solicitud)
            ->delete();
    }

    public static function consulta_requisitos_dtu($id_solicitud)
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

            //Enviamos el correo
            //Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_ord.png'));



            //Cambiamos el estatus de la solicitud 
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 63, 'estatus' => 'en revision']);
        } else {
            return false;
        }
    }
    public static function inserta_requisito_ord($id_documento, $filename, $extension, $id_solicitud)
    {
        $res1 = DB::select('SELECT c.id_cat_archivo FROM cat_archivo as c WHERE 
            c.id_documento = ' . $id_documento . ' and id_tramite=11');

        if ($res1) {
            $id_cat_archivo = $res1[0]->id_cat_archivo;

            $pend_file = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, c.id_documento FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
                WHERE c.id_cat_archivo = a.id_cat_archivo
                and a.id_solicitud =' . $id_solicitud . ' 
                and a.id_usuario =' . session('id_usuario') . '
                ) and c.id_tramite=11 and c.id_documento=' . $id_documento);

            if ($pend_file) {
                $affected =  DB::table('archivos')->insert([
                    'id_usuario'     => session('id_usuario'),
                    'id_cat_archivo' => $id_cat_archivo,
                    'nombre'         => $filename,
                    'extension'      => $extension,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'id_solicitud'   => $id_solicitud,
                ]);
            } else {
                $affected =  DB::table('archivos')
                    ->where('id_solicitud', $id_solicitud)
                    ->where('id_cat_archivo', $id_cat_archivo)
                    ->update([
                        'id_usuario'     => session('id_usuario'),
                        'nombre'         => $filename,
                        'extension'      => $extension,
                        'created_at'     => date('Y-m-d H:i:s'),
                    ]);

                $arc = DB::table('archivos')->where('nombre', $filename)->first();

                DB::table('archivosodt')->where([
                    'id_archivo'     => $arc->id_archivo,
                ])->delete();
            }
            return $affected;
        } else
            return null;
    }
}
