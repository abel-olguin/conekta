<div class=" col-xs-8 col-lg-8 col-md-8 col-xs-offset-2 col-lg-offset-2 col-md-offset-2" style="font-size:14px; background:#fff !important;">
<div class="col-md-12">
		<span><?= $error_code;?></span>
	</div>




		<section class="col-md-12 ">
				 <div class="textoConsulta">
				<div class="col-md-10 tituloStatus">Felicidades <strong><?= ucwords($nombre); ?></strong></div>
				<div class="col-md-10 numeroCompetidor">

				</div>
				</div>
				<div class="col-md-12 detallesPago">
					<div class="col-md-10 tituloContenedor">
						IMPRIME ESTA PÁGINA Y CONSÉRVALA COMO COMPROBANTE DEL REGISTRO Y PAGO
					</div>
					<div class="col-md-12 textoContenedor">
						<p>*Los datos que ingresaste y registramos para enviarte un email de confirmación de participación son: </p>

						<div class="col-md-6 datosCompetidor"><?= ucwords($correo); ?></div>
						<div class="col-md-6 datosCompetidor"><?= ucwords($nombre); ?></div>
						
						
					</div>
				</div>
				<div class="col-md-2 imprimir"  onclick="window.print(); return false;">Imprimir</div>
			<div class="botonInicio">
			<a href="inscripcion.php?accion=home"><div class="col-md-2 iniciobtn">Inicio</div></a>
			</div>
					
			</section>
			</div>
