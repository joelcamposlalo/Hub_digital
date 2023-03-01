<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;

class Prelicencias_model extends Model
{

    public static function solicitud()
    {
        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            $result = Solicitudes_model::consulta_ultimo_folio(4);
            $folio = $result[0]->folio;
        } else {

            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 4,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  13,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  Solicitudes_model::balanza(16)
            ], 'id_solicitud');
        }
        session(['lastpage' => __FILE__]);

        return $folio;
    }


    public static function get_giros()
    {

        $sql = "SELECT IdGiro, Nombre FROM Giros WHERE tipogiro in ('A','B') AND ANUNCIO=0 ORDER BY Nombre";

        return DB::connection('pyl')->select($sql);
    }

    public static function get_calles()
    {

        $sql = "SELECT IdCalle, NombreOficial from Calles order by NombreOficial asc";

        return DB::connection('pyl')->select($sql);
    }

    public static function get_colonias()
    {

        $sql = "SELECT IdColonia, NombreColonia from Colonias order by NombreColonia asc";

        return DB::connection('pyl')->select($sql);
    }

    public static function get_requisitos($idGiro)
    {

        $sql = "EXECUTE sp_consultaRequisitosAltaGiroPre ?,?,?";

        if (session('tipo_persona') == 'fisica') {
            $persona = 'f';
        } else {
            $persona = 'm';
        }

        return DB::connection('pyl')->select($sql, array($idGiro, $persona, 0));
    }

    public static function get_nombre($idGiro)
    {

        $sql = "SELECT Nombre FROM Giros WHERE IdGiro=?";

        return DB::connection('pyl')->select($sql, array($idGiro));
    }

    public static function get_archivos_requisitos()
    {

        $pendientes = DB::select("SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE c.id_documento>0 and c.id_tramite = 4");
        return $pendientes;
        
    }

    public static function get_archivos_terminados($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 4],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])->get();

        return $terminados;
            
    }


    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 4],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])->get();


        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
            c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
            WHERE c.id_cat_archivo = a.id_cat_archivo
            and a.id_solicitud =' . $id_solicitud . '         
            and a.id_usuario =' . session('id_usuario') . '
            ) and ((c.id_documento>0 and c.id_tramite = 4))');

        

        

        return [
            'terminados'  => $terminados,
            'pendientes'  => $pendientes,
            
        ];
        //$sql ="execute tw_consulta_requisitos ?,?"

    }


    public static function inserta_requisito($id_documento, $filename, $extension, $id_solicitud)
    {
        $pend_file = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, c.id_documento 
        FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
                WHERE c.id_cat_archivo = a.id_cat_archivo
                and a.id_solicitud =' . $id_solicitud . ' 
                and a.id_usuario =' . session('id_usuario') . '
                ) and ((c.id_documento='.$id_documento.' and c.id_tramite = 4))');

        if ($pend_file) {
            $id_cat_archivo = $pend_file[0]->id_cat_archivo;
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

    public static function guarda_precaptura($request)
    {

        $query = "execute sp_GuardarPrecapturaVDigital ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?";

        $ciudad = '';
        if (session('tipo_persona') == 'fisica')
            $nombre = session('nombre');
        else
            $nombre = session('razon_social');


        $exterior = (((session('no_exterior') . session('letra_exterior')) == null) ? '' : (session('no_exterior') . session('letra_exterior')));
        $interior = (((session('no_interior') . session('letra_interior')) == null) ? '' : (session('no_interior') . session('letra_interior')));

        if ($request->tipo_persona == 'fisica') {
            $tipo_persona = 'F';
        } else {
            $tipo_persona = 'M';
        }

        $params = array(
            $nombre,
            $request->rfc,
            session('domicilio'),
            session('colonia'),
            $request->ComCalleCruce1,
            $request->ComCalleCruce2,
            $ciudad,
            session('telefono'),
            session('cp'),
            session('correo'),
            $request->nombre_negocio,
            $request->actividad_a_realizar,
            $request->ComCalleNegocio,
            $request->exterior,
            (($request->interior == null) ? 0 : $request->interior),
            $request->ComColoniaNegocio,
            $request->cpneg,
            $request->superficie,
            (($request->cajones == null) ? 0 : $request->cajones),
            (($request->niveles == null) ? 0 : $request->niveles),
            (($request->inversion == null) ? 0 : $request->inversion),
            (($request->empleos_creados == null) ? 0 : $request->empleos_creados),
            $request->ComCallePosterior,
            session('calle'),
            $exterior, $interior,
            ((session('primer_apellido') == null) ? '' : session('primer_apellido')),
            ((session('segundo_apellido') == null) ? '' : session('segundo_apellido')),
            $tipo_persona,
            (($request->telefonoest == null) ? 0 : $request->telefonoest),
            $request->idGiro,
            (($request->cuenta == null) ? 0 : $request->cuenta),
            $request->curt
        );

        return DB::connection('pyl')->select($query, $params);
    }



    /**
     * 
     * Revisor de prelicencias
     * 
     */

    public static function rechazar($request)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => 17,
            'estatus'       => 'no autorizado',

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);


        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => $request['id_coordinacion'],
            'titulo'          => 'Solicitud rechazada',
            'id_solicitud'    => $request['id_solicitud'],
            'descripcion'     => $request['descripcion']
        ];

        $rechazado = Prelicencias_model::rechaza_prelicencia($request);


        if ($rechazado[0]->resultado > 0) {
            if (DB::table('notificaciones')->insert($data)) {

                //Enviamos el correo
                //Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], $data['titulo'], '<font color="#000000">Estimado contribuyente: <br><br> Tu solicitud de Prelicencia con <strong>folio: ' . $request['id_solicitud'] . '</strong>, no es procedente por los motivos siguientes: </font><br><br><font color="#000000">' . $data['descripcion'] . '</font>', 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));

                //Cambiamos el estatus de la solicitud 
                return DB::table('solicitudes')
                    ->where('id_solicitud', $request['id_solicitud'])
                    ->update(['id_etapa' => 17, 'estatus' => 'no autorizado','id_revisor' => session('id_usuario'),'update_at' => date('Y-m-d H:i:s')]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function rechaza_prelicencia($request)
    {
        $folio = $request['id_precaptura'];
        $idGiro = $request['idGiro'];
        $usuario_cancelacion = session('correo');
        $motivo = $request['descripcion'];
        $sql = "execute sp_RechazaPrecapturaVDigital ?,?,?,?";
        $params = array($folio, $idGiro, $motivo, $usuario_cancelacion);
        return DB::connection('pyl')->select($sql, $params);
    }

    public static function condicionar($request)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => 17,
            'estatus'       => 'autorizado',

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);


        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => $request['id_coordinacion'],
            'titulo'          => 'Solicitud autorizada condicionalmente',
            'id_solicitud'    => $request['id_solicitud'],
            'descripcion'     => '<font color="#000000"> Estimado Contribuyente: </font><br><br><font color="#000000"> Tu Prelicencia con <strong>folio: ' . $request['id_solicitud'] . '</strong>, fue aprobada bajo condicion siguiente: </font><br><br><font color="#000000">'. $request['descripcion'].'.</font><br><br><font color="#000000">Recuerda que tiene una vigencia de 28 días y en ese lapso deberás tramitar tu licencia.</font><br><br><a href="https://kioscos.zapopan.gob.mx/permiso_provisional/formato_prelicencia.php?folio=' . $request['id_precaptura'] . '">Descargar Prelicencia</a>'
        ];

        $condicion = Prelicencias_model::confirma_condicionada($request);

        if ($condicion[0]->resultado > 0) {
            if (DB::table('notificaciones')->insert($data)) {

                //Enviamos el correo
                //Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], $data['titulo'], $data['descripcion'], 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));


                //Cambiamos el estatus de la solicitud 
                return DB::table('solicitudes')
                    ->where('id_solicitud', $request['id_solicitud'])
                    //->update(['id_etapa' => 17, 'estatus' => 'autorizado', 'update_at' => date('Y-m-d H:i:s')]);
                    ->update(['id_etapa' => 17, 'estatus' => 'autorizado','id_revisor' => session('id_usuario'),'update_at' => date('Y-m-d H:i:s')]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function confirma_condicionada($request)
    {
        $folio = $request['id_precaptura'];
        $idGiro = $request['idGiro'];
        $usuario_confirmacion = session('correo');
        $observaciones = $request['descripcion'];
        $sql = "execute sp_ConfirmaPrecapturaCondVdigital ?,?,?,?";
        $params = array($folio, $idGiro, $observaciones, $usuario_confirmacion);
        return DB::connection('pyl')->select($sql, $params);
    }

    public static function autorizar($request)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => 17,
            'estatus'       => 'autorizado',

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);


        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => $request['id_coordinacion'],
            'titulo'          => 'Solicitud autorizada',
            'id_solicitud'    => $request['id_solicitud'],
            'descripcion'     => '<font color="#000000"> Estimado Contribuyente: </font><br><br><font color="#000000"> Tu Prelicencia con <strong>folio: ' . $request['id_solicitud'] . '</strong>, fue aprobada con éxito. </font><br><br><font color="#000000">Recuerda que tiene una vigencia de 28 días y en ese lapso deberás tramitar tu licencia.</font><br><br><a href="https://kioscos.zapopan.gob.mx/permiso_provisional/formato_prelicencia.php?folio=' . $request['id_precaptura'] . '">Descargar Prelicencia</a>'
        ];

        $autorizado = Prelicencias_model::confirma_prelicencia($request);

        if ($autorizado[0]->resultado > 0) {
            if (DB::table('notificaciones')->insert($data)) {

                //Enviamos el correo
                //Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], $data['titulo'], $data['descripcion'], 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));


                //Cambiamos el estatus de la solicitud 
                return DB::table('solicitudes')
                    ->where('id_solicitud', $request['id_solicitud'])
                    //->update(['id_etapa' => 17, 'estatus' => 'autorizado', 'update_at' => date('Y-m-d H:i:s')]);
                    ->update(['id_etapa' => 17, 'estatus' => 'autorizado','id_revisor' => session('id_usuario'),'update_at' => date('Y-m-d H:i:s')]);
            } else {
                return false;
            }
        } else if ($autorizado[0]->resultado == -2) {
            $rechazado = Prelicencias_model::rechaza_prelicencia($request);


            if ($rechazado[0]->resultado > 0) {
                if (DB::table('notificaciones')->insert($data)) {

                    //Enviamos el correo
                    //Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], $data['titulo'], '<font color="#000000">Estimado contribuyente: <br><br> Tu solicitud de Prelicencia con <strong>folio: ' . $request['id_solicitud'] . '</strong>, no es procedente por los motivos siguientes: </font><br><br><font color="#000000">' . $data['descripcion'] . '</font>', 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));

                    //Cambiamos el estatus de la solicitud 
                    return DB::table('solicitudes')
                        ->where('id_solicitud', $request['id_solicitud'])
                        //->update(['id_etapa' => 17, 'estatus' => 'no autorizado', 'update_at' => date('Y-m-d H:i:s')]);
                        ->update(['id_etapa' => 17, 'estatus' => 'no autorizado','id_revisor' => session('id_usuario'),'update_at' => date('Y-m-d H:i:s')]);
                } else {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public static function confirma_prelicencia($request)
    {
        $folio = $request['id_precaptura'];
        $idGiro = $request['idGiro'];
        $usuario_confirmacion = session('correo');
        $sql = "execute sp_ConfirmaPrecapturaVdigital ?,?,?";
        $params = array($folio, $idGiro, $usuario_confirmacion);
        return DB::connection('pyl')->select($sql, $params);
    }

    public static function posibles_repetidos($id_precaptura)
    {
        $folio = $id_precaptura;
        $sql = "exec pre_posibles_repetidos ?";
        $params = array($folio);
        return DB::connection('pyl')->select($sql, $params);
    }

    public static function consulta_prelicencia($request)
    {
        $folio = $request->folio;
        $sql = "execute usp_PrelicenciaDetalle ?";
        $params = array($folio);
        return DB::connection('pyl')->select($sql, $params);
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
            'id_etapa'      => 16,
            'estatus'       => 'en revision',

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);


        $data = [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => 3,
            'titulo'          => $titulo,
            'descripcion'     => $mensaje,
        ];

        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            //Mail::to($correo)->bcc(env('MAIL_BCC'))->send(new Notificacion($correo, $titulo, $mensaje, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));

            //Cambiamos el estatus de la solicitud 
            return true;
        } else {
            return false;
        }
    }

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

        $archivos = DB::table('archivos as a')
            ->select('a.nombre as archivo', 'ca.nombre as nombre', '*')
            ->join('cat_archivo as ca', 'ca.id_cat_archivo', '=', 'a.id_cat_archivo')
            ->where('a.id_usuario', $solicitud->id_usuario)
            ->where('a.id_solicitud', $id_solicitud)
            ->get();
        

        $giros      = Prelicencias_model::get_giros();
        $calles     = Prelicencias_model::get_calles();
        $colonias   = Prelicencias_model::get_colonias();
        $repetidos  = Prelicencias_model::posibles_repetidos($datos_solicitud['id_precaptura']);

        return [
            'solicitud' => $solicitud,
            'datos'     => $datos_solicitud,
            'archivos'  => $archivos,
            'giros'     => $giros,
            'calles'    => $calles,
            'colonias'  => $colonias,
            'revisor'   => $revisor,
            'repetidos' => $repetidos
        ];
    }

    public static function reenviar($id_solicitud)
    {

        $datos = DB::table('datos_solicitudes')
            ->where('id_solicitud', $id_solicitud)
            ->get();

        $datos_solicitud = [];

        foreach ($datos as $value) {
            $datos_solicitud += [$value->campo => $value->dato];
        }


        $descripcion = "<font color='#000000'> Estimado Contribuyente: </font><br><br><font color='#000000'> Tu Prelicencia con <strong>folio: $id_solicitud</strong>, fue aprobada con éxito. </font><br><br><font color='#000000'>Recuerda que tiene una vigencia de 28 días y en ese lapso deberás tramitar tu licencia.</font><br><br><a href='https://kioscos.zapopan.gob.mx/permiso_provisional/formato_prelicencia.php?folio=" . $datos_solicitud['id_precaptura'] . "'>Descargar Prelicencia</a>";

        //Enviamos el correo
        //Mail::to($datos_solicitud['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($datos_solicitud['correo'], 'Solicitud autorizada', $descripcion, 'https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png'));

        return true;
    }
}
