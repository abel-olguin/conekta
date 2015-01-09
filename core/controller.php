<?php

/**

 * Archivo encargado del registro, la instancia de la clase Core es solo para crear los selects de la edad
 *
 *
 **/

require_once('settings.php');
require_once('conexion.php');


if($_GET){

    $clase   = $_GET['set'];
    $funcion = $_GET['run'];

        $obj = new $clase();

        if (is_callable(array($obj,$funcion))) {
            $obj->$funcion();
        } else {
            var_dump(array('message' => '404'));
        }

}else{
    header("Location: ?set=controllers_Content&run=home");
}


function __autoload($class_name)
{

    $filename = str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';

    $file = ROOT.$filename;
var_dump($file);
    if ( ! file_exists($file))
    {
        var_dump(array('message'=>'404'));
        die();
    }else{
        require $file;
    }


}


?>