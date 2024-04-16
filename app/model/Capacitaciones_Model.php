<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\model\Solicitudes_model;
use App\Mail\contactoCapacitacion;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Mail;
use App\Mail\notificacion_capacitacion;

class Capacitaciones_Model extends Model
{
    use HasFactory;

    public static function solicitud()
    {

        //Esta linea hace que se refresque la pagina y no se guarde en cache

        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        //Si la pagina se refresca se borra la variable de sesion lastpage

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            // este modelo se usa para cuando se refresca la pagina y carga el ultimo folio

            $result = Solicitudes_model::consulta_ultimo_folio(27);
            $folio = $result[0]->folio;
        } else {

            //es para id revisor no aplica

            $id_revisor = Solicitudes_model::balanza(169);

            //declaras los valores para la table solicitudes

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
            //insertas los valores en la tabla solicitudes_hist

            DB::table('solicitudes_hist')
                ->insert($data1);
        }

        session(['lastpage' => __FILE__]);
        return $folio;
    }

    public static function guardarParticipantes($request, $parti)
    {
        $id_captura = DB::connection('captura_op')->table('Precaptura')
            ->select('IdCaptura')
            ->where('id_solicitud', $request->id_solicitud)
            ->get();



        $parti = collect($parti)->filter()->toArray();


        foreach ($parti as $participante) {
            //dd($participante,$request->id_solicitud, $id_captura[0]);exit;
            DB::connection('captura_op')->table('Capacitaciones')->insert([
                'tipoTramite' => 27,
                'IdCaptura'  => $id_captura[0]->IdCaptura,
                'fecha'       => date('Y-d-m H:i:s'),
                'id_solicitud' => $request->id_solicitud,
                'Participantes' => $participante
            ]);
        }
        return true;

    }

    public static function avanzarEtapa($request)
    {
        $id_captura = DB::connection('captura_op')->table('Precaptura')
            ->select('IdCaptura')
            ->where('id_solicitud', $request->id_solicitud)
            ->get();


        DB::connection('captura_op')->table('Precaptura')
            ->where('IdCaptura', $id_captura[0]->IdCaptura)
            ->update(['EdoAct' => 2]);

        DB::connection('captura_op')->table('Precaptura')
            ->where( 'IdCaptura', $id_captura[0]->IdCaptura)
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
            $request->domicilio,  $request->correo_propietario, $request->telefono, $request->colonia, $request->municipio,
            $request->nombre, $request->apellido_uno, $request->apellido_dos, $request->numero, $request->numeroint, $request->giro_comercio,
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
            $request->domicilio,  $request->correo_propietario, $request->telefono, $request->colonia, $request->municipio,
            $request->nombre, $request->apellido_uno, $request->apellido_dos, $request->numero, $request->numeroint, $request->giro_comercio,
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

    public static function notifica($request, $titulo, $mensaje)
    {
        $id_captura = DB::connection('captura_op')->table('Precaptura')
        ->select('IdCaptura')
        ->where('id_solicitud', $request->id_solicitud)
        ->get();

        $data_p = DB::connection('captura_op')->table('Precaptura')
            ->where('IdCaptura', $id_captura[0]->IdCaptura)->first()->emailPropietario;
        //dd($data_p);exit;
        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => session('id_usuario'),
            'id_coordinacion' => 7,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje,

        ];

        if (DB::table('notificaciones')->insert($data)) {

            Mail::to($data_p)->bcc(env('MAIL_BCC'))->send(new notificacion_capacitacion($data_p, $titulo, $mensaje, 'https://bomberos.zapopan.gob.mx/static/assets4/images/logo_PCYBZ_100x262.png'));

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
        $id_captura = DB::connection('captura_op')->table('Precaptura')
        ->select('IdCaptura')
        ->where('id_solicitud', $request->id_solicitud)
        ->get();

        $data_p = DB::connection('captura_op')->table('Precaptura')
            ->where('IdCaptura', $id_captura[0]->IdCaptura)
            ->first(); // Usamos first() para obtener solo un registro

        $data_participantes = DB::connection('captura_op')->table('Capacitaciones')
            ->where('IdCaptura',$id_captura[0]->IdCaptura)
            ->get()
            ->toArray(); // Convertimos la colección a un array

        $correoData = [
            'data_p' => $data_p,
            'data_participantes' => $data_participantes,
        ];

        Mail::to('vimoz@zapopan.gob.mx')
            ->bcc('joel.campos@zapopan.gob.mx')
            ->send(new contactoCapacitacion($correoData));
    }
}
