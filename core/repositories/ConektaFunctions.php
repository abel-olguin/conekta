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

    private $origen;
    private $status;

    /**
     * @return mixed
     */
    public function get_origen()
    {
        return $this->origen;
    }

    /**
     * @param mixed $origin
     */
    public function set_origen($origen)
    {
        $this->origen = $origen;
    }

    /**
     * @return mixed
     */
    public function get_status()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function set_status($status)
    {
        $this->status = $status;
    }



    public function procesa_pago(array $values)
    {

        Conekta::setApiKey(privateKey);//private key

        $reference      = str_replace(" ","-",$values['nombre']."-".date("Y-m-d-G:i:s"));
        $description    = "Tienda Conekta By Vendetta";
        $type_data      = array();
        $hoy            = date('Y-m-j');
        $expirationDate = strtotime ( '+5 day' , strtotime ( $hoy ) ) ;
        $expiration     = date ( 'Y-m-d' , $expirationDate );
        $create_at      = date('Y-m-d');

        switch($values['tipo_pago'])
        {
            case 'cash':
                $type_data = array(
                    "type" =>"oxxo",
                    "expires_at" =>$expiration
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
            'barcode'        => isset($charge->payment_method->barcode)?$charge->payment_method->barcode:'',
            'barcode_url'    => isset($charge->payment_method->barcode_url)?$charge->payment_method->barcode_url:'',
            'service_number' => isset($charge->payment_method->service_number)?$charge->payment_method->service_number:'',
            'origen'         => $values['tipo_pago']
        );

        $utils = array(
            'error_code'     => $charge->failure_message,
            'create_at'      => $create_at,
            'expiration'     => $expiration
        );


        return array('data'=>$data,'utils'=>$utils);
    }



    public function procesa_mensualidades($values)
    {
        Conekta::setApiKey(privateKey);//private key

        $id_producto        = $values['producto']['id'];
        $codigo_producto    = $values['producto']['clave'];
        $plan               = array();
        $costo              = $values['producto']['precio'];
        $meses              = $values['meses'];
        $producto           = $codigo_producto;
        $nombre_plan        = str_replace(' ','-',$producto).'-'.$meses.'-meses-'.$costo;//cadena para nombrar el plan
        $card_token         = $values['conekta_id'];
        $tipo_pago          = $values['tipo_pago'];
        $mes                = is_float(($costo*100)/$meses)?ceil(($costo*100)/$meses):($costo*100)/$meses;
        $mes_fix            = substr((string)$mes,0,count((string)$mes)-3).'.'.substr((string)$mes,-2, 2);
        /************************* ----variables para el plan---- ******************************/


        /************************* ----variables para la inscripcion---- ******************************/
        $nombre            = $values['nombre'];
        $correo            = $values['correo'];

        /************************* ----variables para la inscripcion---- ******************************/

        try
        {
            $plan = Conekta_Plan::find($nombre_plan);




        }
        catch (Exception $e)
        {


            /********************** --- crear plan --- *****************/
            $plan = Conekta_Plan::create(array(
                'id'                => $nombre_plan,//identificador del plan
                'name'              => str_replace('-',' ',$nombre_plan),//descripcion o nombre que se muestra
                'amount'            => $mes,//monto mensual
                'currency'          => "MXN",//denominacion
                'interval'          => "month",//tipo de cobro(mensual semanal etc)
                'frequency'         => 1,//cada cuanto(puede ser cada 2 meses etc
                'trial_period_days' => 30,//tiempo que estara disponible el plan
                'expiry_count'      => $meses//cantidad de meses que se hara el cobro
            ));
            /********************** --- crear plan --- *****************/

        }

        /********************** --- crear cliente --- **********************/
        $customer = Conekta_Customer::create(
            array(
                'name'  => $nombre,
                'email' => $correo,
                'cards' => array($card_token),
                'plan'  => $nombre_plan)
        );


        $cliente    = json_decode($customer,true);
        $id_cliente = $cliente['id'];//base de datos

        /********************** --- crear cliente --- ***********************/

        /********************** --- asociar cliente con plan --- **********************/
        $customer     = Conekta_Customer::find($id_cliente);
        $subscription = $customer->createSubscription(//se asocian
            array(
                'plan' => $nombre_plan
            )
        );

        $subscript    = json_decode($subscription,true);
        $id_subscript = $subscript['id'];//obtenemos id

        $input = array(
            'id_subscripcion' => $id_subscript,
            'id_cliente'      => $id_cliente,
            'correo'          => $correo,
            'cantidad_pago'   => $mes_fix.' X '.$meses,
            'id_producto'     => $id_producto,
            'origen'          => 'card'
        );



            return array('data'=>$input,'utils'=>['status'=>'paid']);//retornamos lo que se usara en vista


    }

}