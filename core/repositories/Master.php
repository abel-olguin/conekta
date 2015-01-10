<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 10:55 PM
 */

class repositories_Master extends repositories_ConektaFunctions{

    protected $values;
    protected $models;

    public function __construct(){

    }

    /**
     * @param array $data
     *
     * Genera los valores de las vistas
     *
     * Funcion encargada de almacenar variables para las vistas
     */
    protected function set_values(array $data)
    {
        $this->values = $data;
    }

    /**
     * @param $view
     * @param string $args
     *
     * funcion encargada de generar una vista verifica si existen argumentos
     * si son un array los extrae sino deja la variable tal cual llego (debe ser llamado args
     * por otro lado si se uso set_values deja las variables con el nombre que se les dio
     * asi mismo para un redirect se crea extraen los valores de una session(que se creo en redirect)
     * ademas de que termina dicha session
     */
    protected function set_view($view,$args = 'null')
    {

        if(!$args == 'null')
        {
            if(is_array($args))
            {
            extract($args);
            }
        }
        else if($_SESSION)
        {
            extract($_SESSION['vars']);
            var_dump($_SESSION);
            session_destroy();
        }
        if($this->values)
        {
            extract($this->values);
        }

        require(views.$view.'.php');

        $this->values = '';
    }

    protected function redirect_run($set,array $vars)
    {
        session_start();
        $_SESSION['vars'] = $vars;
        header("Location: inscripcion.php?set=controllers_Content&run=$set");

        die();
    }

    /**
     * @param $string
     *
     * Carga un modelo
     *
     * Funcion encargada de cargar un modelo instancia la clase del modelo con autoload
     * y devuelve un objeto (proximamente)
     */
    protected function load_model($string)
    {


        $$string = new $string();
        echo $$string->insert();
    }



} 