<?php

namespace App\Http\Controllers;

use App\model\Parkimetros_model;
use Illuminate\Http\Request;


class Parkimetros extends Controller
{


    public function get_multas(Request $request)
    {

        if ($multas = Parkimetros_model::get_multas($request)) {

            return $multas;
        } else {

            return false;
        }
    }
}
