<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\Notificacion;
use App\Mail\Activar;
use App\Mail\Recuperar;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;



class Constancia_habitabilidad_model extends Model
{
    use HasFactory;
    /**
     * Obtiene toda la información que necesita el 
     * revisor
     */


    public static function get_by_id($id_solicitud)
    {

        $datos = DB::table('datos_solicitudes')
            ->where('id_solicitud', $id_solicitud)
            ->get();

        $datos_solicitud = [];

        foreach ($datos as $value) {
            $datos_solicitud += [$value->campo => $value->dato];
        }

        $solicitud =  DB::table('solicitudes as s')
            ->select('s.id_solicitud as folio', 's.update_at as fecha', '*')
            ->join('datos_personales as dp', 'dp.id_usuario', '=', 's.id_usuario')
            ->join('archivos as a', 'a.id_usuario', '=', 's.id_usuario')
            ->join('cat_archivos as ca', 'ca.id_archivo', '=', 'a.id_cat_archivo')
            ->join('usuarios as u', 'u.id_usuario', '=', 's.id_usuario')
            ->join('cat_tramites as ct', 'ct.id_tramite', '=', 's.id_tramite')
            ->join('cat_coordinaciones as cc', 'cc.id_coordinacion', '=', 'ct.id_coordinacion')
            ->where('s.id_solicitud', '=', $id_solicitud)
            ->first();

        $archivos = DB::table('archivos as a')
            ->select('a.nombre as archivo', 'ca.nombre as nombre', '*')
            ->join('cat_archivo as ca', 'ca.id_cat_archivo', '=', 'a.id_cat_archivo')
            ->where('a.id_usuario', $solicitud->id_usuario)
            ->where('a.id_documento', '>', 0)
            ->where('ca.id_tramite', $solicitud->id_tramite)
            ->get();

        return [
            'solicitud' => $solicitud,
            'datos'     => $datos_solicitud,
            'archivos'  => $archivos
        ];
    }


