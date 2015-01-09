<?php
require_once("conexion.php");
/**

* Clase principal de todo el sistema 
*
*
*
**/
ini_set('display_errors',0);
class Core{

/**** variables ****/
private $totalPago;
private $usuarios;
private $conekta;
private $numeros;


/*** constructor ***/
public function __construct($usuarios = " ",$conekta = " ",$numeros="tbl_numeros"){
	$this -> usuarios = $usuarios;
	$this -> conekta  = $conekta;
	$this -> numeros  = $numeros;
}


/***obtener el total a pagar ****/
public function getTotalPago(){
	return $this -> totalPago;
}
/***actualizar el total a pagar ***/
public function setTotalPago($pago){

	if(is_numeric($pago)){
		$this -> totalPago = $pago;
	}else{
		$this -> totalPago = 0;
	}
}
/***** llenar select con fechas *******/
/****año *****/
public function getOptionYear(){
	for($i=2005; $i>=1930; $i--){
          if ($i == 2005)
            echo '<option value="'.$i.'">'.$i.'</option>';
          else
           echo '<option value="'.$i.'">'.$i.'</option>';
       }
}
/**** mes *****/
public function getOptionMonth(){
	for ($i=1; $i<=12; $i++) {
           if ($i == date('m'))
             echo '<option value="'.$i.'">'.$i.'</option>';
           else
            echo '<option value="'.$i.'">'.$i.'</option>';
        	}
}
/**** dia *****/
public function getOptionDay(){
	for ($i=1; $i<=31; $i++) {
               if ($i == date('j')){
                echo '<option value="'.$i.'">'.$i.'</option>';
              } else{
               echo '<option value="'.$i.'">'.$i.'</option>';
             }
           }
}

/*****insertar en una tabla ****/
public function insertar($array,$tipo){//"nombre","aMaterno","aPaterno","correo","sex","fechaNac","pais"
$usuarios = $this -> usuarios;
$conekta  = $this -> conekta;

if(!empty($array)){
	
	extract ($array);
	
	$hoy = date("d-m-Y G:i:s");

		switch ($tipo) {
			case 'competidor':
				$sql = "INSERT INTO $usuarios(nombre,aPaterno,aMaterno,edad,sexo,rfc,curp,email,
				telefonoFijo,telefonoMovil,calle,numero,colonia,cp,delegacion,estado,pais,gradoEstudios,
				esDocente,sistemaDocente,nombreInstitucion,calleInstitucion,numeroInstitucion,
				coloniaInstitucion,cpInstitucion,delegacionInstitucion,ciudadInstitucion,claveInstitucion,
				telefonoInstitucion,nivelEducativo,trabajoActual,sectorTrabajo,otroSectorTrabajo,
				nombreEmpresa,calleEmpresa,numeroEmpresa,coloniaEmpresa,cpEmpresa,delegacionEmpresa,
				estadoEmpresa,pasiEmpresa,eLearning,sabeAjedrez,nivelAjedrez,clubAjedrez,nombreClub,
				calleClub,numeroClub,coloniaClub,cpClub,delegacionClub,ciudadClub,telefonoClub,emailClub,
				webClub,extranjero,sede,docenteArea,horasLearning,password) 
			VALUES ('$nombre','$aPaterno','$aMaterno',$edad,'$sex','$rfc','$curp','$correo',$telefono,$movil,
				'$calle',$numero,'$colonia',$cp,'$delegacion','$estado','$pais',
				'$estudios','$docente','$docenteSistema','$nombreInstitucion','$calleInstitucion',
				$numeroInstitucion,'$coloniaInstitucion',$cpInstitucion,'$delegacionInstitucion',
				'$ciudadInstitucion','$claveInstitucion',$telefonoInstitucion,'$nivelEducativoInstitucion',
				'$trabajo','$sector','$trabajoOtro','$nombreEmpresa',
				'$calleEmpresa',$numeroEmpresa,'$coloniaEmpresa',$cpEmpresa,
				'$delegacionEmpresa','$estadoEmpresa','$paisEmpresa','$expCurso','$jugar',
				'$nivelJuego','$club','$nombreClub','$calleClub',$numeroClub,'$coloniaClub',
				$cpClub,'$delegacionClub','$ciudadClub',$telefonoClub,'$emailClub','$paginaClub',$intExtranjero,'$sede','$docenteArea'
				,'$horasLearning','$password')";
					
					$resultado = $GLOBALS['conexion']->query($sql);
						if($resultado){
							return 1;
						}else{
							return 0;
						}
				break;

			case 'conekta':
						$sql = "INSERT INTO $conekta(correo,status,cantidad_pago,fecha_operacion,pais) VALUES 
															('$correo',0,$totalPago,'$hoy','$pais')";

							$resultado = $GLOBALS['conexion']->query($sql);
								if($resultado){
									return 1;
								}else{
									return 0;
								}
				break;

			case 'card':
						$sql = "UPDATE $usuarios SET tarjeta=1, efectivo=0 WHERE email LIKE '$correo'";
						$resultado = $GLOBALS['conexion']->query($sql);

							$sql = "UPDATE $conekta SET id_transaccion='$id',codigo_barras='null',url_codigo_barras = 'null',origen='TC',referencia = '$reference' ,fecha_expiracion = '$expirationDate' WHERE correo LIKE '$correo'";
								
								$resultado = $GLOBALS['conexion']->query($sql);
									if($resultado){
										return 1;
									}else{
										return 0;
									}
				break;

			case 'oxxo':
						$sql = "UPDATE $usuarios SET tarjeta=0, efectivo=1 WHERE email LIKE '$correo'";
						$resultado = $GLOBALS['conexion']->query($sql);

							$sql = "UPDATE $conekta SET id_transaccion='$id',codigo_barras='$barcode',origen='OXXO',referencia='$reference',url_codigo_barras = '$barcode_url',fecha_expiracion = '$expirationDate'  WHERE correo LIKE '$correo'";

								$resultado=$GLOBALS['conexion']->query($sql);
									if($resultado){
										return 1;
									}else{
										return 0;
									}
				break;

			case 'banorte':
						$sql = "UPDATE $usuarios SET tarjeta=0, efectivo=1 WHERE email LIKE '$correo'";
						$resultado = $GLOBALS['conexion']->query($sql);

							$sql   = "UPDATE $conekta SET id_transaccion='$id',codigo_barras='null',url_codigo_barras = 'null',referencia = '$reference',origen='BANORTE',fecha_expiracion = '$expirationDate',numero_servicio = '$serviceNumber'  WHERE correo LIKE '$correo'";

								$resultado = $GLOBALS['conexion']->query($sql);
									if($resultado){
										return 1;
									}else{
										return 0;
									}
				break;

			default:
				return 0;
				break;
		}

	}else{
		return 0;
	}//empty array
}

