<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 07/03/2015
 * Time: 06:29 PM
 */

?>

<section class="col-md-10 col-md-offset-1 container-fluid container_gral">

    <?php

        foreach($productos as $producto):

    ?>

    <article class="col-md-3 ">
        <div class="producto col-md-12">
            <div class="imagen_producto col-md-12">
                <img src="images/uploads/<?= $producto['imagen']; ?>" class="img-responsive">
            </div>
            <div class="detalle_producto col-md-12">
                <p><strong>Nombre: <?= $producto['nombre']; ?></strong></p>
                <p><strong>Pecio: $<?= $producto['precio']; ?></strong></p>
            </div>

            <form id="frm_producto" action="inscripcion.php?set=controllers_Content&run=iniciar_pago" method="post">
                <input type="hidden" name="id_producto" id="id_producto" value="<?= $producto['id']; ?>">
                <button class="btn-danger btn_compra">Comprar</button>
            </form>
        </div>
    </article>
    <?php
        endforeach;
    ?>


</section>