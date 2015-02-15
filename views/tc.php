<div class=" col-xs-8 col-lg-8 col-md-8 col-xs-offset-2 col-lg-offset-2 col-md-offset-2" style="font-size:14px; background:#fff !important;">

<div class="col-md-12">
<div class="col-md-12 tituloStatus"><strong> Gracias, <?= ucwords ($nombre); ?>:</strong>
<span> Te sera enviado un mail al correo que registraste dentro de los tres días hábiles y posteriores a que realices tu pago.</span></div>

					

					<div class="col-md-6 datosPago">

						<div class="col-md-12 totalTexto">Tu total a pagar es de: <?= $cantidad_pago/100; ?></div>

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
								<td>Fundacion kasparov</td>
							</tr>
							<tr>
								<td>Referencia:</td>
								<td><?= $reference;?></td>
							</tr>
							
						</table>
						
						

					</div>
	

	<div class="col-md-12">
		<span><?= $error_code;?></span>
	</div>


	<div class="col-md-12">
		<h6>Estos codigos no tienen otro fin que ser un comprobante</h6>
	</div>
	
</div>
</div>