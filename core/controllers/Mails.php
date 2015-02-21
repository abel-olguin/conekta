<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 21/02/2015
 * Time: 02:32 AM
 */

class controllers_Mails {
    /**

     * primer mail; el de inscripcion
     * este mail se envia una vez que el cliente genero el recibo de pago
     **/
    public function send_inscripcion_mail($nombre,$correo){

        $hoy = date("d-m-Y G:i:s");


        $headers  ='MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Abel <webmaster@abel-olguin.com>' . "\r\n";  /*Nombre Sitio <info@url del sitio>*/
        $asunto   ="Verificacion de correo";


        $escribirMensaje = '<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin:0; padding:0;">
	<tr>
		<td valign="top" width="100%" align="center" bgcolor="#389ea2">
			<table width="650" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; margin:0 auto;">

				<!--Inicio de Cabecera-->
				<tr>
					<td valign="middle" width="325" height="100">

						<!--Logo-->
						<a href="http://abel-olguin.com/" target="_blank"><img src="http://abel-olguin.com/wp-content/uploads/2014/10/logo.png" alt="logo" width="325" height="80" border="0" style="display:block;" /></a>
					</td>
					<td valign="middle" width="295" align="right">

						<!--Redes Sociales-->

						<!--twitter-->
						<a href="https://twitter.com/iscariot696" target="_blank" title="twitter"><img src="img/twitter.jpg" alt="twitter" width="32" border="0" /></a>

						<!--facebook-->
						<a href="https://www.facebook.com/ingeniero.Olguin" target="_blank" title="facebook"><img src="img/facebook.jpg" alt="facebook" width="32" border="0" /></a>


					</td>
					<td width="30"></td>
				</tr>
				<tr>
					<td width="650" height="20" colspan="3"></td>
				</tr>
				<!--Final de Cabecera-->

			</table>
		</td>
	</tr>
	<tr>

		<!--Color de primera línea entre cabecera y contenido-->
		<td width="100%" height="1" bgcolor="#a4d0d1"></td>
	</tr>
	<tr>

		<!--Color de segunda línea entre cabecera y contenido-->
		<td width="100%" height="1" bgcolor="#b8b8b8"></td>
	</tr>
	<tr>

		<!--Color de Fondo-->
		<td valign="top" width="100%" align="center" bgcolor="#e6e6e6" style="padding:0;">
			<table width="675" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; margin:0 auto;">
				<tr>
					<td valign="top" width="20">
						<img src="img/shdw-left.jpg" alt="shdw-left" width="20" height="344" border="0" style="display:block;" />
					</td>
					<td valign="top" width="635" bgcolor="#ffffff">
						<table width="635" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="right" width="115"></td>
								<td valign="top" width="405">

									<!--Imagen Principal-->
									<img src="http://abel-olguin.com/wp-content/uploads/2014/10/cropped-coaching11.jpg" alt="main-img-2" width="405" height="119" border="0" style="display:block;" />
								</td>
								<td valign="top" width="115" align="left"></td>
							</tr>
							<tr>
								<td width="635" height="30"colspan="3"
							</tr>
							<tr>
								<td width="115"></td>
								<td valign="top" width="405">
									<div style="font-family:Arial; font-size:14px; line-height:18px; text-align:justify; color:#787878;">

										<!--Bloque de texto-->
										<em>
										Hola '.$nombre.' Tu proceso de compra ha sido iniciado, una vez pagado recibiras un nuevo correo electronico,  confirmando tu compra.
										</em><br /><br /><br />

										<!--Pie de texto-->
										<em>Atentamente</em><br />
										<a href="http://abel-olguin.com" target="_blank" style="color:#333333; text-decoration:none;">abel-olguin.com</a>
									</div>
								</td>
								<td width="115"></td>
							</tr>
						</table>
					</td>
					<td valign="top" width="20">
						<img src="img/shdw-right.jpg" alt="shdw-right" width="20" height="344" border="0" style="display:block;" />
					</td>
				</tr>
				<tr>
					<td valign="top" width="675" colspan="3">
						<img src="img/shdw-bottom.jpg" alt="shdw-bottom" width="675" height="88" border="0" style="display:block;" />
					</td>
				</tr>
				<tr>
					<td width="675" height="20" colspan="3"
				</tr>
				<tr>
					<td valign="top" width="675" colspan="3">
						<table width="675" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"></td>
								<td valign="top" width="475" align="center">

									<!--Texto legal-->
									<div style="font-family:Arial; font-size:10px; line-height:14px; color:#c1c1c1; text-align:center;">
										Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
									</div>
								</td>
								<td width="100"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="675" height="50" colspan="3"
				</tr>
			</table>
		</td>
	</tr>
</table>';


        return mail($correo, $asunto, utf8_decode($escribirMensaje), $headers);
    }