/**
* eliminar un registro 
*
* Elimina un registro de la tabla conekta a partir del id
*/

public function eliminarMetodo($correo)
{
	$usuarios = $this->usuarios;

	$sql = "UPDATE $usuarios SET efectivo = 0, tarjeta = 0 WHERE correo LIKE '$correo'";

	$resultado = $GLOBALS['conexion']->query($sql);
									if($resultado){
										return 1;
									}else{
										return 0;
									}

}

/**

* asignar un numero o estatus
* en el caso de que requieras enviar un tipo de comprobante de pago una vez finalizado este
* o solo para diferenciarlos
**/

public function getNumero($correo){
	$usuarios = $this->usuarios;
 	$numeros  = $this->numeros;
 	$conekta  = $this->conekta;

	$sql    = "SELECT * FROM $usuarios WHERE email LIKE '$correo' AND activo=0";//verifico que exista no este activo
	
	$result = $GLOBALS["conexion"]->query($sql);
	
	if ($result->num_rows==1) {

		
			$sql = "SELECT numero FROM $numeros WHERE disponible=0 ORDER BY id LIMIT 1";

			$resultado = $GLOBALS["conexion"]->query($sql);

			if($resultado->num_rows == 1){

				$folio  = $resultado->fetch_assoc();
				$numero = $folio['numero'];

				$sql = "UPDATE $usuarios SET activo=1, folioInscripcion='$numero' WHERE email LIKE ?";//cambio su estatus
				$result = $GLOBALS["conexion"]->prepare($sql);
				$result->bind_param("s", $correo);
    			$result->execute();

				if($result->affected_rows == 1){

					  	$result->close();

						$sql = "UPDATE $conekta SET status=1 WHERE correo LIKE ?";//cambio su estatus
						$result = $GLOBALS["conexion"]->prepare($sql);
						$result->bind_param("s", $correo);
    					$result->execute();	

							if($result->affected_rows == 1){

								$result->close();
								$sql = "UPDATE $numeros SET disponible=1 WHERE numero LIKE ? ";//cambio su estatus
								$result = $GLOBALS["conexion"]->prepare($sql);

								$result->bind_param("s", $numero);
		    					$result->execute();	
								if($result->affected_rows == 1){
									$result->close();
									return $numero;
								}else{//if($result->affected_rows == 1){
									return 0;
								}

						}else{//if($result->affected_rows == 1){ conekta
							return 0;
						}

					}else{//if($result->affected_rows == 1){ usuarios
							return 0;
						}


			}else{//if($resultado){
				return 0;
			}
			
	}else{ //if ($result->num_rows == 1)
		return 0;
	}
}
/**

* primer mail; el de inscripcion 
* este mail se envia una vez que el cliente genero el recibo de pago
**/
public function enviarMailInscripcion($variables){
	$hoy = date("d-m-Y G:i:s");
	extract($variables);
	

				$headers  ='MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Kasparov <webmaster@kasparovfundacionajedrez.com>' . "\r\n";  /*Nombre Sitio <info@url del sitio>*/
				$asunto   ="Inscripcion";
			
				
					$escribirMensaje = '
				   
					<table width="600" border="0" align="center" cellpadding="1" cellspacing="0">
  <tbody><tr>
    <td bgcolor="#666666"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td><img src="https://kasparovfundacionajedrez.com/convocatoria/images/header.jpg" width="600" height="124"></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><p>&nbsp;</p>
          <p>Mexico DF, a: <span class="titulo-ngo-01"><strong>'.$hoy.'</strong></span><br>
            Estimado: <span class="titulo-ngo-01"><strong>'.$nombre.'</strong></span></p>
          <p> Te has inscrito Seminario de Capacitación y Certificación para formar Profesores de Ajedrez.

<b>"El Ajedrez como Herramienta Pedagógica"</b></p>
           <p>los datos con los que te registraste son:</p>
      </tr>

      <tr align="center">
        <td bgcolor="#FFFFFF">nombre: <strong>'.$nombre.'</strong></td>
      </tr>

      <tr align="center">
        <td bgcolor="#FFFFFF">Mail: <strong>'.$correo.'</strong></td>
      </tr>

      
      <tr align="center">
        <td bgcolor="#FFFFFF"><p>Ingresa aquí para cosultar tu numero una vez que hayas pagado: <strong><a href="https://kasparovfundacionajedrez.com/convocatoria/inscripcion.php?accion=consultar"">consulta</a></strong></p></td>
        
      </tr>
      
      <br/>
      <tr>
        <td bgcolor="#99CA3C"><table width="580" border="0" align="center" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td height="70" align="center"><strong>Copyright 2014</strong><br>
              Todos los derechos reservados. Este material no puede ser copiado o<br>
              reproducido sin autorización escrita.<br>
              <a href="https://kasparovfundacionajedrez.com/" target="_blank">https://kasparovfundacionajedrez.com/</a></td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
				
								
					';		

					
					return mail($correo, $asunto, utf8_decode($escribirMensaje), $headers);
}

