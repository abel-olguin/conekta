<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 14/03/2015
 * Time: 02:49 PM
 */ 

?>
<section class="col-md-4 col-md-offset-4 container_gral">
        <article class="col-md-12 login">
            <p class="glyphicon-log-in">Login</p>
            <form method="post">
                <label>Correo:</label>
                <input type="text" name="correo" placeholder="Ej. ejemplo@ejemplo.com">
                    <br>
                <label>Contraseña:</label>
                <input type="text" name="pass" >
                    <br>
                <button class="btn_login btn-info">Entrar</button>
            </form>
            <a href="inscripcion.php?set=controllers_Content&run=registro">Registrarse</a>
        </article>
</section>
