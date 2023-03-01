<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Predios_model extends Model
{
    public static function get_all($n)
    {
        /*return DB::table('predios')
            ->where('id_usuario', '=', session('id_usuario'))
            //->paginate(5);
            ->get();*/

            return DB::table('predios')
                ->where('id_usuario', '=', session('id_usuario'))
                ->orderByRaw('id_predio')
                ->limit(5)
                ->offset($n)
                ->get();
    }

    public static function get_count()
    {
        return DB::table('predios')
            ->where('id_usuario', '=', session('id_usuario'))
            ->orderByRaw('id_predio')
            ->count();
    }

    public static function get_all_predios()
    {
        return DB::table('predios')
            ->where('id_usuario', '=', session('id_usuario'))
            ->get();

    }

    /**
     * Muestra todos los predios junto con
     * sus propietarios
     */

    public static function get_all_users($total, $curt)
    {

        $id_coordinacion = session('id_coordinacion');

        if (!empty($curt)) {
            return DB::table('predios as p')
                ->selectRaw('DISTINCT p.id_predio, u.id_usuario, dp.razon_social, dp.nombre, dp.primer_apellido, dp.segundo_apellido, dp.telefono, p.curt, u.perfil')
                ->join('usuarios as u', 'p.id_usuario', '=', 'u.id_usuario')
                ->join('datos_personales as dp', 'u.id_usuario', '=', 'dp.id_usuario')
                ->join('solicitudes as sol', 'sol.id_usuario', '=', 'u.id_usuario')
                ->join('cat_tramites as t', 't.id_tramite', '=', 'sol.id_tramite')
                ->where('u.tipo', '=', 'ciudadano')
                ->where('t.id_coordinacion', '=', $id_coordinacion)
                ->where('p.curt', 'ilike', "%$curt%")
                ->get();
        } else {
            return DB::table('predios as p')
                ->selectRaw('DISTINCT p.id_predio, u.id_usuario, dp.razon_social, dp.nombre, dp.primer_apellido, dp.segundo_apellido, dp.telefono, p.curt, u.perfil')
                ->join('usuarios as u', 'p.id_usuario', '=', 'u.id_usuario')
                ->join('datos_personales as dp', 'u.id_usuario', '=', 'dp.id_usuario')
                ->join('solicitudes as sol', 'sol.id_usuario', '=', 'u.id_usuario')
                ->join('cat_tramites as t', 't.id_tramite', '=', 'sol.id_tramite')
                ->where('u.tipo', '=', 'ciudadano')
                ->where('t.id_coordinacion', '=', $id_coordinacion)
                ->simplePaginate($total);
        }
    }

    public static function get_by_id($id)
    {
    }

    public static function post($datos)
    {

        $data = [
            'id_usuario'        => session('id_usuario'),
            'cuenta_predial'    => $datos['cuenta'],
            'curt'              => $datos['curt'],
            'poligono'          => $datos['poligono']
        ];


        $total = DB::table('predios')
            ->where('id_usuario', '=', session('id_usuario'))
            ->where('curt', '=', $datos['curt'])
            ->count();

        if ($datos['origen'] == 'predio') {
            if ($total == 0) {

                if (DB::table('predios')->insert($data)) {

                    session()->flash('alert', [
                        'type' => 'success',
                        'msg'  => 'El predio se agrego correctamente'
                    ]);
                } else {

                    session()->flash('alert', [
                        'type' => 'danger',
                        'msg'  => 'Ocurrió un error al intentar agregar el predio, por favor intenta nuevamente'
                    ]);
                }
            }

            Redirect::to(url('ciudadano/predios'))->send();
        } else {

            if ($total == 0) {

                return DB::table('predios')->insert($data);
            } else {

                return false;
            }
        }
    }

    public static function updated($callback)
    {
    }

    public static function deleted($id_predio)
    {
        return DB::table('predios')
            ->where('id_predio', $id_predio)
            ->delete();
    }
}
