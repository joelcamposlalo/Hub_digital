<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Catastro_model;

class Catastro extends Controller
{


    /**
     * 
     * Obtener datos de predio de la base 
     * de datos de catastro
     * 
     */

    public function get_by_cuenta(Request $request)
    {
        //echo "<br> cuenta ".$request->cuenta;
        $result = Catastro_model::get_by_cuenta(strval($request->cuenta));

        if (!is_null($result) && !empty($result)) {

            http_response_code(200);
            echo json_encode($result);
        } else {

            http_response_code(404);
            echo json_encode(['msg' => 'No se encontraron resultados, verifica la cuenta e intente nuevamente']);
        }
    }

    public function get_adeudo_cuenta(Request $request)
    {
        if (isset($_POST['cuenta']) && $_POST['cuenta'] != "") {
            $cuenta = $_POST['cuenta'];
            $url = "https://pagos.zapopan.gob.mx/WSPagoEnLinea/api/BuscarPredio/" . $cuenta;

            $client = curl_init($url);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            $result = json_decode($response);
            if (isset($result->alerta)) {
                if ($result->alerta == "El predio no contiene cargos con adeudo.") {
                    echo "1";
                } else {
                    echo "0";
                }
            } else {
                if (isset($result[1])) {

                    if ($result[1]->fields->importe_base > 0) {
                        echo "0";
                    } else {
                        echo "1";
                    }
                } else {
                    echo "1";
                }
            }
        }
    }
}
