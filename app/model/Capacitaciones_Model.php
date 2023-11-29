<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;
use App\Mail\contactoCapacitacion;
use Illuminate\Support\Facades\Mail;
use App\Mail\notificacion;

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

            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 27,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  169,
                'estatus'    =>  'pendiente',
            ], 'id_solicitud');
            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
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

    public static function avanzarEtapa($request)
    {

        DB::connection('captura_op')->table('Precaptura')
            ->where('idCaptura', $request->id_captura)
            ->update(['EdoAct' => 2]);

        DB::connection('captura_op')->table('Precaptura')
            ->where('idCaptura', $request->id_captura)
            ->update(['id_solicitud' => $request->id_solicitud]);


        DB::connection('pgsql')->table('solicitudes')
            ->where('id_solicitud', $request->id_solicitud)
            ->update(['id_solicitud' => $request->id_solicitud]);
    }

    public static function ingresa_solicitud($request)
    {


        $sql = "EXECUTE proteccion_capacitaciones_inserta
        ?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,?,?";

        $params = array(
            $request->domicilio,  $request->correo, $request->telefono, $request->colonia, $request->municipio,
            $request->nombre, $request->apellido_uno, $request->apellido_dos, $request->numero,$request->numeroint, $request->giro_comercio,
            $request->materia_de, $request->razonSocial, session('id_usuario'), $request->selector_pc, $request->id_solicitud,

        );

        $result = DB::connection('captura_op')->select($sql, $params);

        return $result;
    }

    public static function actualiza_solicitud($request)
    {

        $sql = "EXECUTE proteccion_capacitaciones_actualiza
        ?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,?,?";

        $params = array(
            $request->domicilio,  $request->correo, $request->telefono, $request->colonia, $request->municipio,
            $request->nombre, $request->apellido_uno, $request->apellido_dos, $request->numero,$request->numeroint, $request->giro_comercio,
            $request->materia_de, $request->razonSocial,  session('id_usuario'), $request->selector_pc, $request->id_captura,

        );

        return DB::connection('captura_op')->select($sql, $params);
    }


    public static function ingresa_participantes($request)
    {

        $data = [
            'tipoTramite' => 27,
            'parti' => $request->participantes
        ];

        DB::table('Capacitaciones')->insert($data);

        $data = [
            'Estado' => 4
        ];

        DB::table('EstadoPreCaptura')->insert($data);

        return true;
    }


    public static function notifica($request, $titulo, $mensaje)
    {

        $data_p = DB::connection('captura_op')->table('Precaptura')
            ->where("IdCaptura", $request->id_captura)->first()->emailPropietario;

        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => session('id_usuario'),
            'id_coordinacion' => 7,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje,

        ];

        if (DB::table('notificaciones')->insert($data)) {

            Mail::to($data_p)->bcc(env('MAIL_BCC'))->send(new notificacion($data_p, $titulo, $mensaje, 'https://bomberos.zapopan.gob.mx/static/assets4/images/logo_PCYBZ_100x262.png'));

            DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 171, 'estatus' => 'terminado']);

            return DB::table('solicitudes_hist')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 171, 'estatus' => 'terminado']);
        } else {
            return false;
        }
    }


    public static function sendMail($request)
    {

        $data_p = DB::connection('captura_op')->table('Precaptura')
            ->where("IdCaptura", $request->id_captura)->first();

        $data_participantes = DB::connection('captura_op')->table('Capacitaciones')
            ->where("IdCaptura", $request->id_captura)->get();

        $correoData = [
            'data_p' => $data_p,
            'data_participantes' => $data_participantes,
        ];

        Mail::to('joel.campos@zapopan.gob.mx')
            // ->bcc('vimoz@zapopan.gob.mx')
            ->send(new contactoCapacitacion($correoData));
    }
}
