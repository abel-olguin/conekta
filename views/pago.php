<?php
/**
*Archivo en cargado del envio de datos a Conekta aqui puedes agregar metodos de pago
*Todos los campos son requeridos
*Sino estas seguro de como funciona la plataforma conekta no toques este archivo
**/

?>

<!-- Inicia Registro -->
<div class="col-md-offset-2 col-md-6 selectPago" id="pago" >
 <div class="col-md-12 tituloFormulario ">Estimado <?= ucwords ($nombre); ?>, selecciona tu forma de pago.</div>
    <div class="form-group">
        <select name="elegir-pago" id="elegir-pago" class="col-md-12 form-control">
            <option value="-" selected>Elige una opcion</option>
            <option value="tc">Tarjeta de credito</option>
            <option value="efectivo">Efectivo</option>
        </select>
    </div>
    <!-- tarjeta de credito-->

    <form action="inscripcion.php?set=controllers_Content&run=guardar_pago" method="POST" id="card-form" >
        <span class="card-errors"></span>

        <div class="form-row form-group">
            <label>
                <div class="col-md-6"><span >Nombre del tarjetahabiente</span></div>
                <div class="col-md-6"><input class="form-control" type="text"  name="nombre-tc" data-conekta="card[name]"/></div>
            </label>
        </div>

        <div class="form-row">
            <label>
                <div class="col-md-6"><span>Número de tarjeta de crédito</span></div>
                <div class="col-md-6"><input class="form-control" type="text" data-conekta="card[number]"/></div>
            </label>
        </div>

        <div class="form-row">
            <label>
                <div class="col-md-6"><span>CVC</span></div>
                <div class="col-md-6"><input class="form-control" type="text"  name="cvc" data-conekta="card[cvc]"/></div>
            </label>
        </div>

        <div class="form-row">
            <label>
                <div class="col-md-6"><span>Fecha de expiración (MM/AAAA)</span></div>
                <div class="col-md-3"><input class="form-control" type="text" name="mes" data-conekta="card[exp_month]"/></div>
                <div class="col-md-3"><input class="form-control" type="text"  name="anio" data-conekta="card[exp_year]"/></div>
            </label>
        </div>

        <button type="submit" class="btn btn-default">Enviar</button>
        <input type="hidden" name="tipo_pago" value="card">
        <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
        <input type="hidden" name="correo" value="<?= $correo; ?>">
        <input type="hidden" name="cantidad_pago" value="<?= $cantidad_pago; ?>">
        <input type="hidden" name="nivel" value="<?= $nivelJuego; ?>">
        <input type="hidden" name="id" value="<?= $id_conekta; ?>">
    </form>
    <!-- termina el form tarjeta e inicia el de pago en efectivo-->
    <div id="cash-form">
    <form action="inscripcion.php?set=controllers_Content&run=guardar_pago" method="POST" id="cash-form-banorte" >
    <img src="images/banorte.png" style="width:100px;padding:10px 5px;"><br>
        <input type="hidden" name="tipo_pago" value="bank">
            <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
            <input type="hidden" name="correo" value="<?= $correo; ?>">
            <input type="hidden" name="cantidad_pago" value="<?= $cantidad_pago; ?>">
            <input type="hidden" name="id" value="<?= $id_conekta; ?>">
        <button type="submit" class="btn btn-default">Generar</button>
    </form>

<form action="inscripcion.php?set=controllers_Content&run=guardar_pago" method="POST" id="cash-form-oxxo" >

            <img src="images/oxxo.png" style="padding:10px 5px;"><br>
            <input type="hidden" name="tipo_pago" value="cash">
            <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
            <input type="hidden" name="correo" value="<?= $correo; ?>">
            <input type="hidden" name="cantidad_pago" value="<?= $cantidad_pago; ?>">
            <input type="hidden" name="id" value="<?= $id_conekta; ?>">
        <button type="submit" class="btn btn-default">Generar</button>
    </form>
    </div>




</div> <!-- Termina Registro -->

