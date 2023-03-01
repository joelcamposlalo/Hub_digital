<?php

namespace App\model;

use App\Mail\Activar;
use App\Mail\Recuperar;
use FuncInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class Cuenta_model extends Model
{

    public static function auth($correo, $contrasena)
    {

        $usuario = DB::table('usuarios')
            ->select('id_usuario', 'correo', 'contrasena', 'estatus', 'tipo', 'tipo_persona', 'primera_vista', 'perfil', 'id_coordinacion')
            ->where('correo', $correo)->first();


        if (!is_null($usuario)) { // Si el usuario existe

            $permisos = DB::table('roles_usuarios')
                ->select('id_rol_etapa')
                ->where('id_usuario', $usuario->id_usuario)->first();

            $datos_personales = DB::table('datos_personales')
                ->where('id_usuario', $usuario->id_usuario)->first();

            if (Crypt::decryptString($contrasena) === Crypt::decryptString($usuario->contrasena)) { // Si coincide la contraseña

                if ($usuario->estatus === 'activo') { // Si esta activo

                    //Guardar datos en sesión 

                    session([
                        'id_usuario'       => $usuario->id_usuario,
                        'correo'           => $usuario->correo,
                        'tipo'             => $usuario->tipo,
                        'tipo_persona'     => $usuario->tipo_persona,
                        'primera_vista'    => $usuario->primera_vista,
                        'nombre'           => $datos_personales->nombre,
                        'primer_apellido'  => $datos_personales->primer_apellido,
                        'segundo_apellido' => $datos_personales->segundo_apellido,
                        'razon_social'     => $datos_personales->razon_social,
                        'perfil'           => $usuario->perfil,
                        'rfc'              => $datos_personales->rfc,
                        'curp'             => $datos_personales->curp,
                        'cp'               => $datos_personales->cp,
                        'domicilio'        => ((($datos_personales->calle != "") ? $datos_personales->calle . ", " : "") . (($datos_personales->no_exterior != "") ? $datos_personales->no_exterior . ", " : "") . (($datos_personales->letra_exterior != "") ? $datos_personales->letra_exterior . ", " : "") . (($datos_personales->no_interior != "") ? $datos_personales->no_interior . ", " : "") . (($datos_personales->letra_interior != "") ? $datos_personales->letra_interior . ", " : "") . (($datos_personales->colonia != "") ? $datos_personales->colonia . ", " : "") . (($datos_personales->municipio != "") ? $datos_personales->municipio : "")),
                        'telefono'         => $datos_personales->telefono,
                        'id_coordinacion'  => $usuario->id_coordinacion,
                        'contactar'        => $datos_personales->contactar,
                        'calle'            => $datos_personales->calle,
                        'no_exterior'      => $datos_personales->no_exterior,
                        'letra_exterior'   => $datos_personales->letra_exterior,
                        'no_interior'      => $datos_personales->no_interior,
                        'letra_interior'   => $datos_personales->letra_interior,
                        'colonia'          => $datos_personales->colonia,
                        'municipio'        => $datos_personales->municipio
                    ]);


                    switch ($usuario->tipo) {
                        case 'ciudadano':
                            if ($usuario->primera_vista == 0) {
                                Redirect::to(url('ciudadano/expediente'))->send();
                            } else {
                                Redirect::to(url('ciudadano/tramites'))->send();
                            }
                            break;
                        case 'revisor':
                            Redirect::to(url('revisor/solicitudes'))->send();
                            break;
                        case 'administrador':
                            Redirect::to(url('administrador/ciudadanos'))->send();

                            break;
                    }
                } else if ($usuario->estatus === 'inactivo') {

                    $token = Crypt::encryptString($correo);

                    $update = DB::table('usuarios')
                        ->where('id_usuario', '=', $usuario->id_usuario)
                        ->update(['token' => $token]);

                    $insert = DB::table('validacion')->insert([
                        'id_usuario'  => $usuario->id_usuario,
                        'token'       => $token,
                        'estatus'     => 'disponible'
                    ]);

                    if ($update && $insert) { // Se realizaron las consultas correctamente

                        //Mail::to($correo)->send(new Activar($correo, $token));
                        $sql = "EXECUTE capturaweb.dbo.envia_activiacion_cuenta ?,?";
                        $params = array($correo, $token);
                        $result = DB::connection('tramites_op')->select($sql, $params);

                        session()->flash('alert', [
                            'type' => 'danger',
                            'msg'  => 'Tu cuenta no esta verificada, se te envío un correo a: ' . $correo . ' para activarla.',
                        ]);
                    } else {

                        session()->flash('alert', [
                            'type' => 'danger',
                            'msg'  => 'Ocurrió un error, intenta más tarde',
                        ]);
                    }

                    Redirect::to(url('cuenta'))->send();
                } else {

                    session()->flash('alert', [
                        'type' => 'danger',
                        'msg'  => 'Tu cuenta esta suspendida, favor de comunicarte con un administrador'
                    ]);

                    Redirect::to(url('cuenta'))->send();
                }
            } else {

                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'La contraseña no es válida'
                ]);

                Redirect::to(url('cuenta'))->send();
            }
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'El correo: ' . $correo . ' no es válido o no esta registrado'
            ]);

            Redirect::to(url('cuenta'))->send();
        }
    }

    public static function registrarf($correo, $contrasena)
    {

        $token =  Crypt::encryptString($correo);

        $data = [
            'correo'            => $correo,
            'tipo'              => 'ciudadano',
            'tipo_persona'      => 'fisica',
            'contrasena'        => $contrasena,
            'estatus'           => 'inactivo',
            'primera_vista'     => 0,
            'token'             => $token,
        ];

        if (DB::table('usuarios')->insert($data)) {

            //Mail::to($correo)->send(new Activar($correo, $token));
            $sql = "EXECUTE capturaweb.dbo.envia_activiacion_cuenta ?,?";
                        $params = array($correo, $token);
                        $result = DB::connection('tramites_op')->select($sql, $params);


         
            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se te ha enviado un mensaje de activación al correo: ' . $correo
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de registrarte, intenta más tarde'
            ]);
        }

        Redirect::to(url('cuenta/registrof'))->send();
    }

    public static function registrarm($correo, $contrasena)
    {

        $token =  Crypt::encryptString($correo);

        $data = [
            'correo'            => $correo,
            'tipo'              => 'ciudadano',
            'tipo_persona'      => 'moral',
            'contrasena'        => $contrasena,
            'estatus'           => 'inactivo',
            'primera_vista'     => 0,
            'token'             => $token,
        ];

        if (DB::table('usuarios')->insert($data)) {

            Mail::to($correo)->send(new Activar($correo, $token));

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se te ha enviado un mensaje de activación al correo: ' . $correo
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un problema al tratar de registrarte, intenta más tarde'
            ]);
        }

        Redirect::to(url('cuenta/registrom'))->send();
    }

    /**
     * Activar la cuenta por medio del correo 
     * electrónico de activación
     */

    public static function activar($correo, $token)
    {

        $total = DB::table('validacion as v')
            ->join('usuarios as u', 'u.id_usuario', '=', 'v.id_usuario')
            ->where('u.correo', '=', $correo)
            ->where('u.token', '=', $token)
            ->where('v.token',  '=', $token)
            ->where('v.estatus', '=', 'disponible')
            ->count();

        if ($total > 0) { //Existe y esta disponible

            $usuario = DB::table('usuarios')
                ->select('id_usuario', 'correo')
                ->where('correo', '=', $correo)
                ->first();

            Storage::disk('s3')->makeDirectory('public/' . $usuario->id_usuario); //Crear directorio con el id del usuario

            DB::table('validacion')
                ->where('token', '=', $token)
                ->update(['estatus' => 'usado', 'used_at' => date('Y-m-d H:i:s')]);

            DB::table('usuarios')
                ->where('token', '=', $token)
                ->update(['estatus' => 'activo', 'token' => '']);

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'Se activó la cuenta correctamente, por favor, introduce tus credenciales'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'El enlace ya ha sido utilizado o no existe'
            ]);
        }

        Redirect::to(url('cuenta'))->send();
    }

    /**
     * Recuprar contraseña
     */

    public static function recuperar($correo)
    {
        $usuario = DB::table('usuarios')
            ->select('id_usuario', 'correo')
            ->where('correo', $correo)->first();



        if (!is_null($usuario)) {
            $token   =  Crypt::encryptString($correo);

            $update = DB::table('usuarios')
                ->where('id_usuario', '=', $usuario->id_usuario)
                ->update(['token' => $token]);

            $data = [
                'id_usuario'    => $usuario->id_usuario,
                'token'         => $token,
                'estatus'       => 'disponible'
            ];

            if ($update) {

                if (DB::table('validacion')->insert($data)) {

                    //Mail::to($correo)->send(new Recuperar($correo, $token));
                    $sql = "EXECUTE capturaweb.dbo.recupera_cuenta ?,?";
                    $params = array($correo, $token);
                    $result = DB::connection('tramites_op')->select($sql, $params);
                    session()->flash('alert', [
                        'type' => 'success',
                        'msg'  => 'Se te ha enviado un mensaje al correo: ' . $correo
                    ]);
                } else {

                    session()->flash('alert', [
                        'type' => 'danger',
                        'msg'  => 'Ocurrió un error, intenta más tarde'
                    ]);
                }
            } else {

                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'Ocurrió un error, intenta más tarde'
                ]);
            }
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Su correo no esta registrado ' . $correo
            ]);
        }

        Redirect::to(url('cuenta/recupera'))->send();
    }

    public static function cambiac($correo, $token)
    {
        $total = DB::table('validacion as v')
            ->join('usuarios as u', 'u.id_usuario', '=', 'v.id_usuario')
            ->where('u.correo', '=', $correo)
            ->where('v.token',  '=', $token)
            ->where('v.estatus', '=', 'disponible')
            ->count();

        if ($total > 0) { //Existe y esta disponible

            return true;
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'El enlace ya ha sido utilizado o no existe'
            ]);

            Redirect::to(url('cuenta/recupera'))->send();
        }
    }

    public static function cambiarc($correo, $contrasena, $token)
    {
        $usuario = DB::table('usuarios')
            ->select('id_usuario', 'correo', 'token')
            ->where('correo', '=', $correo)
            ->where('token', '=', $token)
            ->first();

        if (!is_null($usuario)) {

            DB::table('validacion')
                ->where('token', '=', $token)
                ->update(['estatus' => 'usado', 'used_at' => date('Y-m-d H:i:s')]);

            $cambio = DB::table('usuarios')
                ->where('id_usuario', '=', $usuario->id_usuario)
                ->update(['contrasena' => $contrasena, 'token' => '', 'update_at' => date('Y-m-d H:i:s')]);

            if ($cambio) {

                session()->flash('alert', [
                    'type' => 'success',
                    'msg'  => 'La contraseña se cambió con éxito'
                ]);
            } else {

                session()->flash('alert', [
                    'type' => 'danger',
                    'msg'  => 'Ocurrió un error al intentar cambiar la contraseña'
                ]);
            }
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Ocurrió un error al validar tu cuenta'
            ]);
        }

        Redirect::to(url('cuenta'))->send();
    }


    public static function cambiar_contrasena($request)
    {
        $usuario = DB::table('usuarios')
            ->select('contrasena')
            ->where('id_usuario', session('id_usuario'))->first();
        if (Crypt::decryptString($usuario->contrasena) == $request['cactual']) { //Coincide la contraseña
            return DB::table('usuarios')
                ->where('id_usuario', session('id_usuario'))
                ->update(['contrasena' =>  Crypt::encryptString($request['ncontrasena']), 'update_at' => date('Y-m-d H:i:s')]);
        } else {
            return false;
        }
    }

    public static function count_email($correo, $accion)
    {
        if (DB::table('count_email')->where('correo', '=', $correo)->first()) {
            DB::select("update count_email set peticiones = peticiones + 1 where correo = '$correo'");
        } else {
            DB::table('count_email')->insert(['correo' => $correo, 'peticiones' => 1]);
        }

        DB::table('bitacora_correo')->insert(['correo' => $correo, 'fecha' => date('Y-m-d H:i:s'), 'accion' => $accion]);
        
        return true;
    }
}
