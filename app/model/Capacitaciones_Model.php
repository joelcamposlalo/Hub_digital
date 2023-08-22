<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;
use App\Mail\contactoCapacitacion;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Mail;

class Capacitaciones_Model extends Model
{
    use HasFactory;

    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {
            $result = Solicitudes_model::consulta_ultimo_folio(27);
            $folio = $result[0]->folio;
        } else {
            $id_revisor = Solicitudes_model::balanza(169);
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 27,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  169,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  $id_revisor
            ], 'id_solicitud');
            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_revisor'    => $id_revisor,
                'id_tramite'    => 27,
                'id_etapa'      => 170,
                'estatus'       => 'pendiente',
            ];

            DB::table('solicitudes_hist')
                ->insert($data1);
        }

        session(['lastpage' => __FILE__]);
        return $folio;
    }

    public static function guardarParticipantes($request, $parti)
    {

        for ($i = 0; $i < count($parti); $i++) {
            DB::connection('captura_op')->table('Capacitaciones')->insert([
                'tipoTramite' => 27,
                'idCaptura'  => $request->id_captura,
                'fecha'       => date('Y-d-m H:i:s'),
                'id_solicitud' => $request->id_solicitud,
                'Participantes' => $parti[$i]
            ]);
        }

        return true;
    }

    public static function avanzarEtapa($request){

        DB::connection('captura_op')->table('Precaptura')
        ->where('idCaptura', $request->id_captura)
        ->update(['EdoAct' => 2]);

        DB::connection('pgsql')->table('solicitudes')
        ->where('id_solicitud', $request->id_solicitud)
        ->update(['estatus' => "en revision"]);
    }

    public static function sendMail($request){

    $data_p = DB::connection('captura_op')->table('Precaptura')
        ->where("IdCaptura", $request->id_captura)->first();

    $data_participantes = DB::connection('captura_op')->table('Capacitaciones')
    ->where("IdCaptura", $request->id_captura)->get();

    $correoData = [
        'data_p' => $data_p,
        'data_participantes' => $data_participantes
    ];

    Mail::to($correoData['data_p']->emailPropietario)
    ->send(new contactoCapacitacion($correoData));
    }

    public static function ingresa_solicitud($request)
    {

        $sql = "EXECUTE proteccion_capacitaciones_inserta
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?";

        $params = array(
            $request->nombre, $request->apellido_p, $request->apellido_m, $request->correo, $request->telefono,
            $request->colonia, $request->municipio, $request->domicilio, $request->giro_comercio, $request->materia_de,
            session('id_usuario'),  $request->id_solicitud
        );

        $result = DB::connection('captura_op')->select($sql, $params);

        return $result;

    }

    public static function ingresa_participantes($request)
    {

        $data = [
            'tipoTramite' => 27,
            'parti' => $request->participantes
        ];
        // Insert the data into the 'capacitaciones' table
        DB::table('Capacitaciones')->insert($data);

        $data = [
             'Estado' => 4
         ];
        DB::table('EstadoPreCaptura')->insert($data);

        return true;
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
            //Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_ord.png'));

            //Cambiamos el estatus de la solicitud

            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 68, 'estatus' => 'en revision']);
        } else {
            return false;
        }
    }
}
