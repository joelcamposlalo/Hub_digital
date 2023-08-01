<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;
use App\model\Acreditaciones_model;
use App\model\Dictamen_trazos_usos_model;
;

class Solicitudes_model extends Model
{
    //

    public static function consulta_solicitud($id_solicitud)
    {


        return DB::table('solicitudes as s')
            ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
            ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
            ->where('s.id_usuario', '=', session('id_usuario'))
            ->where('s.id_solicitud', '=', $id_solicitud)
            ->where('s.id_tramite', '=', DB::raw('e.id_tramite'))
            ->get();
    }

    public static function consulta_datos_solicitud($id_solicitud, $id_tramite, $etapa)
    {
        return DB::table('datos_solicitudes as ds')
            ->where('id_solicitud', '=', $id_solicitud)
            ->where('id_usuario', '=', session('id_usuario'))
            //->where('id_tramite', '=', $id_tramite)
            ->get();
    }

    public static function detalles($id_solicitud)
    {
        return DB::table('solicitudes as s')
            ->join('cat_tramites as ct', 'ct.id_tramite', '=', 's.id_tramite')
            ->join('cat_coordinaciones as cc', 'cc.id_coordinacion', '=', 'ct.id_coordinacion')
            ->where('s.id_solicitud', '=', $id_solicitud)
            ->get();
    }


    /**
     *
     * Obtener solicitudes para el listado depediendo
     * el rol
     *
     * @param rol
     * @return object
     *
     */


