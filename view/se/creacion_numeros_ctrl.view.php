<?php
    $title = "NUMEROS DE CONTROL";
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("SE");
?>
<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col-md-12 text-center">
            <div class="container">
                <div class="row">
                    <h2 class="mb-4">NUMEROS DE CONTROL</h2>
                    <hr>
                    <div class="col-md-7">
                        <h3 class="d-block d-sm-none d-sm-block d-md-none">Agosto-Diciembre 2021</h3>
                        <h3 class="d-none d-sm-block d-md-none">Agosto-Diciembre 2021</h3>
                        <form id="frm_num_ctrl" method="POST" class="form-grup mb-3 ml-3 mr-3">
                            <input type="text" id="tk_frm" name="tk_frm" value="<?=Token::generar_token_frm("frm_num_ctrl")?>" hidden> 
                            <input type="text" id="estado_solicitud" name="estado_solicitud" value="" hidden>
                            <input type="text" id="id_solicitud" name="id_solicitud" value="" hidden>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                                <input onchange="inputRange()" type="text" class="form-control" id="num_matriculas" name="num_matriculas" aria-describedby="textHelp">
                            </div>
                            <label for="rango_matriculas" class="form-label">Rango de matriculas</label>
                            <input type="range" onclick="range()" onmousemove="range()" class="form-range" min="0" max="200" step="1" id="rango_matriculas" list="tickmarks">
                            <datalist id="tickmarks">
                                <option value="0" label="0">
                                <option value="50" label="50">
                                <option value="100" label="100">
                                <option value="150" label="150">
                                <option value="200" label="200">
                            </datalist>
                            <div class="mt-2">
                                <button id="enviar_solicitud" type="button" class="btn btn-primary"><i class="fas fa-share"></i> Enviar solicitud</button>
                                <!-- <button disabled id="cancelar_solicitud" type="button" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancelar</button> -->
                            </div>
                        </form>

                    </div>
                    <div class="col-md-5">
                        <h3 class="d-sm-none d-md-block d-none d-sm-block">Agosto-Diciembre 2021</h3>
                        <div class="d-grid gap-3 mt-3">
                            <!-- <button disabled id="status-solicitud" type="button" class="btn btn-secondary"><i class="fas fa-envelope-open-text"></i> Sin enviar</button> -->
                            <div id="status_solicitud">
                                
                            </div>
                            <?php include_once "view/se/includes/modal_numeros_control.php" ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12">
                            <table id="tabla_datos" class="table table-hover table-sm table-responsive-lg mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Se solicita
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Fecha Solicitud
                                        </th>
                                        <th>
                                            Fecha Atencion
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="dashboard" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>

<script src="<?= CONTROLLER ?>se/tabla_solicitud.controller.js"></script>
<script src="<?= CONTROLLER ?>se/numeros_ctrl.controller.js"></script>


<!-- 
    1.- Form -> id="frmNumCtrl"
    2.- Input -> id="funcion" name="funcion"
    3.- Input -> id="estado-solicitud" name="estado-solicitud"
    4.- Input -> id="id-solicitud" name="id-solicitud"
    5.- Datalist -> id="tickmarks"
    6.- Button -> id="enviar_solicitud"
    7.- Button -> id="cancelar-solicitud"
    8.- Button -> id="status-solicitud"
    9.- Table -> id="tablaDatos"
    10.- Input -> id="tk_form" name="tk_form"
 -->
