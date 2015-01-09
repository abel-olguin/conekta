<?php
if($_SESSION){
extract($_SESSION["variables"]); 
?>



	<div class="col-md-12">
		<span><?= $error_code;?></span>
	</div>




		<section class="col-md-12 ">
				 <div class="textoConsulta">
				<div class="col-md-10 tituloStatus">Felicidades <strong><?php echo ucwords($nombre); ?></strong></div>
				<div class="col-md-10 numeroCompetidor">
					
					<p>Estas inscrito para participar con el número de folio</p>
					<span><strong><?= $numero;?></strong></span>
					<p>Nivel de juego</p>
					<p><strong><?= $nivel?></strong></p>

				</div>
				</div>
				<div class="col-md-12 detallesPago">
					<div class="col-md-10 tituloContenedor">
						IMPRIME ESTA PÁGINA Y CONSÉRVALA COMO COMPROBANTE DEL REGISTRO Y PAGO
					</div>
					<div class="col-md-12 textoContenedor">
						<p>*Los datos que ingresaste y registramos para enviarte un email de confirmación de participación son: </p>

						<div class="col-md-6 datosCompetidor"><?php echo ucwords($correo); ?></div>
						<div class="col-md-6 datosCompetidor"><?php echo ucwords($nombre); ?></div>
						
						
					</div>
				</div>
				<div class="col-md-2 imprimir"  onclick="window.print(); return false;">Imprimir</div>
			<div class="botonInicio">
			<a href="inscripcion.php?accion=home"><div class="col-md-2 iniciobtn">Inicio</div></a>
			</div>
					
			</section>
<?php

}

?>