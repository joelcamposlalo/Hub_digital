<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Dias_inhabiles_model extends Model
{
    use HasFactory;


    public static function get_all()
    {
        return DB::table('dias_festivos_dependencia as d')
            ->select('d.descripcion as desc', '*')
            ->join('cat_tramites as c', 'd.id_tramite', '=', 'c.id_tramite')
            ->where('d.id_coordinacion', session('id_coordinacion'))
            ->orderByDesc('d.id_dia')
            ->get();
    }

    public static function get_by_id($id)
    {
        return DB::table('dias_festivos_dependencia as d')
            ->select('d.descripcion as desc', '*')
            ->join('cat_tramites as c', 'd.id_tramite', '=', 'c.id_tramite')
            ->where('id_dia', $id)
            ->first();
    }

    public static function post($request)
    {

        $fechas = explode(':', $request['fecha']);

        foreach ($fechas as  $item) {

            //Verifica que sea unico 
            $total = DB::table('dias_festivos_dependencia')
                ->where([
                    ['fecha', $item],
                    ['id_tramite', $request['tramite']]
                ])
                ->count();


            if ($total == 0) {

                $data = [
                    'fecha'           => $item,
                    'id_coordinacion' => session('id_coordinacion'),
                    'descripcion'     => $request['descripcion'],
                    'created_at'      => date('Y-m-d H:i:s'),
                    'id_tramite'      => $request['tramite']
                ];

                DB::table('dias_festivos_dependencia')
                    ->insert($data);
            } else {

                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'La fecha [' . $item . '] con el trámite seleccionado ya está registrado, seleccione otra fecha u otro trámite'
                ]);

                return false;
            }
        }

        return true;
    }

    public static function put($request)
    {

        //Verifica que sea unico 
        $total = DB::table('dias_festivos_dependencia')
            ->where([
                ['fecha', $request['fecha']],
                ['id_tramite', $request['tramite']],
                ['id_dia', '!=', $request['id_dia']]
            ])
            ->count();

        if ($total == 0) {

            $data = [
                'fecha'           => $request['fecha'],
                'id_coordinacion' => session('id_coordinacion'),
                'descripcion'     => $request['descripcion'],
                'id_tramite'      => $request['tramite'],
                'updated_at'      => date('Y-m-d H:i:s')
            ];

            return DB::table('dias_festivos_dependencia')
                ->where('id_dia', $request['id_dia'])
                ->update($data);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'La fecha [' . $request['fecha'] . '] con el trámite seleccionado ya está registrado, seleccione otra fecha u otro trámite'
            ]);

            return false;
        }
    }

    public static function remove($id_dia)
    {

        return DB::table('dias_festivos_dependencia')
            ->where('id_dia', $id_dia)
            ->delete();
    }
}
