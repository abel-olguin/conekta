<?php

if($_SESSION){
extract($_SESSION["variables"]); 
?>
<div class="col-md-12">
<div class="col-md-12 tituloStatus"><strong> Gracias, <?php echo ucwords ($nombre); ?>:</strong>
<span> Te sera enviado un mail al correo que registraste dentro de los tres días hábiles y posteriores a que realices tu pago.</span></div>

					

					<div class="col-md-6 datosPago">

						<div class="col-md-12 totalTexto">Tu total a pagar es de: $ <?= $pago/100; ?></div>
						
						<div class="col-md-6 logoEfectivoBanorte">
							Medio de Pago:
							<img src="images/banorte.png" alt="">
						</div>
						

					</div>


					<div class="col-md-6 datosPagoPayu">

						<div class="col-md-12 infoPago">Información del Pago</div>
						<table class="col-md-11 tablaDetalles">

							<tr>
								<td>ID verificacion:</td>
								<td><?= $id;?></td>
							</tr>
							<tr>
								<td>Beneficiario:</td>
								<td>Fundacion kasparov</td>
							</tr>
							<tr>
								<td>Referencia:</td>
								<td><?= $reference;?></td>
							</tr>
							<tr>
								<td>Numero de servicio:</td>
								<td><?= $serviceNumber;?></td>
							</tr>
							<tr>
								<td>Fecha de creación:</td>
								<td><?= $createAt; ?></td>
							</tr>
							<tr>
								<td>Fecha de expiración:</td>
								<td><?= $expirationDate; ?></td>
							</tr>
		
						</table>
						
						

					</div>
	

	<div class="col-md-12">
		<span><?= $error_code;?></span>
	</div>

</div>

<div class="col-md-12 detallesPagoOxxo">

					<div class="col-md-12 tituloContenedor">

						*IMPRIME Y GUARDA ESTA PAGINA COMO COMPROBANTE DE REGISTRO Y PRESÉNTALO JUNTO CON TU RECIBO DE PAGO O DEPOSITO PARA PARTICIPAR DEL SEMINARIO.

					</div>

					
					<div class="col-md-12 textoContenedor">

						<p>*SI NO RECIBIMOS TU PAGO, TU REGISTRO QUEDARA CANCELADO.</p>


						<p>*Los datos que ingresaste y registramos para enviarte un email de confirmaci&oacute;n de participación: </p>



						<div class="col-md-12 datosCompetidor">email: <?php echo " ".$correo; ?></div>

						<div class="col-md-12 datosCompetidor">nombre: <?php echo " ".ucwords ($nombre);?></div>
						<br>
						<br>
						
					</div>
					<div style="clear:both;"> </div>
<div class="aclaraciones">
						<p>*Aclaración para el pago en ventanilla de la inscripción al Seminario de Capacitación y Certificación para formar Maestros de Ajedrez. El Ajedrez como Herramienta Pedagógica.</p>

 
						<ul>
							<li>Al realizar el pago en ventanilla bancaria para cubrir el pago de tu inscripción al Seminario, por favor toma en cuenta lo siguiente:</li>
							<li>No olvides llevar la presente ficha de pago impresa.</li>
							<li>Considera que la empresa que recibe el pago de la inscripción se llama NOMBRE CUENTA, y que el beneficiario es FUNDACION KASPAROV.</li>

						</ul>


						<p>Siguiendo estos sencillos pasos, se agilizará tu trámite.</p>

						<p>Atentamente, Fundación Kasparov de Ajedrez para Iberoamérica.</p>
					</div>

			
				</div>
			<div class="col-md-2 imprimir"  onclick="window.print(); return false;">Imprimir</div>
			<div class="botonInicio">
			<a href="inscripcion.php?accion=home"><div class="col-md-2 iniciobtn">Inicio</div></a>
			</div>
			<?php
}
			?>