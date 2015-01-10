<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 09:30 PM
 */

class models_Models extends \Core{

    /**
     * @param $args
     * @return array
     *
     * inserta valores en una tabla
     *
     * Funcion encargada de insertar registros en una base de datos
     * es necesario que los argumentos esten en un array donde key
     * sea el nombre del campo en base de datos, y el valor sea el que
     * tendra dicho campo
     */
    public function insert(array $args)
    {

        $table   = static::$table_name;

        $now     = date('d-m-Y :: H:m:s');
        $columns = implode(",",array_keys($args));
        $values  = [];
        $vars    = array_values($args);

        for($i = 0; $i<=count($vars)-1; $i++)
        {
            $var = $GLOBALS['conexion']->real_escape_string($vars[$i]);

            $var = is_string($var)?("'".$var."'"):$var;

            array_push($values,$var);
        }

        $values = implode(',',$values);
        $sql    = "INSERT INTO $table($columns,created) VALUES ($values,'$now')";

               if($GLOBALS['conexion']->query($sql))
               {
                   $id   = $GLOBALS['conexion']->insert_id;
                   $args = array_merge($args,array('id'=>$id));

                   $data = array('response'=>true,'values'=>$args);
               }
                else
                {
                    die('La insercion no se realizo: '.$GLOBALS['conexion']->connect_errno);
                }
        return $data;
    }

    public function update($id,array $args)
    {

        $table   = static::$table_name;


        $columns = array_keys($args);
        $values  = [];
        $vars    = array_values($args);

        for($i = 0; $i<=count($vars)-1; $i++)
        {
            $var = $GLOBALS['conexion']->real_escape_string($vars[$i]);

            $var = is_string($var)?("'".$var."'"):$var;

             array_push($values,$columns[$i].'='.$var);
        }

        $values = implode(',',$values);
        $sql    = "UPDATE $table SET $values WHERE id LIKE '$id'";

        if($GLOBALS['conexion']->query($sql))
        {
            $data = array('response'=>true,'values'=>$args);
        }
        else
        {
            die('La insercion no se realizo: '.$GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }
} 