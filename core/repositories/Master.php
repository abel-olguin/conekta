<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 10:55 PM
 */

class repositories_Master {

   protected $objects;

    public function __construct(){

    }

    /**
     * @param $string
     *
     * Carga un repositorio
     *
     * Funcion encargada de leer un repositorio
     * y todas sus funciones
     */
    public function load_repo($string)
    {
        $newClass = new $string();

        $this->{$string} = $newClass;
    }

    /**
     * @param $string
     *
     * cargar un modelo
     *
     * Funcion encargada de leer un modelo
     * y permitir el uso de todos sus metodos
     */
    public function load_model($string)
    {
        $newClass = new $string();

        $this->{$string} = $newClass;
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
    protected function set_view($view, $args = 'null',$extract = false)
    {

        if($args != 'null')
        {
           
            if(is_array($args) && $extract)
            {
               
            extract($args);


            }else
            {
                $$args = $args;
            }
        }
        if(isset($_SESSION['vars']) )
        {
            
            extract($_SESSION['vars']);
           
            session_destroy();
        }
        if(isset($this->values))
        {
            extract($this->values);
        }

        require(views.$view.'.php');

        $this->values = '';
    }

    /**
     * @param $set
     * @param array $vars
     *
     * Redirige a una funcion
     *
     * Funcion encargada de redirigir si se envian variables
     * se guardan en una sesion para posteriormente ser destruidas
     * al llegar a la vista
     */
    protected function redirect_run($set,array $vars=null)
    {
        if(!empty($vars))
        {
            $_SESSION['vars'] = $vars;

        }
        
        echo "<script language='javascript'>window.location='inscripcion.php?set=controllers_Content&run=$set'</script>;";
        /*header("Location: inscripcion.php?set=controllers_Content&run=$set");*/ //forma de hacerlo en test

        die();
    }

    /**
    * Crear variable de session
    *
    * Funcion encargada de crear una variable de session con lo que se le manda
    *
    */
    protected function create_session(array $vars)
    {
        if(!empty($vars))
        {
            session_start();
 
            $_SESSION[array_keys($vars)[0]] = $vars[array_keys($vars)[0]];

        }
        else
        {
            return false;
        }
    }


    protected function get_session($name)
    {
        session_start();

        if($_SESSION[$name])
        {
            $result = $_SESSION["$name"];

            session_destroy();

            return $result;
           
        }
        else
        {
            return false;
        }
    }



}


