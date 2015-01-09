<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 10:09 PM
 */

class controllers_Content extends controllers_Master{

    private $usuarios_model;
    private $conekta_model;
    /**
     * Inicializa modelos y demas
     *
     * Funcion encargada de inicializar todo lo que sera usado
     * a lo largo del uso de esta clase
     */
    public function __construct(){
        parent::__construct();

        $this->usuarios_model = new models_Usuarios();
        $this->conekta_model  = new models_Conekta();
        //$this->load_model('models_Usuarios');
    }

    /**
     * Muestra el Home
     *
     * Funcion encargada de mostrar la pagina de inicio del
     * sistema
     *
     */
    public function home(){

        $this->set_view('home');
    }

    /**
     * Hace un registro
     *
     * Funcion encargada de realizar un registro
     *
     */
    public function registrar()
    {
        if($_POST)
        {
            $data_user = array(
              'correo'           => $_POST['correo'],
              'nombre'           => $_POST['nombre'],
              'apellido_paterno' => $_POST['aPaterno'],
              'apellido_materno' => $_POST['aMaterno'],
              'fecha_nac'        => $_POST['dia'].'-'.$_POST['mes'].'-'.$_POST['anio'],
              'pais'             => $_POST['pais']
            );

            $data_conekta = array(
                'correo'          => $_POST['correo'],
                'status'          => 0,
                'cantidad_pago'   => precio,
                'pais'            => $_POST['pais']
            );

            $insert_user    = $this->usuarios_model->insert($data_user);

            $insert_conekta = $this->conekta_model->insert($data_conekta);


           if ($insert_user['response'] == true && $insert_conekta['response']==true)
           {
               $this->redirect_run('iniciar_pago',$insert_user['values']);
           }
            $this->set_view('loading');
        }
        else
        {
            var_dump(array('message'=>'404'));
        }

    }

    /**
     * Iniciar el pago
     *
     * Funcion encargada de mostrar el formulario de pago
     * con las diferentes opciones de pago en conekta
     */
    public function iniciar_pago()
    {
        $this->set_view("pago");
    }

    public function guardar_pago()
    {

    }
} 