    /**

     * mail que se envia una vez pagado el recibo de pago o si uso tarjeta se hace automaticamente
     * solo aplica a pagos finalizados
     **/

    public function send_paid_mail($nombre,$correo){

        $hoy = date("d-m-Y");
        $headers ='MIME-Version: 1.0' . "\r\n";
        $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers.= 'From: Abel <webmaster@abel-olguin.com>' . "\r\n";  /*Nombre Sitio <info@url del sitio>*/
        $asunto="Proceso terminado";


        $escribirMensaje = '<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin:0; padding:0;">
	<tr>
		<td valign="top" width="100%" align="center" bgcolor="#389ea2">
			<table width="650" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; margin:0 auto;">

				<!--Inicio de Cabecera-->
				<tr>
					<td valign="middle" width="325" height="100">

						<!--Logo-->
						<a href="#" target="_blank"><img src="http://abel-olguin.com/wp-content/uploads/2014/10/cropped-coaching11.jpg" alt="logo" width="325" height="80" border="0" style="display:block;" /></a>
					</td>
					<td valign="middle" width="295" align="right">

						<!--Redes Sociales-->

						<!--twitter-->
						<a href="https://twitter.com/iscariot696" target="_blank" title="twitter"><img src="img/twitter.jpg" alt="twitter" width="32" border="0" /></a>

						<!--facebook-->
						<a href="https://www.facebook.com/ingeniero.Olguin" target="_blank" title="facebook"><img src="img/facebook.jpg" alt="facebook" width="32" border="0" /></a>


					</td>
					<td width="30"></td>
				</tr>
				<tr>
					<td width="650" height="20" colspan="3"></td>
				</tr>
				<!--Final de Cabecera-->

			</table>
		</td>
	</tr>
	<tr>

		<!--Color de primera línea entre cabecera y contenido-->
		<td width="100%" height="1" bgcolor="#a4d0d1"></td>
	</tr>
	<tr>

		<!--Color de segunda línea entre cabecera y contenido-->
		<td width="100%" height="1" bgcolor="#b8b8b8"></td>
	</tr>
	<tr>

		<!--Color de Fondo-->
		<td valign="top" width="100%" align="center" bgcolor="#e6e6e6" style="padding:0;">
			<table width="675" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; margin:0 auto;">
				<tr>
					<td valign="top" width="20">
						<img src="img/shdw-left.jpg" alt="shdw-left" width="20" height="344" border="0" style="display:block;" />
					</td>
					<td valign="top" width="635" bgcolor="#ffffff">
						<table width="635" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="right" width="115"></td>
								<td valign="top" width="405">

									<!--Imagen Principal-->
									<img src="http://abel-olguin.com/wp-content/uploads/2014/10/logo.png" alt="main-img-2" width="405" height="119" border="0" style="display:block;" />
								</td>
								<td valign="top" width="115" align="left"></td>
							</tr>
							<tr>
								<td width="635" height="30"colspan="3"
							</tr>
							<tr>
								<td width="115"></td>
								<td valign="top" width="405">
									<div style="font-family:Arial; font-size:14px; line-height:18px; text-align:justify; color:#787878;">

										<!--Bloque de texto-->
										<em>
										Hola '.$nombre.' Tu proceso de compra ha finalizado, gracias por confiar en nosotros.
										</em><br /><br /><br />

										<!--Pie de texto-->
										<em>Atentamente</em><br />
										<a href="http://abel-olguin.com" target="_blank" style="color:#333333; text-decoration:none;">abel-olguin.com</a>
									</div>
								</td>
								<td width="115"></td>
							</tr>
						</table>
					</td>
					<td valign="top" width="20">
						<img src="img/shdw-right.jpg" alt="shdw-right" width="20" height="344" border="0" style="display:block;" />
					</td>
				</tr>
				<tr>
					<td valign="top" width="675" colspan="3">
						<img src="img/shdw-bottom.jpg" alt="shdw-bottom" width="675" height="88" border="0" style="display:block;" />
					</td>
				</tr>
				<tr>
					<td width="675" height="20" colspan="3"
				</tr>
				<tr>
					<td valign="top" width="675" colspan="3">
						<table width="675" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"></td>
								<td valign="top" width="475" align="center">

									<!--Texto legal-->
									<div style="font-family:Arial; font-size:10px; line-height:14px; color:#c1c1c1; text-align:center;">
										Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
									</div>
								</td>
								<td width="100"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="675" height="50" colspan="3"
				</tr>
			</table>
		</td>
	</tr>
</table>';


        return mail($correo, $asunto, utf8_decode($escribirMensaje), $headers);
    }
} 