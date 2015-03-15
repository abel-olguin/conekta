<?php
/**

* Este archivo se encarga de crear la base de datos y la tablas necesarias
**/
require_once("../core/settings.php");

$creator = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

if($creator->connect_errno){

    die("No se ha podido conectar a la BD: " . $creator->connect_errno);

  }

  if($creator->select_db(DB_NAME)){
  	
	if($creator->query(createUsers())){
		echo "Tabla usuarios creada Exitosamente<br>";
	}else{
		echo "Error en tabla Usuarios";
	}
	if($creator->query(createConekta())){
		echo "Tabla Conekta creada Exitosamente<br>";
	}else{
		echo "Error en tabla Conekta";
	}
      if($creator->query(createCupones())){
          echo "Tabla Cupones creada Exitosamente<br>";
      }else{
          echo "Error en tabla Cupones";
      }
	if($creator->query(createProducts())){
		echo "Tabla Numeros creada Exitosamente<br>";
	}else{
		echo "Error en tabla Numeros";
	}
	

  }else{

  	if($creator->query(createDB())){
  		echo "Base de datos creada Exitosamente<br>";
  	}else{
  		echo "Error creando base de datos";
  	}
  	if($creator->select_db("conekta")){
  		echo "Base seleccionada Exitosamente<br>";
  	}else{
  		echo "Error seleccionando base de datos";
  	}
  	if($creator->query(createUsers())){
  		echo "Tabla usuarios creada Exitosamente<br>";
  	}else{
  		echo "Error en tabla Usuarios";
  	}
	if($creator->query(createConekta())){
		echo "Tabla Conekta creada Exitosamente<br>";
	}else{
		echo "Error en tabla Conekta";
	}
	if($creator->query(createProducts())){
		echo "Tabla Numeros creada Exitosamente<br>";
	}else{
		echo "Error en tabla Numeros";
	}
      if($creator->query(createCupones())){
          echo "Tabla Cupones creada Exitosamente<br>";
      }else{
          echo "Error en tabla Cupones";
      }
	

  }

$creator->query('SET NAMES \'utf8\'');
function createDB(){
	$sql = "CREATE DATABASE conekta";
	return $sql;
}
function createUsers(){

	$sql = "CREATE TABLE IF NOT EXISTS tbl_usuarios (
              id int(10) NOT NULL AUTO_INCREMENT,
              nombre varchar(250) COLLATE utf8_spanish_ci NOT NULL,
              apellido_paterno varchar(250) COLLATE utf8_spanish_ci NOT NULL,
              apellido_materno varchar(250) COLLATE utf8_spanish_ci NOT NULL,
              correo varchar(250) COLLATE utf8_spanish_ci NOT NULL,
              password varchar(250) COLLATE utf8_spanish_ci NOT NULL,
              genero varchar(100) COLLATE utf8_spanish_ci NOT NULL,
              fecha_nac varchar(100) COLLATE utf8_spanish_ci NOT NULL,
              pais varchar(100) COLLATE utf8_spanish_ci NOT NULL,
              activo int(11) NOT NULL,
              created varchar(100) COLLATE utf8_spanish_ci NOT NULL,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4";
	return $sql;
}

function createConekta(){

	$sql = "CREATE TABLE IF NOT EXISTS tbl_conekta (
          id int(10) NOT NULL AUTO_INCREMENT,
          id_transaccion varchar(250) COLLATE utf8_spanish_ci NOT NULL,
          id_producto int(10) NOT NULL,
          correo varchar(250) COLLATE utf8_spanish_ci NOT NULL,
          barcode varchar(250) COLLATE utf8_spanish_ci NOT NULL,
          barcode_url varchar(250) COLLATE utf8_spanish_ci NOT NULL,
          status int(10) NOT NULL,
          cantidad_pago varchar(10) COLLATE utf8_spanish_ci NOT NULL,
          reference varchar(200) COLLATE utf8_spanish_ci NOT NULL,
          service_number varchar(200) COLLATE utf8_spanish_ci NOT NULL,
          id_subscripcion varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
          id_cliente varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
          origen varchar(10) COLLATE utf8_spanish_ci NOT NULL,
          created varchar(50) COLLATE utf8_spanish_ci NOT NULL,
          PRIMARY KEY (id)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=30";

	return $sql;
}

function createCupones(){

    $sql = "CREATE TABLE IF NOT EXISTS tbl_cupones (
              id int(10) NOT NULL AUTO_INCREMENT,
              id_producto int(10) NOT NULL,
              codigo varchar(250) NOT NULL,
              descuento int(10) NOT NULL,
              status tinyint(1) NOT NULL DEFAULT '0',
              deleted tinyint(1) NOT NULL DEFAULT '0',
              PRIMARY KEY (id)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ";
    return $sql;
}

function createProducts(){
	$sql = "CREATE TABLE IF NOT EXISTS tbl_articulos (
          id int(10) NOT NULL AUTO_INCREMENT,
          nombre varchar(250) NOT NULL,
          imagen varchar(250) NOT NULL,
          descripcion text,
          precio float NOT NULL,
          clave varchar(200) NOT NULL,
          mensualidades tinyint(1) NOT NULL DEFAULT '0',
          cupones tinyint(1) NOT NULL DEFAULT '0',
          deleted tinyint(1) NOT NULL,
          PRIMARY KEY (id)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ";
	return $sql;
}


?>