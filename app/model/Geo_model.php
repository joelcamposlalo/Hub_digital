<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Geo_model extends Model
{
    use HasFactory;

    public static function get_uso_suelo($lat,$lon)
    {
        $sql = "SELECT  *  FROM gestion_vocacion_ppdu_2012.ppdu_distritos where ST_Intersects(geom,
        ST_Transform(ST_GeomFromText('POINT(? ?)',4326),32613)) group by gid;";

        $result = DB::connection('geo')->select($sql, array(null, $lon, $lat));
        

        return $result;
    }
    public static function get_plan_parcial($lat,$lon)
    {
        $sql = "SELECT  ST_Extent(st_transform (ST_Buffer(ppdu_zonificacion_manzana.geom,40::double precision) , 4326)) AS extent ,gid,distrito,sup2_m2,clas_area1,clav_cla_1,clas_area2,clav_cla_2,uso_suelo,clav_uso_s,intensidad,modalidad,clav_inten,densidad,densidad_n,zonif_prim,clav_final,area_urb,riesgo
        FROM gestion_vocacion_ppdu_2012.ppdu_zonificacion_manzana where ST_Intersects(geom,
               ST_Transform(ST_GeomFromText('POINT(? ?)',4326),32613)) group by gid ;";

        $result = DB::connection('geo')->select($sql, array(null, $lon, $lat));
        

        return $result;
    }
}
