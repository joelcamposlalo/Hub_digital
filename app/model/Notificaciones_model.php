<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificaciones_model extends Model
{


    /**
     * Marca como visto la notificación
     * 
     */

    public static function visto($id_notificaciones)
    {

        return DB::table('notificaciones')
            ->where('id_notificacion', $id_notificaciones)
            ->update(['visto' => true]);
    }


    /**
     * Eliminar la notificación
     * 
     */

    public static function eliminar($id_notificaciones)
    {
        return DB::table('notificaciones')
            ->where('id_notificacion', $id_notificaciones)
            ->update(['eliminado' => true]);
    }


    /**
     * Obtiene todas las solicitudes de un 
     * usuario logeado
     * 
     * @return object
     */

    public static function get_all_by_session()
    {

        return DB::table('notificaciones as n')
            ->select('n.descripcion as desc', 'n.created_at as fecha', '*')
            ->join('usuarios as u', 'u.id_usuario', '=', 'n.id_emisor')
            ->join('solicitudes as s', 's.id_solicitud', '=', 'n.id_solicitud')
            ->join('cat_tramites as t', 't.id_tramite', '=', 's.id_tramite')
            ->where('n.id_receptor', session('id_usuario'))
            ->where('n.eliminado', false)
            ->orderBy('id_notificacion', 'desc')
            ->get();
    }


    /**
     * 
     * Obtiene las observaciones del revisor
     * hacia el ciudadano
     * 
     */


    public static function get_observacion($id_solicitud)
    {
        return DB::table('notificaciones')
            ->where('id_receptor', session('id_usuario'))
            ->where('id_solicitud', $id_solicitud)
            ->orderByDesc('id_notificacion')
            ->first();
    }
}
