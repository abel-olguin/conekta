
<?php
session_start();
ini_set("display_errors",0);

header('Content-Type: application/json');
require_once("conexion.php");

 $tablaUsuarios = tblUsers;
 //obtener post
 $mail = ($_POST['email'])?$_POST['email']:'';
 
 if(!empty($mail)){

 
	$sql = "SELECT * FROM $tablaUsuarios WHERE email='$mail' and (tarjeta=1 or efectivo=1)";
	//	echo $sql;
	//debe estar el proceso terminado de tarjeta o oxxo para bloquearlo si no quiere decir que no ha concluido su pago
	

	$consulta = $conexion->query($sql);
	$domain = explode('@', $mail);   

	if(checkdnsrr($domain[1])){
		if($consulta->num_rows>0 ){
		$arr = array("msg"=>1); 
		echo json_encode($arr);
		die();
		}
	else
	{
		$arr = array("msg"=>2);
		echo json_encode($arr);
		die();
		}
	}else{
		$arr = array("msg"=>3);
		echo json_encode($arr);
		die();
	}
	

echo mysql_error();

}
?>


