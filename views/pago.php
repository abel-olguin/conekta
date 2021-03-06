<?php
/**
*Archivo en cargado del envio de datos a Conekta aqui puedes agregar metodos de pago
*Todos los campos son requeridos
*Sino estas seguro de como funciona la plataforma conekta no toques este archivo
**/

?>

<!-- Inicia Registro -->
<div class="col-md-offset-1 col-md-10 selectPago" id="pago" >

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

        <?php if($mensualidades): ?>
        <div class="form-row">
            <label>
                <div class="col-md-6"><span>Este producto cuenta con meses sin intereses</span></div>
                <div class="col-md-3">
                    <select name="meses" id="meses">
                        <option value="">--Elige una opcion--</option>
                        <?php foreach($meses as $mes): ?>
                        <option value="<?= $mes?>"> <?= $mes ?> meses sin intereses</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </label>
        </div>
        <?php endif; ?>

        <?php if($cupones): ?>
            <div class="form-row">
                <label>
                    <div class="col-md-6"><span>Puedes usar un cupon promocional</span></div>
                    <div class="col-md-3">
                        <input type="text" name="cupon" class="cupon" id="cupon_tc">
                    </div>
                </label>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-default">Enviar</button>
        <input type="hidden" name="tipo_pago" value="card">
        <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
        <input type="hidden" name="correo" value="<?= $correo; ?>">
        <input type="hidden" name="producto" value="<?= $id_producto; ?>">

    </form>
    <!-- termina el form tarjeta e inicia el de pago en efectivo-->
    <div id="cash-form">
    <form action="inscripcion.php?set=controllers_Content&run=guardar_pago" method="POST" id="cash-form-banorte" >
    <img src="images/banorte.png" style="width:100px;padding:10px 5px;"><br>
        <input type="hidden" name="tipo_pago" value="bank">
            <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
            <input type="hidden" name="correo" value="<?= $correo; ?>">
            <input type="hidden" name="producto" value="<?= $id_producto; ?>">
            <?php if($cupones): ?>
                <div class="form-row">
                    <label>
                        <div class="col-md-6"><span>Puedes usar un cupon promocional</span></div>
                        <div class="col-md-3">
                            <input type="text" name="cupon" class="cupon">
                        </div>
                    </label>
                </div>
            <?php endif; ?>
        <button type="submit" class="btn btn-default">Generar</button>
    </form>

<form action="inscripcion.php?set=controllers_Content&run=guardar_pago" method="POST" id="cash-form-oxxo" >

            <img src="images/oxxo.png" style="padding:10px 5px;"><br>
            <input type="hidden" name="tipo_pago" value="cash">
            <input type="hidden" name="nombre" value="<?= $nombre." ".$apellido_paterno." ".$apellido_materno; ?>">
            <input type="hidden" name="correo" value="<?= $correo; ?>">
            <input type="hidden" name="producto" value="<?= $id_producto; ?>">

        <?php if($cupones): ?>
            <div class="form-row">
                <label>
                    <div class="col-md-6"><span>Puedes usar un cupon promocional</span></div>
                    <div class="col-md-3">
                        <input type="text" name="cupon" class="cupon">
                    </div>
                </label>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-default">Generar</button>
    </form>
    </div>




</div> <!-- Termina Registro -->