/**

* mail que se envia una vez pagado el recibo de pago o si uso tarjeta se hace automaticamente
* solo aplica a pagos finalizados
**/

public function enviarMailPagado($nombre,$correo,$numero){
 
$hoy = date("d-m-Y");
        $headers ='MIME-Version: 1.0' . "\r\n";
        $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers.= 'From: Kasparov <webmaster@kasparovfundacionajedrez.com>' . "\r\n";  /*Nombre Sitio <info@url del sitio>*/
        $asunto="Felicidades!!";
      
        
          $escribirMensaje = '
           


          	<table width="600" border="0" align="center" cellpadding="1" cellspacing="0">
  <tbody><tr>
    <td bgcolor="#666666"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td><img src="https://kasparovfundacionajedrez.com/convocatoria/images/header.jpg" width="600" height="124"></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><p>&nbsp;</p>
          <p>Mexico DF, a: <span class="titulo-ngo-01"><strong>'.$hoy.'</strong></span><br>
            Estimado: <span class="titulo-ngo-01"><strong>'.$nombre.'</strong></span><br>
            Tu numero es: <span class="titulo-ngo-01"><strong>'.$numero.'</strong></span>
            </p>
          <p> Tu registro ha sido completado.</p>
          <h4>GRACIAS!!</h4>
      </tr>

         <tr align="center">
        <td bgcolor="#FFFFFF"><p>Ingresa aquí para cosultar tu numero una vez que hayas pagado: <strong><a href="https://kasparovfundacionajedrez.com/convocatoria/inscripcion.php?accion=consultar">consulta</a></strong></p></td>
        
      </tr>
      
      <br/>
      <tr>
        <td bgcolor="#99CA3C"><table width="580" border="0" align="center" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td height="70" align="center"><strong>Copyright 2014</strong><br>
              Todos los derechos reservados. Este material no puede ser copiado o<br>
              reproducido sin autorización escrita.<br>
              <a href="https://kasparovfundacionajedrez.com/" target="_blank">https://kasparovfundacionajedrez.com/</a></td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
          ';    

          
          return mail($correo, $asunto, utf8_decode($escribirMensaje), $headers);
}

