<?php
/**

* Este archivo se encarga de recorrer la base de datos en busca de quienes ya pagaron
* si encuentra alguno le asigna un numero y envia un mail
* se recomienda ejecutarlo 1 vez al dia con la herramienta cron de tu servidor
**/
require_once("conekta/lib/Conekta.php");
require_once("conexion.php");
require_once("Core.php");


Conekta::setApiKey(privateKey);//private key

/*dev mode*/
//ini_set("display_errors",1);
/*end dev mode*/

$data     = new Core(tblUsers,tblConekta,tblNumeros);

$usuarios = tblUsers;
$conekta  = tblConekta;

$sql      = "SELECT * FROM $usuarios INNER JOIN $conekta ON $usuarios.email = $conekta.correo WHERE status=0";

$consulta = $conexion->query($sql);

if($consulta->num_rows>0){

	while($row = $consulta->fetch_assoc()){

		$idTransaccion = $row['id_transaccion'];
		$nombre        = $row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];
		$correo        = $row['email'];

		
			if(!empty($idTransaccion)){

				$consultaUser = Conekta_Charge::find($idTransaccion);
				
				$array = json_decode($consultaUser);

					if($array->status=="paid"){

						$numero = $data->getNumero($correo);
						$data -> enviarMailPagado($nombre,$correo,$numero);
						if($data){
							echo "Mensaje enviado correctamente a: $correo";
						}else{
							echo "Error al Enviar mensaje";
						}
					}else{
						
						die('falta pago');
					}
			}else {
				die('Sin id de transaccion');
			}

	}

		
}else{//end if($filas>0)
echo "sin resultados";
}//end else for if($filas>0)





/**
en caso de requerir devoluciones:
$charge = Conekta_Charge::find('id');//id
$charge->refund('id');//id
**/



?>
