<?php
    $title = "USUARIO";
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    // Redireccion::validar_vista("ADMIN");
?>
<div class="container tarjetaFlotante mb-5">
    <div class="row">
        <div class="col">
            <div class="tarjeta">
                <div class="imagen">
                    <img src="<?=DEP_IMG?>admin/IMG_ROL_PRUEBA.png" alt="">
                </div>
                <div class="contenido">
                    <div class="detalles">
                        <h2>
                        <?php
                            echo Sesion::datos_sesion("rol");
                        ?>
                            <br>
                            <span><?=  Sesion::datos_sesion("correo_usuario")?></span>
                        </h2>
                        <div class="datos">
                            <h3>datos <br><span>cambiar</span></h3>
                            <h3>datos <br><span>cambiar</span></h3>
                            <h3>datos <br><span>cambiar</span></h3>
                        </div>
                        <div class="paginas">
                            <!-- <a href="https://github.com/Danx398" target="_blank">Mi Git Hub</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>