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

            $var = is_string($var) ? "'".$GLOBALS['conexion']->real_escape_string($var)."'" : $var;

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

    /**
     * @param $id
     * @param array $args
     * @return array
     *
     * Hacer un update a partir de un array
     *
     * Funcion encargadade hacer un update a una tabla recorriendo un
     * array; es decir puede haber multiples campos a actualizar
     */
    public function update($id, array $args)
    {

        $table  = static::$table_name;
        $update = $this->get_array_string($args,'=');


        $sql = "UPDATE $table SET $update WHERE id = $id";

        if ($GLOBALS['conexion']->query($sql)) {
            $data = array('response' => true, 'values' => $args);
        } else {
            die('La actualizacion no se realizo: ' . $GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }



    /**
     * @param $where
     * @param $args
     * @return array
     *
     * parecida a update pero aqui el where es dinamico
     *
     * Funcion encargada de hacer un update a varios campos de la tabla
     * donde where sea un array tambien
     */
    public function update_where($where,$args)
    {
        $table = static::$table_name;


        $values     = $this->get_array_string($args,'AND');
        $arr_where  = $this->get_array_string($where,'AND');



        $sql = "UPDATE $table SET $values WHERE $arr_where";

        if ($GLOBALS['conexion']->query($sql)) {
            $data = array('response' => true, 'values' => $args);
        } else {
            die('La insercion no se realizo: ' . $GLOBALS['conexion']->connect_errno);
        }
        return $data;
    }

    /**
     * @param $args
     * @return mixed
     * Busca un registro en base de datos
     *
     * Funcion encargada de retornar un registro de base de datos acorde a un array
     */
    public function find_where($args)
    {
        $table   = static::$table_name;

        $where   = $this->get_array_string($args,'AND');

        $sql    = "SELECT * FROM $table WHERE $where";

        $result = $this->get_result($sql);

        return $result;
    }

    /**
     * @param $args
     * @return mixed
     *
     * Contrario de find where este solo debe tener un argumento
     */
    public function find($camp,$where)
    {
        $table   = static::$table_name;
        if(is_string($where))
        {
            $where = "'".$where."'";
        }
        $sql    = "SELECT * FROM $table WHERE $camp = $where";

        $result = $this->get_result($sql);

        return $result;
    }

    /**
     * @param $query
     * @return mixed
     * Convierte una consulta en array asociativo
     *
     * Funcion encargada de retornar un array asociativo
     * de una consulta
     */
    private function get_result($query)
    {

        $array  = $GLOBALS['conexion']->query($query);
        $result = array();
        while($data = $array->fetch_assoc())
        {
            $result[] = $data;
        }

        return $result;
    }


    /********************************************************************************************
     *                              funciones privadas
     *******************************************************************************************/


    /**
     * @param $array
     * @param $separator
     * @return string
     *
     * genera un string a partir de un array
     *
     * Funcion encargada de convertir un array
     * a una cadena de texto "llave separador valor" ej "nombre = juan"
     */
    private function get_array_string($array,$delimiter = ',')
    {
        $keys   = array_keys($array);
        $values = array_values($array);
        $result = array();

        for ($i = 0; $i <= count($values) - 1; $i++) {

            $val      = $values[$i];
            $string   = is_numeric($val)? " = ".$val:" LIKE '".$val."'";
            $result[] = $keys[$i].$string;
        }

        return implode(' '.$delimiter.' ',$result);
    }
} 