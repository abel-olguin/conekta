<?php
/*dev mode*/
//ini_set('display_errors', '1');
/*dev mode*/
/**
* Archivo encargado de instanciar y procesar pagos a la plataforma conekta
*
*
**/
require_once("conekta/lib/Conekta.php");
require_once("Core.php");
require_once("conexion.php");

Conekta::setApiKey(privateKey);//public key

$tipoPago = ($_POST['tipoPago'])?$_POST['tipoPago']:'';

if(!empty($tipoPago)){

$data  =  new Core(tblUsers,tblConekta,tblNumeros);

  /*variables generales*/
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $nivel  = $_POST['nivel'];
                $reference = str_replace(" ","-",$nombre)."-".date("Y-m-d-G:i:s");
                $description = "conekta";
                $pago = $_POST['pago']."00";

                $hoy = date('Y-m-j');
                $expirationDate = strtotime ( '+5 day' , strtotime ( $hoy ) ) ;
                $expirationDate = date ( 'Y-m-d' , $expirationDate );
                $createAt       = date('Y-m-d');
  /**Pago con tarjeta
  **/
            if($tipoPago == 'tc'){

                $csv = $_POST['cvc'];
                $mes = $_POST['mes'];
                $anio = $_POST['anio'];
                $tokenTC = $_POST['conektaTokenId'];

                $nombreTC = $_POST['nombre-tc'];

                try{
                 
                   /*conectar a "conekta"*/
                      $charge  =  Conekta_Charge::create(array(
                        "amount" => $pago,
                        "reference_id" =>$reference,
                        "currency" => "MXN",
                        "description" => $description,
                        "card" =>$tokenTC,
                        "details" =>array(
                                'name'  =>$nombreTC,
                                'email' =>$correo
                                )
                          ));
                         /*conectar a "conekta" end*/

                        /*variables de respuesta */
                        $id = $charge->id;
                        $status = $charge->status;
                        $reference = $charge->reference_id;
                        $error_code = $charge->failure_message;
                        /*variables de respuesta end*/
                        $value = $data -> insertar(compact("id","correo",'reference',"expirationDate"),"card");

                          if ($value){

                            $data -> enviarMailInscripcion(compact("nombre","correo"));
                                 /*resultados*/
                              if($status == "paid"){
                                $numero = $data -> getNumero($correo);
                                $data -> enviarMailPagado($nombre,$correo,$numero);
                                $_SESSION['variables'] = compact("id","nombre","correo","status","reference","error_code",'tipoPago','numero','pago','nivel');
                                  ?>
                                   <script>
                                      setTimeout("location.href  =  'inscripcion.php?accion=success';",2000);
                                    </script>
                                 <?php
                              /*Resultados end*/
                             }elseif($status == 'declined'){
                                 $data->eliminarMetodo($correo);
                                  ?>
                                   <script>
                                      setTimeout("location.href  =  'inscripcion.php?accion=error';",2000);
                                    </script>
                                 <?php
                             }else{
                             	 $_SESSION['variables'] = compact("nombre","correo","status","reference","error_code",'tipoPago','pago');
                                  ?>
                                   <script>
                                      setTimeout("location.href  =  'inscripcion.php?accion=success';",2000);
                                    </script>
                                 <?php
                             }

                         }else{
                          echo "<h1>Ha ocurrido un error</h1>";
                          ?>
                              <script>
                                  setTimeout("location.href  =  'inscripcion.php?accion=inscripcion';",2000);
                              </script>
                            <?php
                         }

                }catch (Conekta_Error $e){
                  echo $e->getMessage(); //Un error ocurrió al procesar el pago
                }

            }//end  if($tipoPago =  = 'tc')


/**
Pago OXXO
**/
            elseif($tipoPago == 'oxxo'){
            /* en el momento en que se realice un pago*/
                  try{
                   
                    /*conectar a "conekta"*/
                          $charge  =  Conekta_Charge::create(array(
                            "amount" => $pago,
                            "reference_id" =>$reference,
                            "currency" => "MXN",
                            "description" => $description,
                            "cash" => array(
                              "type" =>"oxxo",
                              "expires_at" =>$expirationDate
                            ),
                            "details" =>array(
                              'name'  =>$nombre,
                              'email' =>$correo
                              )
                            ));
                           /*conectar a "conekta" end*/

                          /*variables de respuesta */
                          $id          = $charge->id;
                          $status      = $charge->status;
                          $reference   = $charge->reference_id;
                          $error_code  = $charge->failure_message;
                          $barcode     = $charge->payment_method->barcode;
                          $barcode_url = $charge->payment_method->barcode_url;
                          $expiration  = $charge->payment_method->expiry_date;
                          /*variables de respuesta end*/
                            $value = $data -> insertar(compact("id","correo","barcode","barcode_url",'reference',"expirationDate"),"oxxo");

                          if ($value){
                             $data -> enviarMailInscripcion(compact("nombre","correo"));
                          /*resultados*/
                            $_SESSION['variables'] = compact("id","nombre","correo","status","reference","error_code","tipoPago","barcode_url","barcode","pago","expiration",'createAt');
                              ?>
                                <script>
                                  setTimeout("location.href  =  'inscripcion.php?accion=success';",2000);
                                </script>
                              <?php
                           /*Resultados end*/

                         }else{
                          echo "<h1>Ha ocurrido un error</h1>";
                          ?>
                              <script>
                                  setTimeout("location.href  =  'inscripcion.php?accion=inscripcion';",2000);
                              </script>
                            <?php
                         }
                        

                   }catch (Conekta_Error $e){
                    echo $e->getMessage(); //Un error ocurrió al procesar el pago
                    }
            }//end elseif($tipoPago =  = 'oxxo')

/**
Pago Banorte
  **/
            elseif($tipoPago == 'banorte'){

                  try{
                  
                    /*conectar a "conekta"*/
                          $charge  =  Conekta_Charge::create(array(
                            "amount" => $pago,
                            "reference_id" =>$reference,
                            "currency" => "MXN",
                            "description" => $description,
                            "bank" => array(
                              "type" =>"banorte"
                            ),
                            "details" =>array(
                              'name'  =>$nombre,
                              'email' =>$correo
                              )
                            ));
                           /*conectar a "conekta" end*/
                          /*variables de respuesta */
                          $id            = $charge->id;
                          $status        = $charge->status;
                          $reference     = $charge->payment_method->reference;
                          $serviceNumber = $charge->payment_method->service_number;
                          $error_code    = $charge->failure_message;
                         
                          $value = $data -> insertar(compact("id","correo","reference","expirationDate",'serviceNumber'),"banorte");

                          if ($value){
                             $data -> enviarMailInscripcion(compact("nombre","correo"));
                          /*resultados*/
                            $_SESSION['variables'] = compact("id","nombre","serviceNumber","correo","status","reference","error_code","tipoPago","pago",'createAt','expirationDate');
                              ?>
                                <script>
                                  setTimeout("location.href  =  'inscripcion.php?accion=success';",2000);
                                </script>
                              <?php
                           /*Resultados end*/

                         }else{
                          echo "<h1>Ha ocurrido un error</h1>";
                          ?>
                              <script>
                                  setTimeout("location.href  =  'inscripcion.php?accion=inscripcion';",2000);
                              </script>
                            <?php
                         }

                  }catch (Conekta_Error $e){
                    echo $e->getMessage(); //Un error ocurrió al procesar el pago
                  }

            }//end elseif($tipoPago =  = 'banorte')

}//end if(!empty($tipoPago))


