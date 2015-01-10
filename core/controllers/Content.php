<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 05/01/2015
 * Time: 10:09 PM
 */

/**
 * Mantengo el require original de conekta pues es una plataforma aparte
 * que no quiero tocar por si llegase a actualizar asi no causaria ningun
 * problema subir la nueva version.
 */

class controllers_Content extends repositories_Master{

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

            $this->set_view('loading');

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

            $vars_conekta   = array('id_conekta'=>$insert_conekta['values']['id'],
                'cantidad_pago'=>$insert_conekta['values']['cantidad_pago']);

            $this->redirect_run('iniciar_pago',array_merge($insert_user['values'],$vars_conekta));


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
        if($_POST)
        {
            $this->set_view('loading');

            $data_user = array(
                'nombre'        => $_POST['nombre'],
                'cantidad_pago' => $_POST['cantidad_pago']."00",
                'correo'        => $_POST['correo'],
                'tipo_pago'     => $_POST['tipo_pago'],
                'conekta_id'    => isset($_POST['conektaTokenId'])?$_POST['conektaTokenId']:''
            );

            $conekta_get = $this->procesa_pago($data_user);
            unset($conekta_get['error_code']);
            $this->conekta_model->update($_POST['id'],$conekta_get);

            $this->redirect_run('succes',array_merge($conekta_get,array('id'=>$_POST['id'])));
        }
        else
        {
            var_dump(array('message'=>'404'));
        }
    }

} 