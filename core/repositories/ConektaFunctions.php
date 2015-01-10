<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 09/01/2015
 * Time: 08:17 PM
 */
require(ROOT.'conekta/lib/Conekta.php');
class repositories_ConektaFunctions
{

    public function procesa_pago(array $values)
    {
        Conekta::setApiKey(privateKey);//private key

        $reference   = str_replace(" ","-",$values['nombre']."-".date("Y-m-d-G:i:s"));
        $description = "Tienda Conekta By Vendetta";
        $type_data   = array();

        switch($values['tipo_pago'])
        {
            case 'cash':
                $type_data = array(
                    "type" =>"oxxo",
                    "expires_at" =>"2015-03-04"
                );
               break;
            case 'bank':
                $type_data = array(
                    "type" =>"banorte"
                );
                break;
            case 'card':
                $type_data = $values['conekta_id'];
                break;
        }

        $charge  =  Conekta_Charge::create(array(
            "amount" => $values['cantidad_pago'],
            "reference_id" =>$reference,
            "currency" => "MXN",
            "description" => $description,
            $values['tipo_pago'] => $type_data,
            "details" =>array(
                'name'  =>$values['nombre'],
                'email' =>$values['correo']
            )
        ));

        /*variables de respuesta */
        $data = array(
            'id_transaccion' => $charge->id,
            'status'         => $charge->status,
            'reference'      => $charge->reference_id,
            'error_code'     => $charge->failure_message,
            'barcode'        => ($charge->payment_method->barcode)?$charge->payment_method->barcode:'',
            'barcode_url'    => ($charge->payment_method->barcode_url)?$charge->payment_method->barcode_url:'',
            'service_number' => ($charge->payment_method->service_number)?$charge->payment_method->service_number:'',
            'origen'         => $values['tipo_pago']
        );
        return $data;
    }
}