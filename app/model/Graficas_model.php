<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Graficas_model extends Model
{

    public static function solicitudes_estatus($request)
    {

        //Obtener tramite del revisor en base al id usuario
        $roles_usuario = DB::table('roles_usuarios as ru')
            ->select('re.id_tramite', 'ru.id_usuario')
            ->join('roles_etapas as re', 're.id_rol_etapa', '=', 'ru.id_rol_etapa')
            ->where('ru.id_usuario', session('id_usuario'))
            ->first();
        if ($request['fecha_inicio'] != '' && $request['fecha_fin'] == '') {
            return DB::table('solicitudes')
                ->select(DB::raw('count(*) as total, estatus'))
                ->groupBy('estatus')
                ->where('eliminado', '=', false)
                ->where('id_tramite', $roles_usuario->id_tramite)
                ->where('id_revisor', session('id_usuario'))
                ->where('created_at', '>=', $request['fecha_inicio'])->get();
        } elseif ($request['fecha_fin'] != '' && $request['fecha_inicio'] == '') {

            return DB::table('solicitudes')
                ->select(DB::raw('count(*) as total, estatus'))
                ->groupBy('estatus')
                ->where('eliminado', '=', false)
                ->where('id_tramite', $roles_usuario->id_tramite)
                ->where('id_revisor', session('id_usuario'))
                ->where('created_at', '<=', $request['fecha_fin'])->get();
        } elseif ($request['fecha_inicio'] != '' &&  $request['fecha_fin'] != '') {

            return DB::table('solicitudes')
                ->select(DB::raw('count(*) as total, estatus'))
                ->groupBy('estatus')
                ->where('eliminado', '=', false)
                ->where('id_tramite', $roles_usuario->id_tramite)
                ->where('id_revisor', session('id_usuario'))
                ->where('created_at', '>=', $request['fecha_inicio'])
                ->where('created_at', '<=', $request['fecha_fin'])->get();
        } else {
            return DB::table('solicitudes')
                ->select(DB::raw('count(*) as total, estatus'))
                ->groupBy('estatus')
                ->where('eliminado', '=', false)
                ->where('id_revisor', session('id_usuario'))
                ->where('id_tramite', $roles_usuario->id_tramite)->get();
        }
    }


    public static function solicitudes_revisor($request)
    {

        if ($request['fecha_inicio'] != '' && $request['fecha_fin'] == '') {
            return DB::table('solicitudes as s')
                ->selectRaw('count(*) as total, u.correo, s.estatus')
                ->join('usuarios as u', 'u.id_usuario', '=', 's.id_revisor')
                ->join('roles_usuarios as ru', 'ru.id_usuario', '=', 's.id_revisor')
                ->where([
                    ['s.created_at', '>=', $request['fecha_inicio']],
                    ['s.estatus', '=', 'autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->orWhere([
                    ['s.created_at', '>=', $request['fecha_inicio']],
                    ['s.estatus', '=', 'no autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->groupBy('u.correo')
                ->groupBy('s.estatus')
                ->get();
        } elseif ($request['fecha_fin'] != '' && $request['fecha_inicio'] == '') {

            return DB::table('solicitudes as s')
                ->selectRaw('count(*) as total, u.correo, s.estatus')
                ->join('usuarios as u', 'u.id_usuario', '=', 's.id_revisor')
                ->join('roles_usuarios as ru', 'ru.id_usuario', '=', 's.id_revisor')
                ->where([
                    ['s.created_at', '<=', $request['fecha_fin']],
                    ['s.estatus', '=', 'autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->orWhere([
                    ['s.created_at', '<=', $request['fecha_fin']],
                    ['s.estatus', '=', 'no autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->groupBy('u.correo')
                ->groupBy('s.estatus')
                ->get();
        } elseif ($request['fecha_inicio'] != '' &&  $request['fecha_fin'] != '') {

            return DB::table('solicitudes as s')
                ->selectRaw('count(*) as total, u.correo, s.estatus')
                ->join('usuarios as u', 'u.id_usuario', '=', 's.id_revisor')
                ->join('roles_usuarios as ru', 'ru.id_usuario', '=', 's.id_revisor')
                ->where([
                    ['s.created_at', '>=', $request['fecha_inicio']],
                    ['s.created_at', '<=', $request['fecha_fin']],
                    ['s.estatus', '=', 'autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->orWhere([
                    ['s.created_at', '>=', $request['fecha_inicio']],
                    ['s.created_at', '<=', $request['fecha_fin']],
                    ['s.estatus', '=', 'no autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->groupBy('u.correo')
                ->groupBy('s.estatus')
                ->get();
        } else {
            return DB::table('solicitudes as s')
                ->selectRaw('count(*) as total, u.correo, s.estatus')
                ->join('usuarios as u', 'u.id_usuario', '=', 's.id_revisor')
                ->join('roles_usuarios as ru', 'ru.id_usuario', '=', 's.id_revisor')
                ->where([
                    ['s.estatus', 'autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->orWhere([
                    ['s.estatus', 'no autorizado'],
                    ['u.tipo', '=', 'revisor']
                ])
                ->groupBy('u.correo')
                ->groupBy('s.estatus')
                ->get();
        }
    }
}
