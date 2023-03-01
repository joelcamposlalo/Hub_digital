<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tramites_model extends Model
{

    public static function get_all_by_coordinacion()
    {
        return DB::table('cat_tramites')
            ->where('id_coordinacion', session('id_coordinacion'))
            ->get();
    }
}
