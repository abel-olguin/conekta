<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 09:29 PM
 */

class models_Productos extends models_Models{

    protected static $table_name   = tblProductos;
    protected static $key          = 'id';

    public function get_all_products()
    {

        return $this->find('deleted',0);
    }

}