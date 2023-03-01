<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class Ciudadano_model extends Model
{


    public static function get_all()
    {
    }

    public static function get_by_id($id_usuario)
    {
        return DB::table('usuarios as u')
            ->join('datos_personales as dp', 'dp.id_usuario', '=', 'u.id_usuario')
            ->join('roles_usuarios as ru', 'ru.id_usuario', '=', 'u.id_usuario')
            ->join('roles_etapas as re', 're.id_rol_etapa', '=', 'ru.id_rol_etapa')
            ->where('u.id_usuario', '=', $id_usuario)
            ->first();
    }

    public static function get_all_by_id()
    {
        $datos_personales = DB::table('datos_personales')
            ->where('id_usuario', '=', session('id_usuario'))->first();

        return $datos_personales;
    }

    public static function get_by_name($total, $name)
    {

        $id_coordinacion = session('id_coordinacion');

        if (!empty($name)) {

            return DB::table('usuarios as u')
                ->selectRaw('DISTINCT u.perfil, u.id_usuario, dp.telefono, dp.razon_social, dp.nombre, (SELECT count(*) from solicitudes s WHERE s.id_usuario = u.id_usuario) as solicitudes , (SELECT count(*) from predios p WHERE p.id_usuario = u.id_usuario) as predios')
                ->join('datos_personales as dp', 'dp.id_usuario', '=', 'u.id_usuario')
                ->join('solicitudes as sol', 'sol.id_usuario', '=', 'u.id_usuario')
                ->join('cat_tramites as t', 't.id_tramite', '=', 'sol.id_tramite')
                ->where([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                    ['dp.nombre', 'ilike', "%$name%"]
                ])
                ->orWhere([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                    ['u.correo', 'ilike', "%$name%"]
                ])
                ->orWhere([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                    ['dp.curp', 'ilike', "%$name%"]
                ])
                ->orWhere([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                    ['dp.telefono', 'ilike', "%$name%"]
                ])
                ->orWhere([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                    ['dp.razon_social', 'ilike', "%$name%"]
                ])
                ->get();
        } else {
            return DB::table('usuarios as u')
                ->selectRaw('DISTINCT u.perfil, u.id_usuario, dp.telefono, dp.razon_social, dp.nombre, (SELECT count(*) from solicitudes s WHERE s.id_usuario = u.id_usuario) as solicitudes , (SELECT count(*) from predios p WHERE p.id_usuario = u.id_usuario) as predios')
                ->join('datos_personales as dp', 'dp.id_usuario', '=', 'u.id_usuario')
                ->join('solicitudes as sol', 'sol.id_usuario', '=', 'u.id_usuario')
                ->join('cat_tramites as t', 't.id_tramite', '=', 'sol.id_tramite')
                ->where([
                    ['u.tipo', '=', 'ciudadano'],
                    ['t.id_coordinacion', '=', $id_coordinacion],
                ])
                ->simplePaginate($total);
        }
    }

    public static function post($datos)
    {

        $data = [
            'rfc'               => strtoupper($datos['rfc']),
            'telefono'          => $datos['telefono'],
            'calle'             => ucwords(mb_strtolower($datos['calle'])),
            'no_exterior'       => $datos['no_exterior'],
            'letra_exterior'    => strtoupper($datos['letra_exterior']),
            'no_interior'       => $datos['no_interior'],
            'letra_interior'    => strtoupper($datos['letra_interior']),
            'colonia'           => ucwords(mb_strtolower($datos['colonia'])),
            'municipio'         => ucwords(mb_strtolower($datos['municipio'])),
            'cp'                => $datos['cp'],
            'latitud'           => $datos['latitud'],
            'longitud'          => $datos['longitud'],
            'contactar'         => isset($datos['contactar']) ? true : false
        ];

        if (session('tipo_persona') === 'fisica') {
            $data += [
                'nombre'            => ucwords(mb_strtolower($datos['nombre'])),
                'primer_apellido'   => ucwords(mb_strtolower($datos['primer_apellido'])),
                'segundo_apellido'  => ucwords(mb_strtolower($datos['segundo_apellido'])),
                'curp'              => strtoupper($datos['curp'])
            ];

            session([
                'nombre'        => ucwords(mb_strtolower($data['nombre'])),
                'primer_apellido'   => ucwords(mb_strtolower($datos['primer_apellido'])),
                'segundo_apellido'  => ucwords(mb_strtolower($datos['segundo_apellido'])),
                'curp'              => strtoupper($datos['curp'])
            ]);
        } else if (session('tipo_persona') === 'moral') {
            $data += [
                'razon_social'      =>  $datos['razon_social']
            ];

            session(['razon_social'  => $data['razon_social']]);
        }

        DB::table('usuarios')
            ->where('id_usuario', '=', session('id_usuario'))
            ->update(['primera_vista' => true]);

        session([
            'primera_vista' => true,
            'domicilio'     => ((($data['calle'] != "") ? $data['calle'] . "," : "") . (($data['no_exterior'] != "") ? $data['no_exterior'] . "," : "") . (($data['letra_exterior'] != "") ? $data['letra_exterior'] . "," : "") . (($data['no_interior'] != "") ? $data['no_interior'] . "," : "") . (($data['letra_interior'] != "") ? $data['letra_interior'] . "," : "") . (($data['colonia'] != "") ? $data['colonia'] . "," : "") . (($data['municipio'] != "") ? $data['municipio'] : "")),
            'no_exterior'       => $datos['no_exterior'],
            'letra_exterior'    => $datos['letra_exterior'],
            'no_interior'       => $datos['no_interior'],
            'letra_interior'    => $datos['letra_interior'],
            'colonia'           => $datos['colonia'],
            'municipio'         => $datos['municipio'],
            'cp'                => $datos['cp'],
            'telefono'          => $data['telefono'],
            'contactar'         => $data['contactar'],
            'rfc'               => $data['rfc']
        ]);
        return DB::table('datos_personales')
            ->where('id_usuario', '=', session('id_usuario'))
            ->update($data);
    }

    public static function perfil()
    {

        return DB::table('usuarios')
            ->where('id_usuario', '=', session('id_usuario'))
            ->update(['perfil' => 'perfil.jpg']);
    }

    /**
     * 
     * Obtiene toda la informacion del ciudadano
     * en la vista de administrador
     * 
     * @return array
     */


    public static function get_detalle($id_usuario)
    {

        $ciudadano = DB::table('usuarios as u')
            ->join('datos_personales as dp', 'dp.id_usuario', '=', 'u.id_usuario')
            ->where('u.id_usuario', '=', $id_usuario)
            ->first();


        $archivos = DB::table('archivos_expediente as a')
            ->select('a.nombre as archivo', 'ca.nombre as nombre', '*')
            ->join('cat_archivo as ca', 'ca.id_cat_archivo', '=', 'a.id_cat_archivo')
            ->where('a.id_usuario', $id_usuario)
            ->where('ca.universal', true)
            ->get();

        $predios  = DB::table('predios')
            ->where('id_usuario', $id_usuario)
            ->get();

        return [
            'datos'     => $ciudadano,
            'archivos'  => $archivos,
            'predios'   => $predios
        ];
    }

    /**
     * Muestra los archivos 
     */

    public static function get_files()
    {

        $terminados = DB::table('archivos_expediente as a')
            ->select('a.nombre as name', 'ca.nombre as nombre_archivo', '*')
            ->join('cat_archivo as ca', 'a.id_cat_archivo', '=', 'ca.id_cat_archivo')
            ->where([
                ['a.id_usuario', session('id_usuario')],
                ['ca.universal', true]
            ])
            ->get();

        $pendientes = DB::select("SELECT c.id_cat_archivo, c.nombre, c.descripcion_larga FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos_expediente as a WHERE c.id_cat_archivo = a.id_cat_archivo and a.id_usuario = " . session('id_usuario') . " ) and c.universal = true ");

        return [
            'terminados' => $terminados,
            'pendientes' => $pendientes
        ];
    }

    public static function post_file($request)
    {

        $extension  = $request['file']->extension();
        $filename   = $request['name'] . '.' . $extension;
        $filename   = '0-' . date('YmdHis') . '-' . $filename;

        $path = $request['file']->storeAs('public/' . session('id_usuario'), $filename, 's3');

        if (Storage::disk('s3')->setVisibility($path, 'public')) {

            return DB::table('archivos_expediente')->insert([
                'id_usuario'     => session('id_usuario'),
                'id_cat_archivo' => $request['name'],
                'nombre'         => $filename,
                'extension'      => $extension,
                'created_at'     => date('Y-m-d H:i:s')
            ]);
        } else {
            return false;
        }
    }

    public static function delete_file($request)
    {

        if (Storage::disk('s3')->delete('public/' . session('id_usuario') . '/' . $request['name'])) {

            return DB::table('archivos_expediente')->where('id_archivo', $request['id_archivo'])->delete();
        } else {
            return false;
        }
    }

    public static function calificar($request)
    {

        return DB::table('calificaciones')
            ->insert([
                'id_usuario'   => session('id_usuario'),
                'comentario'   => $request['comentario'],
                'calificacion' => $request['calificacion']
            ]);
    }

    public static function get_count_calificacion()
    {
        return DB::table('calificaciones')
            ->where('id_usuario', session('id_usuario'))
            ->count();
    }

    public static function get_leyenda_vac($coordinacion, $area)
    {
        return DB::table('leyendas')
            ->where([
                ['coordinacion', $coordinacion],
                ['area', $area],
                ['activo', true]
            ])
            ->get();
    }
}
