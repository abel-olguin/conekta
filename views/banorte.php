<div class=" col-xs-8 col-lg-8 col-md-8 col-xs-offset-2 col-lg-offset-2 col-md-offset-2" style="font-size:14px; background:#fff !important;">
<div class="col-md-12">
<div class="col-md-12 tituloStatus"><strong> Gracias, <?= ucwords ($nombre); ?>:</strong>
<span> Te sera enviado un mail al correo que registraste dentro de los tres días hábiles y posteriores a que realices tu pago.</span></div>

					

					<div class="col-md-6 datosPago">

						<div class="col-md-12 totalTexto">Tu total a pagar es de: $ <?= $cantidad_pago/100; ?></div>
						
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
								<td><?= $id_transaccion;?></td>
							</tr>
							<tr>
								<td>Beneficiario:</td>
								<td>Tienda</td>
							</tr>
							<tr>
								<td>Referencia:</td>
								<td><?= $reference;?></td>
							</tr>
							<tr>
								<td>Numero de servicio:</td>
								<td><?= $service_number;?></td>
							</tr>
							<tr>
								<td>Fecha de creación:</td>
								<td><?= $create_at; ?></td>
							</tr>
							<tr>
								<td>Fecha de expiración:</td>
								<td><?= $expiration; ?></td>
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



						<div class="col-md-12 datosCompetidor">email: <?= $correo; ?></div>

						<div class="col-md-12 datosCompetidor">nombre: <?= ucwords ($nombre);?></div>
						<br>
						<br>
						
					</div>
					<div style="clear:both;"> </div>

				</div>
			<div class="col-md-2 imprimir"  onclick="window.print(); return false;">Imprimir</div>
			<div class="botonInicio">
			<a href="inscripcion.php?accion=home"><div class="col-md-2 iniciobtn">Inicio</div></a>
			</div>
</div>