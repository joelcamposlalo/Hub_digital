<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;


class Parkimetros_model extends Model
{
    use HasFactory;


    public static function get_multas($request)
    {

        $sql = "select m.folio as folio,m.placa as placa,FORMAT  (m.fecha, 'dd/MM/yyyy') as fecha,i.Descripcion as tipo_infraccion  from multas  m join  Infracciones i on m.idinfraccion=i.IdInfraccion where m.placa=? and m.estatus='Activo' or m.placa=? and m.estatus='Activo' or m.placa=? and m.estatus='Activo' order by m.fecha desc";
        return DB::connection('parkimetros')->select($sql, array($request->placa, $request->placa2, $request->placa3));
    }
}
