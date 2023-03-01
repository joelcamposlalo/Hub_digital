<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catastro_model extends Model
{
    public static function get_by_cuenta($cuenta)
    {
        $sql = "SELECT * FROM vd_consulta_cuenta(?, ?);";

        if (strlen($cuenta) == 10) {

            $result = DB::connection('catastro')->select($sql, array($cuenta, null));
        } elseif (strlen($cuenta) == 31) {

            $result = DB::connection('catastro')->select($sql, array(null, $cuenta));
        } else
            $result = false;


        return $result;
    }
}
