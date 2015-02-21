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

        $this->load_model('models_Usuarios');
        $this->load_model('models_Conekta');
        $this->load_repo('repositories_ConektaFunctions');

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
              'apellido_paterno' => $_POST['apellido_paterno'],
              'apellido_materno' => $_POST['apellido_materno'],
              'fecha_nac'        => $_POST['dia'].'-'.$_POST['mes'].'-'.$_POST['anio'],
              'pais'             => $_POST['pais']
            );

            $data_conekta = array(
                'correo'          => $_POST['correo'],
                'status'          => 0,
                'cantidad_pago'   => precio,
                'pais'            => $_POST['pais']
            );

            $insert_user    = $this->models_Usuarios->insert($data_user);

            $insert_conekta = $this->models_Conekta->insert($data_conekta);

            $vars_conekta   = array('id_conekta'=>$insert_conekta['values']['id'],
                'cantidad_pago'=>$insert_conekta['values']['cantidad_pago']);

            $mail = new controllers_Mails();

            if($mail->send_inscripcion_mail($data_user['nombre'],$data_user['correo'])) {
                $this->redirect_run('iniciar_pago', array_merge($insert_user['values'], $vars_conekta));
            }
            $this->redirect_run('iniciar_pago', array_merge($insert_user['values'], $vars_conekta));//debug localhost


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

    /**
     * Guarda un pago
     *
     * Funcion encargada de guardar un pago es necesario
     * el id del usuario para completar esta tarea(sin embargo
     * en la tabla conekta se guardaria la informacion del pago
     * siempre y cuando coincida con el correo que se envie
     */
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
            $efectivo = ($_POST['tipo_pago']=='cash' || $_POST['tipo_pago']=='bank')?1:0;
            $tarjeta  = ($_POST['tipo_pago']=='card')?1:0;

            $conekta_get = $this->repositories_ConektaFunctions->procesa_pago($data_user);

            $this->models_Conekta->update($_POST['id'],$conekta_get['data']);

            $this->models_Usuarios->update_where(['correo'=>$data_user['correo']],['efectivo'=>$efectivo,'tarjeta'=>$tarjeta]);

            if($conekta_get['data']['status']=='paid')
            {
                $this->models_Usuarios->update_where(['correo'=>$data_user['correo']],['activo'=>1]);

            }
            $result = array_merge($conekta_get['data'],$conekta_get['utils']);
            $result = array_merge($result,$data_user);

            $this->create_session(['all_vars'=>array_merge($result,array('id'=>$_POST['id']))]);
            $this->redirect_run('succes');
        }
        else
        {
            var_dump(array('message'=>'404'));
        }
    }

    public function succes()
    {
        $vars = $this->get_session('all_vars');

        
        switch($vars["origen"]) {
             case 'cash':
                $this->set_view('oxxo',$vars,true);
                break;
            case 'bank':
                $this->set_view('banorte',$vars,true);
                break;

            case 'card':
                if ($status == "paid") {
                    $mail = new controllers_Mails();
                    if($mail->send_paid_mail($vars['nombre'],$vars['correo']))
                    {
                        $this->set_view('tcPaid',$vars,true);
                    }

                } else {
                    $this->set_view('tc',$vars,true);
                }
                break;
            default:
                $this->set_view('default',$vars,true);
                break;
        }

    }


} 