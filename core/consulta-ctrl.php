<?php

require_once("conexion.php");
require_once("Core.php");


$obj = new Core(tblUsers,tblConekta);
$correo = ($_POST['eMailConsultar'])?$_POST['eMailConsultar']:'';

$obj->consulta($correo);
?>