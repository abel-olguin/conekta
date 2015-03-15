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
        $this->load_model('models_Productos');
        $this->load_model('models_Cupones');
        $this->load_repo('repositories_ConektaFunctions');

    }

    /**
     * Muestra el Home
     *
     * Funcion encargada de mostrar la pagina de inicio del
     * sistema
     *
     */
    public function home()
    {
        $vars = $this->models_Productos->get_all_products();
        $this->set_view('home',['productos'=>$vars]);
    }

    public function registro()
    {
        $user_id = $this->verify_session();
        if(!$user_id)
        {
            $this->set_view('registro');
        }
        else
        {
            $this->redirect_run('home');
        }
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
                'password'         => $_POST['pass'],
                'apellido_paterno' => $_POST['apellido_paterno'],
                'apellido_materno' => $_POST['apellido_materno'],
                'genero'           => $_POST['genero'],
                'fecha_nac'        => $_POST['dia'].'-'.$_POST['mes'].'-'.$_POST['anio'],
                'pais'             => $_POST['pais'],
                'activo'           => 1
            );


            $insert_user    = $this->models_Usuarios->insert($data_user);


            $mail = new controllers_Mails();

            if($mail->send_inscripcion_mail($data_user['nombre'],$data_user['correo'])) {
                $this->redirect_run('login');
            }
            $this->redirect_run('login');//debug localhost


        }
        else
        {
            var_dump(array('message'=>'404'));

        }

    }

    /**
     * Pantalla de registro
     *
     * Si los datos son correctos se genera una cookie
     * con el id del usuario para posteriormente ser usada
     * en el resto de flujo
     */
    public function login()
    {
        if(!isset($_COOKIE['id_user']))
        {
            if($_POST)
            {
                $data = array(
                    'correo'     => $_POST['correo'],
                    'password'   => $_POST['pass']
                );

                $user = $this->models_Usuarios->find_where($data);

                $_SESSION['id_user'] = $user[0]['id'];

                $this->redirect_run('home');//debug localhost

            }
            $this->set_view('login');
        }
        else
        {
            $this->redirect_run('home');
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
        $user_id = $this->verify_session();

        if($user_id)
        {
            $producto = $this->models_Productos->find('id',$_POST['id_producto']);
            $usuario  = $this->models_Usuarios->find('id',$user_id);
            $meses_a  = [3,6,9,12];
            $costo    = $producto[0]['precio'];
            $meses    = array();
            $cupones  = 0;

            for($i = 0; $i < count($meses_a) ; $i++)
            {
                if(($costo/$meses_a[$i])>10)
                {
                    $meses[] = $meses_a[$i];
                }
            }
            if($producto[0]['cupones'])
            {
                $cupones  = $this->check_cupones($_POST['id_producto'])?1:0;
            }
            $data_conekta = array(
                'correo'          => $usuario[0]['correo'],
                'status'          => 0,
                'cantidad_pago'   => $costo,
                'pais'            => $usuario[0]['pais'],
                'id_producto'     => $_POST['id_producto'],
                'mensualidades'   => $producto[0]['mensualidades'],
                'cupones'         => $cupones,
                'meses'           => $meses
            );



            $this->set_view("pago",array_merge($data_conekta,$usuario[0]),true);
        }
        else
        {
            $this->redirect_run('login');
        }


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
            if(isset($_POST['meses'])&&$_POST['meses']!='')
            {
                $this->pago_mensual($_POST);
            }
            else
            {
                $this->pago_gral($_POST);
            }
        }
        else
        {
            var_dump(array('message'=>'404'));
        }
    }

    private function pago_mensual($data)
    {
        $producto   = $this->models_Productos->find('id',$data['producto']);
        $precio     = (int)$producto[0]['precio']."00";
        $nombre     = $data['nombre'];
        $correo     = $data['correo'];

        $submit       = array(
                'producto'      => $producto[0],
                'meses'         => $data['meses'],
                'conekta_id'    => $data['conektaTokenId'],
                'tipo_pago'     => $data['tipo_pago'],
                'nombre'        => $data['nombre'],
                'correo'        => $data['correo'],
                'origen'        => 'card'
        );

        $get = $this->repositories_ConektaFunctions->procesa_mensualidades($submit);



        if(!empty($get))
        {
            $add = array(
                'id_transaccion'  => 'NULL',
                'reference'       => 'NULL',
                'barcode'         => 'NULL',
                'barcode_url'     => 'NULL',
                'service_number'  => 'NULL',
                'status'          => 1
            );


            $this->models_Conekta->insert(array_merge($get['data'],$add));

            $send   = compact('nombre','correo');
            //$mail->send_mail_succes_pay($send);  //enviamos un mail
            $vars = array(

            );
            $this->create_session(['all_vars'=>array_merge($submit,$get['utils'])]);
            $this->redirect_run('succes');
        }

    }

    /**
     * @param $data
     *
     * Procesa sin meses
     *
     * Funcion encargada de procesar un pago que no
     * requiere meses sin intereses
     */
    private function pago_gral($data)
    {
        $producto   = $this->models_Productos->find('id',$data['producto']);
        $precio     = (int)$producto[0]['precio']."00";
        $descuento  = (int)(isset($data['descuento'])&&$data['descuento']>0)?'.'.$data['descuento']:0;
        $desc_aux   = $precio-($precio*$descuento);
        $precio_f   = is_float($desc_aux)?ceil($desc_aux):$desc_aux;

        $data_user = array(
            'nombre'        => $data['nombre'],
            'cantidad_pago' => $precio_f,
            'correo'        => $data['correo'],
            'tipo_pago'     => $data['tipo_pago'],
            'conekta_id'    => isset($data['conektaTokenId'])?$data['conektaTokenId']:''
        );

        $conekta_get  = $this->repositories_ConektaFunctions->procesa_pago($data_user);
        $conekta_data = $conekta_get['data'];

        $insert_conekta = array(
            'correo'          => $data['correo'],
            'id_producto'     => $data['producto'],
            'cantidad_pago'   => $precio_f,
            'id_transaccion'  => $conekta_data['id_transaccion'],
            'status'          => $conekta_data['status'],
            'reference'       => $conekta_data['reference'],
            'barcode'         => $conekta_data['barcode'],
            'barcode_url'     => $conekta_data['barcode_url'],
            'service_number'  => $conekta_data['service_number'],
            'origen'          => $conekta_data['origen']
        );

        $this->models_Conekta->insert($insert_conekta);

        $result = array_merge($conekta_get['data'],$conekta_get['utils']);
        $result = array_merge($result,$data_user);

        $this->create_session(['all_vars'=>$result]);
        $this->redirect_run('succes');
    }

    /**
     * Selecciona la vista acorde al metodo de pago
     *
     * Funcion encargada de traer vistas acorde al origen de pago
     *
     */
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
                if ($vars["status"] == "paid") {
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

    public function verify_cupon_ajax()
    {
        $cupon  = $_POST['cupon'];
        if(!empty($cupon))
        {

            $check  = $this->models_Cupones->find_where(['codigo'=>$cupon,'deleted'=>0,'status'=>0]);

            $result = array();
            if(isset($check[0])&&!empty($check[0]))
            {
                $this->models_Cupones->update($check[0]['id'],['status'=>1]);
                $result = ['response'=>'ok','value'=>$check[0]['descuento']];
            }
            else
            {
                $check  = $this->models_Cupones->find_where(['codigo'=>$cupon,'deleted'=>0,'status'=>1]);
                if(isset($check[0])&&!empty($check[0]))
                {
                    $result = ['response'=>'error','message'=>'El codigo ya fue usado'];
                }
                else
                {
                    $result = ['response'=>'error','message'=>'El codigo es incorrecto'];
                }

            }

        }
        else
        {
            $result = ['response'=>'ok','value'=>0];
        }
        echo json_encode($result);
    }

    /**
     * @param $id_producto
     * @return bool
     *
     * Verifica la existencia de cupones disponibles
     *
     * Funcion encargada de verigicar si aun hay cupones
     * disponibles para el articulo especifico
     */
    private function check_cupones($id_producto)
    {
        $status = $this->models_Cupones->find_where(['id_producto'=>$id_producto,'deleted'=>0,'status'=>0],1);
        $data  = array();

        if(isset($status[0]['id']) && !empty($status[0]['id']))
        {

            return true;

        }else
        {
            return false;
        }

    }




} 