function consulta($correo){

	$usuarios = $this->usuarios;
 	$numeros  = $this->numeros;
 	$conekta  = $this->conekta;

	$sql = "SELECT * FROM $usuarios WHERE email='$correo' and activo=1";
	//si activo 1 es que
	$consulta = $GLOBALS["conexion"]->query($sql);

	$existe  = $consulta->num_rows;
	
	
	if($existe>0){
		$rs       = $consulta->fetch_assoc();
		$nombre   = $rs['nombre'];
		$aPaterno = $rs['aPaterno'];
		$aMaterno = $rs['aMaterno'];
		$numero   = $rs['numero'];
		$nivel    = $rs['nivelAjedrez'];
		$correo   = $rs['email'];

		$_SESSION['variables'] = compact('nombre','aPaterno','aMaterno','numero','nivel','correo');
		?>
		<script>
 setTimeout("location.href = 'inscripcion.php?accion=competidor';",2000);
		</script>
		<?php
		}
		else
		{

		$sql = "SELECT * FROM $usuarios WHERE email='$correo' ";

		$consulta = $GLOBALS["conexion"]->query($sql);
		$existe   = $consulta->num_rows;
		

		if($existe>0){
			$rs 	  = $consulta->fetch_assoc();
		$sql = "SELECT $usuarios.email AS ".$usuarios."_mail,$usuarios.nombre,$usuarios.aPaterno,$usuarios.aMaterno,$usuarios.nivelAjedrez,$usuarios.efectivo,$usuarios.tarjeta,$conekta.id_transaccion,$conekta.codigo_barras,$conekta.cantidad_pago,$conekta.origen,
		$usuarios.sede,$conekta.url_codigo_barras,$conekta.referencia,$conekta.fecha_operacion,$conekta.fecha_expiracion,$conekta.numero_servicio
		 FROM $conekta INNER JOIN asistentes ON $conekta.correo = $usuarios.email WHERE $usuarios.email='$correo'";
		

		 $expiracion="";
		$consulta = $GLOBALS["conexion"]->query($sql);
		$rs = $consulta->fetch_assoc();
		
		if( $rs['efectivo']){
					$pago 		 	= $rs['cantidad_pago']*100;
				    $barcode     	= $rs['codigo_barras'];
					$id 	     	= $rs['id_transaccion'];
					$reference   	= $rs['referencia'];
					$barcode_url 	= $rs['url_codigo_barras'];
					$createAt	 	= $rs['fecha_operacion'];
					$expirationDate = $rs['fecha_expiracion'];
					$serviceNumber	= $rs['numero_servicio'];
					$correo			= $rs[$usuarios.'_mail'];
					$nombre 		= $rs['nombre']." ".$rs['aPaterno']." ".$rs['aMaterno'];
					$tipoPago  = strtolower($rs['origen']);
					
					$_SESSION['variables'] = compact('barcode','id','tipoPago','barcode_url','reference','pago','createAt','expirationDate','serviceNumber','correo','nombre');
				
				echo '<div class="mesageNoPago col-md-8 col-sm-offset-2"><h1>Tu pago aun no se ve reflejado, a continuacion se te redirigira a la ficha de pago.</h1></div>';
				?>
				<script>
		     	setTimeout("location.href = 'inscripcion.php?accion=success';",5000);
		     	</script>
				
				<?php
				}elseif ($rs['tarjeta']) {

					
				    $reference  = $rs['referencia'];
					$id 	    = $rs['id_transaccion'];
					$tipoPago   = strtolower($rs['origen']);
					$nivelJuego = $rs['nivelAjedrez'];
					$_SESSION['variables'] = compact('nivelJuego','id','tipoPago','reference');
							
				echo '<div class="mesageNoPago col-md-8 col-sm-offset-2"><h1>Tu pago aun no se ve reflejado, a continuacion se te redirigira a la ficha de pago.</h1></div>';
				?>

				<script>
		     	setTimeout("location.href = 'inscripcion.php?accion=success';",5000);
		     	</script>
		     	<?php
				}else{
					$totalPago 		= $rs['cantidad_pago'];
					$correo			= $rs[$usuarios.'_mail'];
					$nombre 		= $rs['nombre']." ".$rs['aPaterno']." ".$rs['aMaterno'];
					$nivelJuego		= $rs['nivelAjedrez'];
					
					$_SESSION['variables'] = compact('correo','nombre','totalPago','nivelJuego');
				
					?>



					<div class="mesageNoPago col-md-8 col-sm-offset-2" style="min-height: 300px; background-color:#fff;"><h1>No se encontro un metodo de pago, por favor da clic en el boton para realizar tu pago.
					<br>
					<br>
					<a href="inscripcion.php?accion=pago"><div class="col-md-2 iniciobtn">PAGAR</div></a>
					
				<?php }
		}else{
			echo '<div class="mesageNoPago col-md-8 col-sm-offset-2"><h1>tus datos no fueron encontrados en breve seras redirigido al registro.</h1></div>';
			?>
			<script>
		     	setTimeout("location.href = 'inscripcion.php?accion=home';",5000);
		     	</script>
			<?php
		}
		}



}

}


?>