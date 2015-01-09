<?php
if($_SESSION){
require_once("views/control.php");
extract($_SESSION["variables"]);


?>

<?php
$mensaje;
switch ($tipoPago) {
	case 'oxxo':
		echo getViewOxxo();
		break;
	case 'banorte':
		echo getViewbanorte();
		break;

	case 'tc':
		if($status == "paid"){
			echo getViewTCpaid();
		}else{
			echo getViewTC();
		}
		break;

	default:
		echo getViewDefault();
		break;
}

?>

<?php

}else{
?>
<script>
   setTimeout("location.href = 'inscripcion.php?accion=home';",2000);
</script>

<?php
}
?>