    public static function get_all($rol, $search = '', $filtro = '', $filtro_2 = '')
    {



        switch ($rol) {
            case 'ciudadano':
                //var_dump(DB::connection());
                if ($filtro != '' && $filtro != null) {

                    if ($filtro_2 == 'no autorizado') {

                        return DB::table('solicitudes as s')
                            ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                            ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
                            ->select(DB::raw('s.*,t.*,e.*, case
                        when s.id_tramite=1 or s.id_tramite=5 or s.id_tramite=6
                        or s.id_tramite = 13 or s.id_tramite = 14  or s.id_tramite = 15
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=2 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=8 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_permiso\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=7 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_folio\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=5 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=10 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=13 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=14 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=12 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=11 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))

                            ->where([
                                ['t.tramite', 'ILIKE', '%' . $search . '%'],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro],
                            ])
                            ->orWhere([
                                ['t.tramite', 'ILIKE', '%' . $search . '%'],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro_2]
                            ])
                            ->orWhere([
                                ['s.id_solicitud', '=', intval($search)],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro],
                            ])
                            ->orWhere([
                                ['s.id_solicitud', '=', intval($search)],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro_2]
                            ])
                            ->orderBy('s.update_at', 'desc')
                            ->get();
                    } else {
                        return DB::table('solicitudes as s')
                            ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                            ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
                            ->select(DB::raw('s.*,t.*,e.*, case
                        when s.id_tramite=1 or s.id_tramite=5 or s.id_tramite=6
                        or s.id_tramite = 13 or s.id_tramite = 14  or s.id_tramite = 15
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=2 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=12 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=11 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=8 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_permiso\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=7 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_folio\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=5 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=10 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=13 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=14 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))
                            ->where([
                                ['t.tramite', 'ILIKE', '%' . $search . '%'],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro],
                            ])
                            ->orWhere([
                                ['s.id_solicitud', '=', intval($search)],
                                ['s.id_usuario', '=', session('id_usuario')],
                                ['eliminado', '=', false],
                                ['estatus', '=', $filtro],
                            ])
                            ->orderBy('s.update_at', 'desc')
                            ->get();
                    }
                } else {


                    return DB::table('solicitudes as s')
                        ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                        ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
                        ->select(DB::raw('s.*,t.*,e.*, case
                        when s.id_tramite=1 or s.id_tramite=5 or s.id_tramite=6
                        or s.id_tramite=6
                        or s.id_tramite = 13 or s.id_tramite = 14   or s.id_tramite = 15
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=2 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=12 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=11 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=8 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_permiso\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=7 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_folio\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=5 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=10 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=13 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=14 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))

                        ->where([
                            ['t.tramite', 'ILIKE', '%' . $search . '%'],
                            ['s.id_usuario', '=', session('id_usuario')],
                            ['eliminado', '=', false]

                        ])
                        ->orWhere([
                            ['s.id_solicitud', '=', intval($search)],
                            ['s.id_usuario', '=', session('id_usuario')],
                            ['eliminado', '=', false]
                        ])
                        ->orderBy('s.update_at', 'desc')
                        ->get();
                }
                break;
            case 'revisor':

                //if ($filtro == 'en revision') {

                    return DB::table('solicitudes as s')
                        ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                        ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
                        ->join('roles_etapas as re', 're.id_tramite', '=', 't.id_tramite')
                        //->join('roles_etapas as ree', 'ree.id_etapa', '=', 'e.id_etapa')
                        //->join('roles_usuarios as ru', 're.id_rol_etapa', '=', 'ru.id_rol_etapa')
                        ->select(DB::raw('s.*,t.*,e.*,
                        case
                        when s.id_tramite in(1,2,5,6,9,11,12,13,14,15)
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)

                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=7 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_folio\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))

                        ->whereColumn('re.id_etapa', '=', 'e.id_etapa')
                        ->where([
                            ['t.tramite', 'ILIKE', '%' . $search . '%'],
                            ['s.estatus', 'ILIKE', '%' . $filtro. '%'],
                            //['s.estatus', '=', $filtro],
                            ['s.eliminado', '=', false],
                            ['t.id_tramite', '!=', 4],
                            ['s.id_revisor', '=', session('id_usuario')]
                        ])
                        ->orWhere([
                            ['s.eliminado', '=', false],
                            ['s.id_solicitud', '=', intval($search)],
                            ['s.estatus', '=', $filtro],
                            ['t.id_tramite', '!=', 4],
                            ['s.id_revisor', '=', session('id_usuario')]
                        ])
                        ->orWhere([
                            ['s.eliminado', '=', false],
                            ['s.id_solicitud', '=', intval($search)],
                            ['s.estatus', '=', $filtro],
                            ['t.id_tramite', '=', 4],
                            ['re.id_tramite', '=', 4]


                        ])
                        ->orWhere([
                            ['t.tramite', 'ILIKE', '%' . $search . '%'],
                            ['s.estatus', '=', $filtro],
                            ['s.eliminado', '=', false],
                            ['t.id_tramite', '=', 4],
                            ['re.id_tramite', '=', 4]


                        ])
                        ->limit(50)
                        ->get();
               // } else {

                    /*return DB::table('solicitudes as s')
                        ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                        ->join('cat_etapas as e', 'e.id_etapa', '=', 's.id_etapa')
                        ->join('roles_etapas as re', 're.id_tramite', '=', 't.id_tramite')
                        //->join('roles_usuarios as ru', 'ru.id_rol_etapa', '=', 're.id_rol_etapa')
                        ->select(DB::raw('s.*,t.*,e.*, case
                        when s.id_tramite=1 or s.id_tramite=5 or s.id_tramite=6
                        or s.id_tramite = 13 or s.id_tramite = 14
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=2 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=12 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=11 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=9 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))
                        ->whereColumn('re.id_etapa', '=', 'e.id_etapa')
                        ->where([
                            ['t.tramite', 'ILIKE', '%' . $search . '%'],
                            ['s.estatus', '=', $filtro],
                            ['s.eliminado', '=', false],
                            ['t.id_tramite', '!=', 4],
                            ['s.id_revisor', '=', session('id_usuario')]
                        ])
                        ->orWhere([
                            ['s.eliminado', '=', false],
                            ['s.id_solicitud', '=', intval($search)],
                            ['s.estatus', '=', $filtro],
                            ['t.id_tramite', '!=', 4],
                            ['s.id_revisor', '=', session('id_usuario')]
                        ])
                        ->orWhere([
                            ['s.eliminado', '=', false],
                            ['s.id_solicitud', '=', intval($search)],
                            ['s.estatus', '=', $filtro],
                            ['t.id_tramite', '=', 4],

                        ])
                        ->orWhere([
                            ['t.tramite', 'ILIKE', '%' . $search . '%'],
                            ['s.estatus', '=', $filtro],
                            ['s.eliminado', '=', false],
                            ['t.id_tramite', '=', 4],

                        ])


                        ->get();
                }*/
                break;
            default:

                //Administrador
                return DB::table('solicitudes as s')
                    ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
                    ->join('cat_etapas as e', 'e.paso', '=', 's.id_etapa')
                    ->select(DB::raw('s.*,t.*,e.*, case
                        when s.id_tramite=1  or s.id_tramite=5
                        or s.id_tramite=6
                        or s.id_tramite = 13 or s.id_tramite = 14
                        then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_captura\' order by created_at desc
                        limit 1 ),null)
                        when s.id_tramite=4 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=7 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_folio\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=5 then coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'id_precaptura\'
                        order by created_at desc
                        limit 1),null)
                        when s.id_tramite=3 then
                        coalesce((select ds.dato from datos_solicitudes ds
                        where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_expediente\'
                        order by created_at desc
                        limit 1
                        ),
                        coalesce(
                            (select ds.dato from datos_solicitudes ds
                            where ds.id_solicitud=s.id_solicitud and ds.campo=\'folio_acreditacion\'
                            order by created_at desc
                            limit 1
                        ),null)
                        ) else null end as id_captura'))

                    ->where('s.id_usuario', '=', session('id_usuario'))
                    ->get();
                break;
        }
    }


    public static function deleted($id_solicitud)
    {
        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $id_solicitud)
            ->get();

        $data = [
            'id_solicitud'  => $id_solicitud,
            'id_usuario'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => $res[0]->id_etapa,
            'estatus'       => 'eliminado',
            'folio_externo'       => '',
            'estatus_externo'  => 0

        ];

        DB::table('solicitudes_hist')
            ->insert($data);

        return DB::table('solicitudes')
            ->where('id_solicitud', $id_solicitud)
            ->update(['eliminado' => true, 'update_at' => date('Y-m-d H:i:s')]);
    }

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
            'id_etapa'      => $request['id_etapa'],
            'estatus'       => 'no autorizado',
            'folio_externo'       => '',
            'estatus_externo'  => 0
        ];

        DB::table('solicitudes_hist')
            ->insert($data1);

        if ($res[0]->id_tramite == 3) {
            $descripcion = '';
            foreach ($request['respuesta-rechazar'] as $respuesta) {

                switch ($respuesta) {
                    case 1:
                        $descripcion = $descripcion . "<font color='#000000'><li> Licencia de conducir vencida. </li></font>";
                        break;
                    case 2:
                        $descripcion = $descripcion . "<font color='#000000'><li> Tarjeta de circulación vencida. </li></font>";
                        break;
                    case 3:
                        $descripcion = $descripcion . "<font color='#000000'><li> No se acredita propiedad, posesión o relación con el titular del vehículo. </li></font>";
                        break;
                    case 4:
                        $descripcion = $descripcion . "<font color='#000000'><li> No es adulto mayor. </li></font>";
                        break;
                    case 5:
                        $descripcion = $descripcion . "<font color='#000000'><li> No exhibe constancia o credencial de discapacidad temporal o permanente. </li></font>";
                        break;
                    case 6:
                        $descripcion = $descripcion . "<font color='#000000'><li> No especifica el tiempo por el cual la movilidad se ve reducida para la acreditación temporal. </li></font>";
                        break;
                    case 7:
                        $descripcion = $descripcion . "<font color='#000000'><li> Documentos no legibles. </li></font>";
                        break;
                    case 8:
                        $descripcion = $descripcion . "<font color='#000000'><li> No se acredita la necesidad de ser trasladado con los documentos. </li></font>";
                        break;
                    case 9:
                        $descripcion = $descripcion . "<font color='#000000'><li> El certificado médico o constancia de discapacidad no son válidas. </li></font>";
                        break;
                    case 10:
                        $descripcion = $descripcion . "<font color='#000000'><li> " . $request['descripcion'] . " </li></font>";
                        break;
                }
            }

            $data = ['descripcion' => "<font color='#000000'>" . $descripcion . "</font><font color='#000000'><br>Lamentamos informarte que tu solicitud con <strong>folio: " . $request['id_solicitud'] . "</strong> fue rechazada por los motivos expuestos anteriormente.
            Si consideras que la evaluación no ha sido la correcta por favor comunícate a los teléfonos: <br><br></font><font color='#000000'>
            3338182200 ext. 3509, 3529, 3570 y 4590 (Unidad Basílica) <br>
            3338182200 ext. 2961 (CISZ) <br>
            3338182200 ext. 3596, 3598 (Guadalupe y periférico)</font>"];
        }


        $data += [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => $request['id_coordinacion'],
            'titulo'          => 'Solicitud rechazada',
            'id_solicitud'    => $request['id_solicitud']
        ];


        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], 'Solicitud rechazada', $data['descripcion'], $request['logo']));


            //Cambiamos el estatus de la solicitud
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['estatus' => 'no autorizado', 'id_etapa' => $request['id_etapa'], 'update_at' => date('Y-m-d H:i:s')]);
        } else {
            return false;
        }
    }

    public static function regresar($request)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => $request['id_etapa'],
            'estatus'       => 'pendiente',
            'folio_externo'       => '',
            'estatus_externo'  => 0

        ];

        DB::table('solicitudes_hist')
            ->insert($data1);

        if ($res[0]->id_tramite == 3) {
            $descripcion = '';
            foreach ($request['respuesta-regresar'] as $respuesta) {

                switch ($respuesta) {
                    case 1:
                        $descripcion = $descripcion . "<font color='#000000'><li> Licencia de conducir vencida. </li></font>";
                        break;
                    case 2:
                        $descripcion = $descripcion . "<font color='#000000'><li> Tarjeta de circulación vencida. </li></font>";
                        break;
                    case 3:
                        $descripcion = $descripcion . "<font color='#000000'><li> No se acredita propiedad, posesión o relación con el titular del vehículo. </li></font>";
                        break;
                    case 4:
                        $descripcion = $descripcion . "<font color='#000000'><li> No exhibe constancia o credencial de discapacidad temporal o permanente. </li></font>";
                        break;
                    case 5:
                        $descripcion = $descripcion . "<font color='#000000'><li> No especifica el tiempo por el cual la movilidad se ve reducida para la acreditación temporal. </li></font>";
                        break;
                    case 6:
                        $descripcion = $descripcion . "<font color='#000000'><li> Documentos no legibles. </li></font>";
                        break;
                    case 7:
                        $descripcion = $descripcion . "<font color='#000000'><li> No se acredita la necesidad de ser trasladado con los documentos. </li></font>";
                        break;
                    case 8:
                        $descripcion = $descripcion . "<font color='#000000'><li> El certificado médico o constancia de discapacidad no son válidas. </li></font>";
                        break;
                    case 9:
                        $descripcion = $descripcion . "<font color='#000000'><li> " . $request['descripcion'] . "</li></font>";
                        break;
                }
            }

            $data = ['descripcion' => "<font color='#000000'>" . $descripcion . "</font><font color='#000000'><br>Favor de ingresar al portal para continuar con el procedimiento respecto a tu solicitud con <strong>folio: " . $request['id_solicitud'] . "</strong>.
                Si tienes alguna duda por favor comunícate al: <br><br></font><font color='#000000'>
                3338182200 ext. 3509, 3529, 3570 y 4590 (Unidad Basílica) <br>
                3338182200 ext. 2961 (CISZ) <br>
                3338182200 ext. 3596, 3598 (Guadalupe y periférico)</font>"];
        }


        $data += [
            'id_emisor'       => session('id_usuario'),
            'id_receptor'     => $request['id_usuario'],
            'id_coordinacion' => $request['id_coordinacion'],
            'titulo'          => 'Solicitud regresada',
            'id_solicitud'    => $request['id_solicitud']
        ];

        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], 'Solicitud regresada', $data['descripcion'], $request['logo']));


            //Cambiamos el estatus de la solicitud
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => $request['id_etapa'], 'estatus' => 'pendiente', 'update_at' => date('Y-m-d H:i:s')]);
        } else {
            return false;
        }
    }

    public static function continuar($request)
    {

        $res = DB::table('solicitudes')
            ->where('id_solicitud', '=', $request['id_solicitud'])
            ->get();

        $data1 = [
            'id_solicitud'  => $request['id_solicitud'],
            'id_usuario'    => $request['id_usuario'],
            'id_revisor'    => session('id_usuario'),
            'id_tramite'    => $res[0]->id_tramite,
            'id_etapa'      => $request['id_etapa'],
            'estatus'       => 'autorizado',
            'folio_externo'       => '',
            'estatus_externo'  => 0
        ];

        DB::table('solicitudes_hist')
            ->insert($data1);

        if ($request['id_tramite'] == 3) {

            $result = Acreditaciones_model::acepta_solicitud_ac($request);

            if ($result) {
                $sol = $result[0];
                $fecha_fin = $sol->fecha_vigencia;
                $folio_acreditacion = $sol->folio_acreditacion;
            } else {
                $fecha_fin = "";
                $folio = "";
            }

            Solicitudes_model::inserta_dato_solicitud("fecha_fin", $fecha_fin, 3, $request['id_solicitud'], 11);
            Solicitudes_model::inserta_dato_solicitud("folio_acreditacion", $folio_acreditacion, 3, $request['id_solicitud'], 11);



            $data = [
                'id_emisor'       => session('id_usuario'),
                'id_receptor'     => $request['id_usuario'],
                'id_coordinacion' => $request['id_coordinacion'],
                'titulo'          => 'Solicitud autorizada',
                'descripcion'     => 'Tu acreditación ha sido autorizada satisfactoriamente bajo el <strong>folio: ' . $request['id_solicitud'] . '</strong>. Puedes recogerla en la oficina ' . $request['oficina'] . ', en un horario de 9:00 a 15:00 horas.',
                'id_solicitud'    => $request['id_solicitud']
            ];
        } else {
            $data = [
                'id_emisor'       => session('id_usuario'),
                'id_receptor'     => $request['id_usuario'],
                'id_coordinacion' => $request['id_coordinacion'],
                'titulo'          => 'Solicitud autorizada',
                'descripcion'     => 'Tu solicitud ha sido autorizada, puedes continuar con el siguiente paso',
                'id_solicitud'    => $request['id_solicitud']
            ];
        }


        if (DB::table('notificaciones')->insert($data)) {

            //Enviamos el correo
            Mail::to($request['correo'])->bcc(env('MAIL_BCC'))->send(new Notificacion($request['correo'], $data['titulo'], $data['descripcion'], $request['logo']));


            //Cambiamos el estatus de la solicitud
            return DB::table('solicitudes')
                ->where('id_solicitud', $request['id_solicitud'])
                ->update(['id_etapa' => $request['id_etapa'], 'estatus' => $request['estatus'], 'update_at' => date('Y-m-d H:i:s')]);
        } else {
            return false;
        }
    }

    public static function consulta_ultimo_folio($id_tramite)
    {
        $sql = 'SELECT max(id_solicitud) as folio FROM solicitudes s  where id_usuario=? and id_tramite = ?';
        $result = DB::select($sql, array(session('id_usuario'), $id_tramite));
        return $result;
    }


    public static function inserta_datos_solicitud($request, $id_tramite, $id_solicitud, $etapa)
    {
        $num_rows = 0;

        foreach ($request->all() as $key => $value) {
            $num_rows += DB::insert(
                'insert into datos_solicitudes
            (id_solicitud,id_usuario,id_tramite,id_etapa,campo,
            dato,created_at)
             values (?,?,?,?,?,?,CURRENT_TIMESTAMP)',
                [$id_solicitud, session('id_usuario'), $id_tramite, $etapa, $key, $value]
            );
        }

        return $num_rows;
    }


    public static function actualiza_datos_solicitud($request, $id_tramite, $id_solicitud,  $etapa)
    {
        $num_rows = 0;
        //$sql = "DELETE FROM datos_solicitudes   where id_usuario=? and id_tramite =? and id_solicitud=? and id_etapa=?;";
        //DB::delete($sql, array(session('id_usuario'), $id_tramite, $id_solicitud, $etapa));

        DB::table('datos_solicitudes')
            ->where('id_solicitud', $id_solicitud)
            ->delete();

        foreach ($request->all() as $key => $value) {
            $num_rows += DB::insert(
                'insert into datos_solicitudes
                (id_solicitud,id_usuario,id_tramite,id_etapa,campo,
                dato,created_at)
                values (?,?,?,?,?,?,CURRENT_TIMESTAMP)',
                [$id_solicitud, session('id_usuario'), $id_tramite, $etapa, $key, $value]
            );
        }

        return $num_rows;
    }

    public static function actualiza_etapa_solicitud($id_solicitud, $etapa, $estatus, $id_captura, $edo_externo)
    {
        $num_rows = 0;
        $sql = "UPDATE solicitudes  SET id_etapa=?, estatus=?, update_at=? where  id_solicitud=? ;";
        $sql = "select * from actualiza_etapa_solicitud(?,?,?,?,?);";

        $num_rows = DB::update($sql, array($etapa, $id_solicitud, $estatus, $id_captura, $edo_externo));
        return $num_rows;
    }

    public static function inserta_dato_solicitud($campo, $valor, $id_tramite, $id_solicitud, $etapa)
    {
        $num_rows = 0;

        $num_rows += DB::insert(
            'insert into datos_solicitudes
            (id_solicitud,id_usuario,id_tramite,id_etapa,campo,
            dato,created_at)
             values (?,?,?,?,?,?,CURRENT_TIMESTAMP)',
            array($id_solicitud, session('id_usuario'), $id_tramite, $etapa, $campo, $valor)
        );
    }

    public static function balanza($id_etapa)
    {

        $result = DB::table('solicitudes as s')
            ->select(DB::raw('ru.id_usuario, count(s.id_revisor) as total'))
            ->rightJoin('roles_usuarios as ru', 'ru.id_usuario', '=', 's.id_revisor')
            ->join('roles_etapas as re', 're.id_rol_etapa', '=', 'ru.id_rol_etapa')
            ->join('usuarios as u', 'u.id_usuario', '=', 'ru.id_usuario')
            ->where('re.id_etapa',  $id_etapa)
            ->where('u.estatus', 'activo')
            ->groupBy('ru.id_usuario')
            ->orderBy('total', 'asc')
            ->first();


        // return $result->id_usuario;
    }

    public static function inserta_notificacion($data)
    {
        DB::table('notificaciones')->insert($data);
    }
}
