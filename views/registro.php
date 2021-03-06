

<!-- Inicia Registro -->
<section class="col-md-8 col-md-offset-2">

    <!-- formulario paso 1-->
    <div class="container_gral">
        <article>
            <div class="col-md-8 col-md-offset-2 registro_txt">Registro</div>
            <div class="col-md-8 col-md-offset-2 contenedor_registro" >

                <form class="form" id="registro-form"  action="inscripcion.php?set=controllers_Content&run=registrar" method="post">
                    <div class="form-group">
                        <div class="col-md-12"><label for="mail">Correo Electrónico:</label></div>
                        <div class="col-md-12"><input type="text" class="form-control required" name="correo" id="correo"></div>
                        <div class="col-md-12"><label for="pass">Contraseña:</label></div>
                        <div class="col-md-12"><input type="text" class="form-control required" name="pass" id="pass"></div>
                        <div class="mensajeMailExistente">
                            <p>1.- Este email ya fue utilizado.</p>
                        </div>
                        <div class="mensajeMail col-md-12">A este correo se enviara un mensaje.</div>
                    </div>

                    <div class="ocultarMail">

                        <div class="form-group">
                            <div class="col-md-12"><label for="nombre">Nombre:</label></div>
                            <div class="col-md-12"><input type="text" class="form-control" name="nombre" id="nombre"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><label for="apellido_paterno">Apellido Paterno:</label></div>
                            <div class="col-md-12"><input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><label for="apellido_materno">Apellido Materno:</label></div>
                            <div class="col-md-12"><input type="text" class="form-control" name="apellido_materno" id="apellido_materno"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><label for="dia">Fecha de nacimiento:</label></div>
                            <div class="col-md-4"><select id="dia" name="dia" class="form-control">
                                    <option value="-" selected>Día</option>
                                    <?php for($i = 1; $i <= 31 ; $i++):?>
                                    <?= "<option value='$i'>$i</option>"?>
                                    <?php endfor; ?>
                                </select></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4"><select name="mes" id="mes" class="form-control">
                                    <option value="-" selected>Mes</option>
                                    <?php for($i = 1; $i <= 12 ; $i++):?>
                                        <?= "<option value='$i'>$i</option>"?>
                                    <?php endfor; ?>
                                </select></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4"><select name="anio" id="anio" class="form-control">
                                    <option value="-" selected>Año</option>
                                    <?php for($i = 1930; $i <= 1998 ; $i++):?>
                                        <?= "<option value='$i'>$i</option>"?>
                                    <?php endfor; ?>
                                </select></div>
                        </div>
                        <div class="clear"></div>


                        <div class="col-md-12"><label for="genero">Sexo</label></div>
                        <div class="col-md-12">
                            <label>M:
                                <input type="radio" name="genero" id="sexHombre" value="hombre" >
                            </label>
                            <label>F:
                                <input type="radio" name="genero" id="sexMujer" value="mujer">
                            </label>
                            <div id="valorSexo"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><label for="pais">Pais:</label></div>
                            <div class="col-md-12"><input type="text" class="form-control" value="México" name="pais" id="pais"></div>
                        </div>



                        <div id="frmAviso"></div>
                        <div id="frmSumatoria"></div>

                        <div class="btns-container">
                            <input type="submit" id="enviar" class="btn btn-default" value="Enviar" />
                        </div>

                    </div><!-- Ocultar Mail-->

                </form>

            </div>


        </article>
    </div>
</section> <!-- Termina Registro -->
