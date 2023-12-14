<?php

namespace App\model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactoRectificacion;

class Rectificacion_model extends Model
{
    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {
            $result = Solicitudes_model::consulta_ultimo_folio(30);
            $folio = $result[0]->folio;
        } else {
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 30,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  182,
                'estatus'    =>  'pendiente',
            ], 'id_solicitud');

            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_tramite'    => 30,
                'id_etapa'      => 182,
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
                ['c.id_tramite', '=', 30],
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
            ) and c.id_documento>0 and c.id_tramite = 30');

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
    }

    public static function ingresa_solicitud($request)
    {
        $sql = "EXECUTE catastro_sp_vdigital_inserta
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?";

        $params = array(
            $request->nombre  ?? '-',
            $request->apellido_1 ?? '-',
            $request->apellido_2 ?? '-',
            $request->telefono ?? '-',
            $request->correo_propietario ?? '-',
            $request->domicilio_p ?? '-',
            $request->domicilio_n ?? '-',
            $request->entreCalle_1 ?? '-',
            $request->entreCalle_2 ?? '-',
            $request->numInt ?? '-',
            $request->numExt ?? '-',
            session('id_usuario') ?? '-',
            intval($request->id_solicitud)  ?? 1,
        );

        $result = DB::connection('captura_op')->select($sql, $params);

        return $result;
    }


    public static function actualiza_solicitud($request)
    {

        $sql = "EXECUTE catastro_sp_vdigital_actualiza
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?";

        $params = array(
            $request->nombre  ?? '-',
            $request->apellido_1 ?? '-',
            $request->apellido_2 ?? '-',
            $request->telefono ?? '-',
            $request->correo_propietario ?? '-',
            $request->domicilio_p ?? '-',
            $request->domicilio_n ?? '-',
            $request->entreCalle_1 ?? '-',
            $request->entreCalle_2 ?? '-',
            $request->numInt ?? '-',
            $request->numExt ?? '-',
            session('id_usuario') ?? '-',
            $request->id_captura ?? '-',
        );

        return DB::connection('captura_op')->select($sql, $params);
    }

    public static function actualiza_solicitud_2($request)
    {

        $sql = "EXECUTE catastro_sp_vdigital_actualiza_2
        ?,?,?,?,?,
        ?,?,?";

        $params = array(
            $request->numero_cuenta  ?? '-',
            $request->nombre_cuenta ?? '-',
            $request->tipo_rectificacion ?? '-',
            $request->rc_nombre ?? '-',
            $request->rc_notificacion ?? '-',
            $request->rc_ubicacion ?? '-',
            session('id_usuario') ?? '-',
            $request->id_captura ?? '-',
        );

        return DB::connection('captura_op')->select($sql, $params);
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

    public static function inserta_requisito_op($id_documento, $filename, $extension, $id_solicitud)
    {

        $res1 = DB::select('SELECT c.id_cat_archivo FROM cat_archivo as c WHERE
        c.id_documento = ' . $id_documento . ' and id_tramite=30');
        if ($res1) {
            $id_cat_archivo = $res1[0]->id_cat_archivo;

            $pend_file = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, c.id_documento FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '
            and a.id_usuario =' . session('id_usuario') . '
            ) and c.id_tramite=30 and c.id_documento=' . $id_documento);

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

    public static function notificarPorCorreo($request, $titulo, $mensaje)
    {
        $data = [
            'id_emisor' => session('id_usuario'),
            'id_receptor' => session('id_usuario'),
            'id_coordinacion' => 8,
            'titulo' => $titulo,
            'descripcion' => $mensaje,
        ];

        $emailPropietario = DB::connection('captura_op')->table('Precaptura')
            ->where("IdCaptura", $request->id_captura)->first()->emailPropietario;

        if ($emailPropietario) {
            if (DB::table('notificaciones')->insert($data)) {
                Mail::to($emailPropietario)->bcc(env('MAIL_BCC'))->send(new notificacion($emailPropietario, $titulo, $mensaje, 'https://pagos.zapopan.gob.mx/PagoEnLinea/img/logo-zapopan.b7fa7851.png'));
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function sendMail($request, $document_urls)
    {
        $correoData = DB::connection('captura_op')->table('Precaptura')
            ->where("IdCaptura", $request->id_captura)->first();


            Mail::to('joel.campos@zapopan.gob.mx')
            ->send(new contactoRectificacion($correoData, $document_urls));
        }

}
