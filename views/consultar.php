
<!-- Consultar -->
<div class="container consultar" id="consultar">
	<article>
		<section class="col-md-8 alinearContenedor">
			<div class="col-md-12 tituloConsultar">
				Consulta tu número de Folio o confirma tu pago.
			</div>
			<div class="col-md-6 consultarNumero">
				
				<form role="form" id="consultar-form"  action="inscripcion.php?accion=consulta" method="post">
					<div class="form-group">
						<label for="eMailConsultar">Ingresa tu e-Mail para consultar tu número de folio o confirmar tu pago</label>
						<input type="text" class="form-control" name="eMailConsultar" id="eMailConsultar" placeholder="ejemplo@hotmail.com">
					</div>
					<input type="submit" name="enviar" id="enviar" class="btn btn-default" value="Consultar" />                     
				</form>

			</div>
		</section>
	</article>
</div>
