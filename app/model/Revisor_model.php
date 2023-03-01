<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class Revisor_model extends Model
{
    /**
     * Administrador
     * 
     * Obtiene todos los revisores que pertenecen a 
     * x coordinacion
     */

    public static function get_all_by_coordinacion()
    {
        
        return DB::table('roles_usuarios as ru')
            ->join('roles_etapas as re', 'ru.id_rol_etapa', '=', 're.id_rol_etapa')
            ->join('cat_tramites as ct', 'ct.id_tramite', '=', 're.id_tramite')
            ->join('usuarios as u', 'u.id_usuario', '=', 'ru.id_usuario')
            ->select('u.id_usuario', 'u.correo', 'u.estatus', 'ct.tramite')
            ->where('ct.id_coordinacion', session('id_coordinacion'))
            ->where('u.id_usuario', '!=', session('id_usuario'))
            ->get();
    }

    public static function post($request)
    {

        $id_usuario = DB::table('usuarios')
            ->insertGetId([
                'id_coordinacion' => session('id_coordinacion'),
                'correo'          => $request['correo'],
                'tipo'            => 'revisor',
                'tipo_persona'    => 'fisica',
                'contrasena'      =>  Crypt::encryptString($request['contrasena']),
                'estatus'         =>  $request['estatus'],
                'token'           =>  Crypt::encryptString($request['contrasena']),
                'created_at'      =>  date('Y-m-d H:i:s'),
                'num_empleado'    =>  $request['num_empleado']
            ], 'id_usuario');

        DB::table('datos_personales')
            ->where('id_usuario', $id_usuario)
            ->update([
                'nombre'           => ucfirst($request['nombre']),
                'primer_apellido'  => ucfirst($request['primer_apellido']),
                'segundo_apellido' => ucfirst($request['segundo_apellido']),
            ]);

        if ($request['tramite'] == 1) {
            return DB::table('roles_usuarios')
                ->insert([
                    'id_rol_etapa'        => 9,
                    'id_usuario'          => $id_usuario,
                    'id_administrativo'   => 1,
                    'created_at'          => date('Y-m-d H:i:s'),
                ]);
        } else if ($request['tramite'] == 2) {
            return DB::table('roles_usuarios')
                ->insert([
                    'id_rol_etapa'        => 10,
                    'id_usuario'          => $id_usuario,
                    'id_administrativo'   => 1,
                    'created_at'          => date('Y-m-d H:i:s'),
                ]);
        } else if ($request['tramite'] == 3) {
            return DB::table('roles_usuarios')
                ->insert([
                    'id_rol_etapa'        => 8,
                    'id_usuario'          => $id_usuario,
                    'id_administrativo'   => 1,
                    'created_at'          => date('Y-m-d H:i:s'),
                ]);
        } else if ($request['tramite'] == 4) {
            return DB::table('roles_usuarios')
                ->insert([
                    'id_rol_etapa'        => 11,
                    'id_usuario'          => $id_usuario,
                    'id_administrativo'   => 1,
                    'created_at'          => date('Y-m-d H:i:s'),
                ]);
        }
    }

    public static function put($request)
    {


        $total = DB::table('roles_usuarios as ru')
            ->join('usuarios as u', 'ru.id_usuario', '=', 'u.id_usuario')
            ->where([
                ['ru.id_rol_etapa', '=', $request['id_rol_etapa']],
                ['ru.id_usuario', '!=', $request['id_usuario']],
                ['u.estatus', '=', 'activo'],
            ])
            ->count();

        if ($total == 0) {
            return false;
        }

        $datos = [
            'correo'        =>  $request['correo'],
            'estatus'       =>  $request['estatus'],
            'update_at'     =>  date('Y-m-d H:i:s'),
            'num_empleado'  =>  $request['num_empleado']
        ];

        if (!empty($request['contrasena']) && !empty($request['ccontrasena'])) {
            $datos += [
                'contrasena' =>  Crypt::encryptString($request['contrasena']),
                'token'      =>  Crypt::encryptString($request['contrasena'])
            ];
        }

        DB::table('usuarios')
            ->where('id_usuario', $request['id_usuario'])
            ->update($datos);

        DB::table('datos_personales')
            ->where('id_usuario', $request['id_usuario'])
            ->update([
                'nombre'           => ucfirst($request['nombre']),
                'primer_apellido'  => ucfirst($request['primer_apellido']),
                'segundo_apellido' => ucfirst($request['segundo_apellido']),
            ]);

        DB::table('roles_usuarios_hist')
            ->insert([
                'id_rol_usuario'   => $request['id_rol_usuario'],
                'id_usuario'       => $request['id_usuario'],
                'id_administrador' => session('id_usuario'),
                'update_at'        => date('Y-m-d H:i:s')
            ]);

        if ($request['tramite'] == 1) {
            return DB::table('roles_usuarios')
                ->where('id_rol_usuario', $request['id_rol_usuario'])
                ->update(['id_rol_etapa' => 9]);
        } else if ($request['tramite'] == 2) {
            return DB::table('roles_usuarios')
                ->where('id_rol_usuario', $request['id_rol_usuario'])
                ->update(['id_rol_etapa' => 10]);
        } else if ($request['tramite'] == 3) {
            return DB::table('roles_usuarios')
                ->where('id_rol_usuario', $request['id_rol_usuario'])
                ->update(['id_rol_etapa' => 8]);
        } else if ($request['tramite'] == 4) {
            return DB::table('roles_usuarios')
                ->where('id_rol_usuario', $request['id_rol_usuario'])
                ->update(['id_rol_etapa' => 11]);
        }
    }

    public static function remove()
    {
    }
}
