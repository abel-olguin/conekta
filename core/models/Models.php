<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 09:30 PM
 */

class models_Models
{

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

        $table = static::$table_name;

        $now = date('d-m-Y :: H:m:s');
        $columns = implode(",", array_keys($args));
        $values = [];
        $vars = array_values($args);

        for ($i = 0; $i <= count($vars) - 1; $i++) {
            $var = $vars[$i];

            $var = is_string($var) ? ("'" . $var . "'") : $var;

            array_push($values, $var);
        }

        $values = implode(',', $values);
        $sql = "INSERT INTO $table($columns,created) VALUES ($values,'$now')";

        if ($GLOBALS['conexion']->query($sql)) {
            $id = $GLOBALS['conexion']->insert_id;
            $args = array_merge($args, array('id' => $id));

            $data = array('response' => true, 'values' => $args);
        } else {
            die('La insercion no se realizo: ' . $GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }

    public function update($id, array $args)
    {

        $table = static::$table_name;


        $columns = array_keys($args);
        $values  = [];
        $vars    = array_values($args);

        for ($i = 0; $i <= count($vars) - 1; $i++) {
            $var = $vars[$i];

            $var = is_string($var) ? ("'" . $var . "'") : $var;

            array_push($values, $columns[$i] . '=' . $var);
        }



        $values = implode(',', $values);
        $sql = "UPDATE $table SET $values WHERE id = $id";

        if ($GLOBALS['conexion']->query($sql)) {
            $data = array('response' => true, 'values' => $args);
        } else {
            die('La insercion no se realizo: ' . $GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }

    public function update_where($where,$args)
    {
        $table = static::$table_name;


        $columns    = array_keys($args);
        $values     = [];
        $vars       = array_values($args);
        $key_where  = array_keys($where);
        $val_where  = array_values($where);


        $arr_where  = array();
        for ($i = 0; $i <= count($vars) - 1; $i++) {
            $var = $vars[$i];

            $var = is_string($var) ? ("'" . $var . "'") : $var;

            array_push($values, $columns[$i] . '=' . $var);
        }

        for($i = 0; $i <= count($key_where)-1; $i++)
        {
            $value = is_string($val_where[$i]) ? (" LIKE '" . $val_where[$i] . "'") : " = ".$val_where[$i];

            array_push($arr_where,$key_where[$i] . $value );

        }
        $values    = implode(',', $values);
        $str_where = implode('AND', $arr_where);
        $sql = "UPDATE $table SET $values WHERE $str_where";

        if ($GLOBALS['conexion']->query($sql)) {
            $data = array('response' => true, 'values' => $args);
        } else {
            die('La insercion no se realizo: ' . $GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }
} 