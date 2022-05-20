<?php 
    $title = $_GET['view']=="listado_alumno" ? "LISTADO DE ALUMNOS" : "CREACION DE ALUMNOS";
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("SE");
?>
<div class="container">
    <div class="row justify-content-around">
        <div class="col">
            <div class="progress mt-4">
                <div id="progreso-form" class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                    role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col text-center">
            <form id="frm_creacion_alumno"  enctype="multipart/form-data" method="POST">
                <div id="identificacion"></div>
                <input type="text" id="tk_frm" name="tk_frm" value="<?=Token::generar_token_frm("frm_creacion_alumno")?>" hidden>
                <input type="text" id="funcion" name="funcion" value="crear_alumno" hidden> 
                <input type="text" id="medidas_recorte" name="medidas_recorte" value="" hidden> 
                <h2 class="mb-4"><?=$letrero = $_GET['view']=="listado_alumno" ? "EDITAR INFORMACION ALUMNO" : "CREACION DE ALUMNOS";?></h2>
                <hr>

                <div class="d-md-flex mb-3">
                    <h3 id="form-part" class="me-auto"></h3>
                    <div class="col-lg-3 col-md-6 text-start align-self-end me-3 mb-3">
                        <div id="input_file" class="file text-center float-end">
                            <label class="titulo" for="file">
                                Cargar Foto <br>
                                <i class="fas fa-camera fa-3x"></i>
                            </label>
                            <input class="btn_foto" type="file" accept="image/jpg,image/jpeg" name="img_alumno" id="img_alumno" title="Foto">
                        </div>
                        <div class="float-end" id="img_foto"></div>
                        <button type="button" class="btn borded-0 mb-2 float-end" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title ="Despues de cargar una fotografia da click en la imagen para recortar">
                            <i class="fas fa-question-circle"></i>
                        </button> 
                    </div>
                    <div class="col-lg-3 col-md-6 text-start">
                        <label for="numero_control" class="form-label">Numero de Control</label>
                        <input type="text" id="numero_control" name="numero_control" value="" hidden> 
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                            <input style="border-right: none;" name="no_control" readonly style="height: 75px;" type="text" class="form-control fs-2 break_size" id="no_control"/>
                            <span class="input-group-text" style="background-color: #E7ECEC; border-left: none;">
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" id="btn_incrementar" class="btn btn-link text-primary border-0"><i class="fas fa-caret-up"></i></button>
                                    <button type="button" id="btn_decrementar" class="btn btn-link text-primary border-0"><i class="fas fa-caret-down"></i></button>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <?php include_once 'includes/form_part_uno.php'?>
                    <?php include_once 'includes/form_part_dos.php'?>
                    <?php include_once 'includes/form_part_tres.php'?>
                    <div class="d-flex flex-row gap-2 justify-content-end w-100">
                        <?php if($_GET['view']=="listado_alumno"):?>
                        <button type="button" id="cancelar_edicion" class="btn btn-danger mt-4">Cancelar</button>
                        <?php endif?>
                        <button type="button" id="atras" class="btn btn-secondary mt-4">Atras</button>
                        <button type="button" id="siguiente" class="btn btn-primary mt-4">Siguiente</button>
                        <button type="button" id="crear_alumno" class="btn btn-primary mt-4">Crear Alumno</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/modal_recorte_foto.php';?>
<link rel="stylesheet" href="<?=LIB_JC?>jcrop.css">
<script src="<?=LIB_JC?>jcrop.js"></script>
<script src="<?=CONTROLLER?>se<?=$control = $_GET['view']=="listado_alumno" ? "/editar_alumno/": "/creacion_alumno/";?>creacion_alumnos.controller.js"></script>
<script src="<?=CONTROLLER?>se<?=$control = $_GET['view']=="listado_alumno" ? "/editar_alumno/": "/creacion_alumno/";?>datos_catalogo.controller.js"></script>
<script src="<?=CONTROLLER?>se<?=$control = $_GET['view']=="listado_alumno" ? "/editar_alumno/": "/creacion_alumno/";?>fotografia.controller.js"></script>
<!--
    1.- Select -> name = "numero_control" id="numero_control"
    2.- Button -> id="atras"    
    3.- Button -> id="siguiente"
    4.- Input -> id="tk_form" name="tk_form"
 -->