    /**
     * Obtiene todos los archivos del tramite y del usuario
     * logeado
     */

    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 14],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])
            ->orWhere([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.universal', '=', true],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.id_documento', '>', 0]
            ])
            ->get();


        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '         
            and a.id_usuario =' . session('id_usuario') . '
            ) and ((c.id_documento>0 and c.id_tramite = 14) or (c.id_documento>0 and c.id_tramite = 0))');

        /*echo '<br>SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '         
            and a.id_usuario =' . session('id_usuario') . '
            ) and ((c.id_documento>0 and c.id_tramite = 14) or (c.id_documento>0 and c.id_tramite = 0))';*/

        $resv = Certificado_habitabilidad_model::consulta_requisitos_validados($id_solicitud);
        $validados = array();
        foreach ($resv as $validado) {
            array_push($validados, $validado->IdDocumento);
        }

        return [
            'terminados'  => $terminados,
            'pendientes'  => $pendientes,
            'validados'  => $validados
        ];
        //$sql ="execute tw_consulta_requisitos ?,?"

    }

    public static function upload($request)
    {

        $extension      = $request['file']->extension();
        $filename       = $request['name'] . '.' . $extension;
        $filename       = '1-' . date('YmdHis') . '-' . $filename;
        $id_solicitud   = $request['id_solicitud'];

        if (Storage::putFileAs('/public/' . session('id_usuario'), $request['file'], $filename)) {

            if (isset($request['id_archivo'])) {

                $archivo = DB::table('archivos')
                    ->select('nombre')
                    ->where('id_archivo', '=', $request['id_archivo'])->first();

                Storage::delete('/public/' . session('id_usuario') . '/' . $archivo->nombre); //Eliminamos el archivo anterior

                DB::table('archivos')
                    ->where('id_archivo', '=', $request['id_archivo'])
                    ->update([
                        'id_cat_archivo' => $request['id_cat_archivo'],
                        'nombre'         => $filename,
                        'extension'      => $extension,
                    ]);

                return [
                    'id_archivo' => $request['id_archivo'],
                    'archivo'    => $filename
                ];
            } else {
                $id_archivo =  DB::table('archivos')->insertGetId([
                    'id_usuario'     => session('id_usuario'),
                    'id_cat_archivo' => $request['id_cat_archivo'],
                    'nombre'         => $filename,
                    'extension'      => $extension,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'id_solicitud'   => $id_solicitud,
                ], 'id_archivo');

                return [
                    'id_archivo' => $id_archivo,
                    'archivo'    => $filename
                ];
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * Agregar solicitud
     * 
     */

    public static function solicitud()
    {
        $pageWasRefreshed =  isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            $result = Solicitudes_model::consulta_ultimo_folio(14);
            $folio = $result[0]->folio;
        } else {
            $id_revisor = Solicitudes_model::balanza(79);
            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 14,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  79,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  $id_revisor
            ], 'id_solicitud');

            $data1 = [
                'id_solicitud'  => $folio,
                'id_usuario'    => session('id_usuario'),
                'id_revisor'    => $id_revisor,
                'id_tramite'    => 14,
                'id_etapa'      => 79,
                'estatus'       => 'pendiente',

            ];

            DB::table('solicitudes_hist')
                ->insert($data1);
        }
        /*insert into solicitudes_hist(id_solicitud, id_usuario, id_revisor, id_tramite, id_etapa, created_at, estatus, folio_externo, estatus_externo) 
			SELECT s.id_solicitud, s.id_usuario,s.id_revisor,s.id_tramite,s.id_etapa, current_timestamp ,s.estatus,cast(vprecaptura as varchar(100)),vedoact*/


        session(['lastpage' => __FILE__]);


        return $folio;
    }

    public static function ingresa_solitud_op($request)
    {
        $sql = "EXECUTE capturaweb.dbo.ca_inserta_consthab ?,?,?,?
                ,?,?,?,?
                ,?,?,?,?
                ,?,?,?,?
                ,?,?,?,?
                ,?,?,?";

        if ($request->tipo_persona == "1") {
            $tipo_persona = "F";
        } else if ($request->tipo_persona == "2") {
            $tipo_persona = "M";
        } 

        if ($request->letraE) {
            $numero = $request->numero . " " . $request->letraE;
        } else {
            $numero = $request->numero;
        }

        if ($request->interior) {
            $numero = $request->numero . " " . $request->interior;
        } else {
            $numero = $request->numero;
        }

        if ($request->cuenta == '') {
            $request->cuenta = 'S/N';
        }

        if ($request->curt == '') {
            $request->curt = 'S/N';
        }
        $giro = "1";
        $params = array(
            $request->calle, $numero, $request->fraccionamiento, $request->cuenta,
            $request->curt, $request->manzana, $request->lote, $request->condominio,
            $request->privativa, $giro, $request->telefono, $request->correo_propietario,
            session('id_usuario'), session('nombre'), session('primer_apellido'), session('segundo_apellido'),
            $tipo_persona, $request->id_solicitud, $request->clave, $request->drz,
            $request->domicilio, $request->nombre, session('correo')
        );

        $result = DB::connection('tramites_op')->select($sql, $params);
        return $result;
    }


    public static function cancela_solicitud_op($id_captura)
    {
        $sql = "EXECUTE tw_cancela_trabajo_menor ?";
        $params = array($id_captura);
        $result = DB::connection('tramites_op')->select($sql, $params);
        return $result;
    }


    public static function actualiza_solitud_op($request)
    {

        $sql = "EXECUTE  capturaweb.dbo.ca_actualiza_consthab ?,?,?,?
        ,?,?,?,?
        ,?,?,?,?
        ,?,?,?,?
        ,?,?,?,?
        ,?,?,?,?";


        if ($request->letraE) {
            $numero = $request->numero . " " . $request->letraE;
        } else {
            $numero = $request->numero;
        }

        if ($request->interior) {
            $numero = $request->numero . " " . $request->interior;
        } else {
            $numero = $request->numero;
        }

        if ($request->cuenta == '') {
            $request->cuenta = 'S/N';
        }

        if ($request->curt == '') {
            $request->curt = 'S/N';
        }
        if (session('tipo_persona') == "fisica") {
            $tipo_persona = "F";
        } else {
            $tipo_persona = "M";
        }
        $giro = "1";
        $params = array(
            $request->calle, $numero, $request->fraccionamiento, $request->cuenta,
            $request->curt, $request->manzana, $request->lote, $request->condominio,
            $request->privativa, $giro, $request->telefono, $request->correo_propietario,
            session('id_usuario'), session('nombre'), session('primer_apellido'), session('segundo_apellido'),
            $tipo_persona, $request->id_solicitud, $request->clave, $request->drz,
            $request->domicilio, $request->id_captura, $request->nombre, session('correo')
        );

        $result = DB::connection('tramites_op')->select($sql, $params);

        return $result;
    }


    public static function  actualiza_edo_act($id_captura,$ing)
    {

        //$sql = "UPDATE capturaweb.dbo.PRECAPTURA SET edoact=1,ing=? where IdCaptura=?";
        $sql = "EXECUTE capturaweb.dbo.ch_ingresa_precaptura ?,?";


        $params = array(
            $id_captura
            , $ing
        );
        $result = DB::connection('tramites_op')->select($sql, $params);

        return $result;
    }


    public static function elimina_requisito_op($id_precaptura)
    {
        $sql = "execute capturaweb.dbo.ca_elimina_requisitos_pendientes_vdgital ? ";
        $params = array($id_precaptura);
        $result = DB::connection('tramites_op')->delete($sql, $params);
        return $result;
    }


    public static function inserta_requisito_op($id_precaptura, $id_documento, $ruta, $filename, $extension, $id_solicitud)
    {
        $select = "select count(*) as num from Capturaweb.dbo.TL_RequisitosRuta where idprecaptura=? and iddocumento=?";
        $params1 = array($id_precaptura, $id_documento);
        $result1 = DB::connection('tramites_op')->select($select, $params1);
        //busca el id_cat_archivo
        $res1 = DB::select('SELECT c.id_cat_archivo FROM cat_archivo as c WHERE
        ((c.id_documento=' . $id_documento . ' and c.id_tramite = 14) 
        or (c.id_documento=' . $id_documento . ' and c.id_tramite = 0))');
        //buscar si esta pendiente el archivo
        $pend_file = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, c.id_documento FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
                WHERE c.id_cat_archivo = a.id_cat_archivo
                and a.id_solicitud =' . $id_solicitud . ' 
                and a.id_usuario =' . session('id_usuario') . '
                ) and ((c.id_documento='.$id_documento.' and c.id_tramite = 14) or (c.id_documento='.$id_documento.' and c.id_tramite = 0))');

        if ($result1 && $result1[0]->num > 0) {
            $sql = "Update Capturaweb.dbo.TL_RequisitosRuta set ruta=?,fechaRegistro=getdate() where  idprecaptura=? and iddocumento=?;";

            $params = array($ruta, $id_precaptura, $id_documento);
            $result = DB::connection('tramites_op')->update($sql, $params);
            //$res1 = DB::select('SELECT c.id_cat_archivo FROM cat_archivo as c WHERE c.id_tramite = 14 and c.id_documento = ' . $id_documento);
        } else {
            $sql = "insert into Capturaweb.dbo.TL_RequisitosRuta(idprecaptura, iddocumento, ruta,fechaRegistro) values(?,?,?,getdate());";
            $params = array($id_precaptura, $id_documento, $ruta);
            $result = DB::connection('tramites_op')->insert($sql, $params);                        
        }
        if ($res1&&$result) {
            $id_cat_archivo = $res1[0]->id_cat_archivo;

            /*$pend_file = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, c.id_documento
             FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . ' 
            and a.id_usuario =' . session('id_usuario') . '
            ) and c.id_documento=' . $id_documento . ' and c.id_tramite=14');
            */
            
            if ($pend_file)
                $id_archivo =  DB::table('archivos')->insertGetId([
                    'id_usuario'     => session('id_usuario'),
                    'id_cat_archivo' => $id_cat_archivo,
                    'nombre'         => $filename,
                    'extension'      => $extension,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'id_solicitud'   => $id_solicitud,
                ], 'id_archivo');

            return 1;
        } else
            return null;
        
    }

    public static function consulta_archivos_faltantes($id_solicitud)
    {
        /*$pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
        c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
        WHERE c.id_cat_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '         
        and a.id_usuario =' . session('id_usuario') . '
        ) and c.id_documento>0 and c.obligatorio=1 and c.id_tramite = 14');
        */

        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '         
            and a.id_usuario =' . session('id_usuario') . '
            ) and ((c.id_documento>0 and c.id_tramite = 14 and c.obligatorio=1) or (c.id_documento>0 and c.id_tramite = 0))');

        return $pendientes;
    }

    public static function consulta_requisitos_validados($id_solicitud)
    {
        $sql = "execute capturaweb.dbo.certhab_consulta_requisitos_validados_vdigital ?,?";
        $result = DB::connection('tramites_op')->select($sql, [$id_solicitud, 6]);
        return $result;
    }
    public static function consulta_requisitos_op($id_captura)
    {

        $sql = "execute CAPTURAWEB.dbo.ch_consulta_requisitos ?,?";

        $result = DB::connection('tramites_op')->select($sql, [$id_captura, 6]);
        return $result;
    }
    public static function notifica($request, $titulo, $mensaje, $correo)
    {

        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => 1,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje
        ];

        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_plc.png'));

            //Cambiamos el estatus de la solicitud 
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => 82, 'estatus' => 'en revision']);
        } else {
            return false;
        }
    }

    public static function get_by_licencia($clave)
    {
        $sql = "    
        SELECT [IdRegistro]
             
        ,[IdLicencia]
        ,[FolioLic]
        ,[FechaLic]
        ,[EdoActLic]
        ,isnull(
            (SELECT Count(*)
        FROM CapturaWeb.[dbo].[Bloquear_Predio]
        where IdLicencia =? and Estatus='B'),0) bloqueo
        ,CuentaPredial,Calle,Numero,Fraccionamiento,Manzana,Lote
        ,Condominio,UnidadPrivativa,NombrePropietario,
        REPLACE(TelefonoPropietario,'-', '') as Telefono,
        IdPerito 
        FROM alh.[dbo].[Licencias]
        Where 
        IdLicencia like '%H/D%' AND 
        [EdoActLic]>=4 and [EdoActLic]<=6
        and IdLicencia=?
        and  (Densidad like '%HABITACIONAL PLURIFAMILIAR HORIZONTAL%' OR  Densidad like '%HABITACIONAL UNIFAMILIAR%')
        ;";

        $result = DB::connection('tramites_op')->select($sql, [$clave, $clave]);
        return $result;
    }
}
