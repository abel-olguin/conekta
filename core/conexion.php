<?php 
/**

* Aqui se crea la instancia a mysqli que inicia la conexion y selecciona la base de datos
* No es recomendable modificarlo para eso esta el archivo settings.php
*
**/
require_once('settings.php');

$conexion = new mysqli(DB_HOST , DB_USER, DB_PASSWORD);

if($conexion->connect_errno){

    die("No se ha podido conectar a la BD: " . $conexion->connect_errno);

  }

$conexion->select_db(DB_NAME);

$conexion->query('SET NAMES \'utf8\'');



?>