<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

setlocale(LC_TIME, "spanish");


class Horas_extras_pyl_model extends Model
{

    public static function solicitud()
    {
        if (session('lastpage') !== null && session('lastpage') == __FILE__) {

            $result = Solicitudes_model::consulta_ultimo_folio(8);
            $folio = $result[0]->folio;
        } else {

            $folio = DB::table('solicitudes')->insertGetId([
                'id_tramite' => 8,
                'id_usuario' => session('id_usuario'),
                'id_etapa'   =>  45,
                'estatus'    =>  'pendiente',
                'id_revisor' =>  Solicitudes_model::balanza(48)
            ], 'id_solicitud');
        }
        session(['lastpage' => __FILE__]);

        return $folio;
    }

    public static function get_datos_licencia($licencia)
    {

        $sql = "execute vdigital_datoslicencia ?";
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function get_files($id_solicitud)
    {
        $terminados = DB::table('archivos as a')
            ->join('cat_archivo as c', 'a.id_cat_archivo', '=', 'c.id_cat_archivo')
            ->select('a.nombre as archivo', '*')
            ->where([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 8],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.universal', '=', false],
                ['c.id_documento', '>', 0]
            ])
            ->orWhere([
                ['a.id_usuario', '=', session('id_usuario')],
                ['c.id_tramite', '=', 8],
                ['c.universal', '=', true],
                ['a.id_solicitud', '=', $id_solicitud],
                ['c.id_documento', '>', 0]
            ])
            ->get();

        $pendientes = DB::select('SELECT c.id_cat_archivo, c.nombre, c.id_tramite, c.descripcion_larga, 
        c.id_documento,c.obligatorio FROM cat_archivo as c WHERE NOT EXISTS (SELECT 1 FROM archivos as a 
        WHERE c.id_cat_archivo = a.id_cat_archivo
        and a.id_solicitud =' . $id_solicitud . '      
        and a.id_usuario =' . session('id_usuario') . '
        ) and c.id_documento>0 and c.id_tramite = 8');



        return [
            'terminados'  => $terminados,
            'pendientes'  => $pendientes,
        ];
    }

    public static function get_permisos_giro($id_giro)
    {
        $sql = "SELECT * FROM VD_GirosPermisosHorasExtra WHERE id_giro= ?";
        return DB::connection('pyl')->select($sql, array($id_giro));
    }

    public static function get_licencia_no_tramitar($licencia)
    {

        $sql = "execute sp_NoTramitar ?";
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function get_licencia_tramite_pendiente($licencia)
    {

        $sql = "execute sp_TramitePendiente ?";
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function guarda_dias($licencia, $dia)
    {

        $arr_fecha = explode("-", $dia);
        $sql = "insert into diasPermisosHrasExtras values(" . $licencia . "," . $arr_fecha[2] . ",'" . strftime("%B", strtotime($dia)) . "'," . $arr_fecha[0] . ",month('01/" . $arr_fecha[1] . "/2018'))";
        return DB::connection('pyl')->insert($sql);
    }

    public static function get_horas_giro($id_giro)
    {
        $sql = "SELECT * FROM horasporgiro WHERE IdGiro = ?";
        return DB::connection('pyl')->select($sql, array($id_giro));
    }

    public static function get_datos_recibo($folio)
    {
        $sql = "Execute sp_ConsultaPermisosWebSIR ?";
        return DB::connection('pyl')->select($sql, array($folio));
    }

    public static function get_firma()
    {
        $sql = "Execute usp_FirmaPermisosWebSIR";
        return DB::connection('pyl')->select($sql);
    }

    public static function get_conceptos($id_permiso)
    {
        $sql = "SELECT Descripcion, Importe, FechaPago, Recibo FROM pagos WHERE cuentadepto = ?";
        return DB::connection('pyl')->select($sql, array($id_permiso));
    }

    public static function get_recibo($id_permiso)
    {
        $sql = "SELECT * FROM rec_recibo WHERE NumeroLicencia = ? and Estado = 1";
        return DB::connection('sir')->select($sql, array($id_permiso));
    }

    public static function get_folio($recibo)
    {
        $sql = "SET NOCOUNT ON; Execute usp_RegistraImpresionReciboPermisoHrasExtrasSIR '?';";
        return DB::connection('pyl')->select($sql, array($recibo));
        //return DB::select(' EXEC stored_procedure'. $param1.','...$paramN);
    }

    /* Orden de Pago */

    public static function get_datos_licencia_orden($licencia)
    {
        $sql = 'execute sp_DatosLicencia ?';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function genera_dias($licencia)
    {
        $sql = 'execute usp_GeneraDiasHrasExtras ?';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function get_vigencia_ini($licencia)
    {
        $sql = 'SELECT top 1 * FROM diasPermisosHrasExtras WHERE NumeroLicencia = ? ORDER BY Año ASC, MesNumero ASC, Dia ASC';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function get_vigencia_fin($licencia)
    {
        $sql = 'SELECT TOP 1 * FROM DiasPermisosHrasExtras WHERE numerolicencia = ? ORDER BY Año DESC, MesNumero DESC, Dia DESC';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function guarda_permiso($licencia, $usrWeb, $vigFinal, $obs, $numDias, $per)
    {
        $sql = 'execute sp_GuardarTramitePermiso ?, ?, ?, ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($licencia, $usrWeb, $vigFinal, $obs, $numDias, $per));
    }

    public static function agregar_datos_solicitud($solicitud, $folio) 
    {
        $sql = 'execute zapkiosco.tramites.dbo.agrega_dato_solicitud ?, ?';
        return DB::connection('pyl')->select($sql, array($solicitud, $folio));
    }

    public static function get_idGiro($licencia) 
    {
        $sql = 'execute vdigital_datoslicencia ?';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function guardar_permiso_vdigital($licencia, $vigFinal, $numDias, $solicitud, $folio, $idUsrVD, $idSolicitud, $idGiro, $correo)
    {
        $sql = 'execute sp_GuardarTramitePermisoVDigital ?, ?, ?, ?, ?, ?, ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($licencia, $vigFinal, $numDias, $solicitud, $folio, $idUsrVD, $idSolicitud, $idGiro, $correo));
    }

    public static function genera_adeudo_pyl($solicitud, $folio, $per)
    {
        $sql = 'execute usp_GeneraAdeudosWeb ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($solicitud, $folio, $per));

    }

    public static function get_giro($licencia)
    {
        $sql = 'execute sp_GiroLicencia ?';
        return DB::connection('pyl')->select($sql, array($licencia));
    }

    public static function get_adeudo($folio, $clave, $fecha)
    {
        $sql = 'execute usp_ObtengoAdeudos ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($folio, $clave, $fecha));
    }

    public static function get_adeudo_sir($folio)
    {
        $sql = 'execute sp_ConsultaAdeudosHorasExtrasaSIR ?';
        return DB::connection('pyl')->select($sql, array($folio));
    }

    public static function genera_adeudo_permiso($folioSir, $conceptoSir, $DescSir, $importeSir)
    {
        $sql = 'execute sp_GenerarAdeudosPermiso ?, ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($folioSir, $conceptoSir, $DescSir, $importeSir));
    }

    public static function guarda_restricciones($folio, $leyendas, $restricciones)
    {
        $sql = 'execute sp_GuardarRestriccionesObservacionesHrasExtras ?, ?, ?';
        return DB::connection('pyl')->select($sql, array($folio, $leyendas, $restricciones));
    }

}
