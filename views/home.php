<?php
$data = new Core();
?>
<body>

<!-- Inicia Registro -->
<div class="container registro" id="registro">

    <!-- formulario paso 1-->
    <div class="container formularioRegistro">
        <article>
            <div class="col-md-12 tituloFormulario ">Ejemplo de titulo.</div>
            <div class="col-md-8">

                <form class="form" id="registro-form"  action="inscripcion.php?set=controllers_Content&run=registrar" method="post">
                    <div class="form-group">
                        <div class="col-md-3"><label for="mail">Correo Electrónico:</label></div>
                        <div class="col-md-9"><input type="text" class="form-control required" name="correo" id="correo"></div>
                        <div class="mensajeMailExistente">
                            <p>1.- Este email ya fue utilizado.</p>
                        </div>
                        <div class="mensajeMail">A este correo se enviara un mensaje.</div>
                    </div>

                    <div class="ocultarMail">

                        <div class="form-group">
                            <div class="col-md-3"><label for="nombre">Nombre:</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nombre" id="nombre"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><label for="aPaterno">Apellido Paterno:</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="aPaterno" id="aPaterno"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><label for="aMaterno">Apellido Materno:</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="aMaterno" id="aMaterno"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><label for="dia">Fecha de nacimiento:</label></div>
                            <div class="col-md-3"><select id="dia" name="dia" class="form-control">
                                    <option value="-" selected>Día</option>
                                    <?php $data -> getOptionDay(); ?>
                                </select></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><select name="mes" id="mes" class="form-control">
                                    <option value="-" selected>Mes</option>
                                    <?php $data -> getOptionMonth(); ?>
                                </select></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><select name="anio" id="anio" class="form-control">
                                    <option value="-" selected>Año</option>
                                    <?php $data -> getOptionYear(); ?>
                                </select></div>
                        </div>
                        <div class="clear"></div>


                        <div class="col-md-3"><label for="genero">Sexo</label></div>
                        <div class="col-md-9">
                            <label>M:
                                <input type="radio" name="genero" id="sexHombre" value="hombre" >
                            </label>
                            <label>F:
                                <input type="radio" name="genero" id="sexMujer" value="mujer">
                            </label>
                            <div id="valorSexo"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3"><label for="pais">Pais:</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" value="México" name="pais" id="pais"></div>
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
</div> <!-- Termina Registro -->

</body>