<?php
    $title = "LISTADO DE HORARIOS Y GRUPOS";
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("DEP");
?>

<div class="container mb-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="border-bottom text-center pb-2 text-uppercase">Listado de horarios y grupos</h1>
        </div>
    </div>
    <div class="row justify-content-around mt-5">
        <div class="col-md-4">
            <label for="carrera">Filtrar por carrera</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-filter"></i></span>
                <select name="carrera" class="form-select">
                    <option value="0">Todas</option>
                    <option value="1">Ingeniería en Gestión Empresarial</option>
                    <option value="2">Ingeniería Industrial</option>
                    <option value="3">Ingeniería en Sistemas Computacionales</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <!--table-bordered border-primary-->
                <table class="table table-sm table-responsive-lg table-striped table-hover" id="table_created_rooms">
                    <thead class="text-center fw-bolder">
                        <th>Asignatura</th>
                        <th>Hrs</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <th>Grupo</th>
                        <th>Ver</th>
                    </thead>
                    <tbody id="tabla_horarios" class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-5">
        <div class="col-lg-12 text-end">
            <div class="btn-group">
                <!-- <button class="btn btn-primary" type="submit"><i class="fas fa-plus me-2"></i>Registrar horario</button> -->
                <a href="<?=Router::redirigir('dep_dashboard')?>" class="btn btn-danger"><i
                        class="fa-solid fa-arrow-right-from-bracket"></i> Regresar</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Hora inicio</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            <input type="text" class="form-control" name="hora_inicio_actual" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Hora fin</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            <input type="text" class="form-control"  name="hora_fin_actual" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Aula</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" name="aula_actual" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Hora inicio</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i
                                    class="fas fa-clock"></i></span>
                            <select class="form-select" name="hora_inicio<?=$i?>" id="hora_inicio<?=$i?>">
                                <option value="">--:--</option>
                                <?php for($j = 7; $j < 21; $j++):?>
                                <option value="<?=$j?>"><?=$j > 9 ? $j : '0' . $j?>:00</option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Hora fin</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i
                                    class="fas fa-clock"></i></span>
                            <select class="form-select" name="hora_fin<?=$i?>" id="hora_fin<?=$i?>"></select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="">Aula</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i
                                    class="fas fa-map-marker-alt"></i></span>
                            <select class="form-control form-control-sm" name="aula<?=$i?>" id="aula<?=$i?>">
                                <option value="">Aula</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Hrs asignadas</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text d-none d-md-block" id="basic-addon1"><i
                                    class="fas fa-hourglass-half"></i></span>
                            <input class="form-control" type="text" name="horas_dia<?=$i?>" id="horas_dia<?=$i?>"
                                placeholder="hrs" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=CONTROLLER?>dep/horario_grupo/listado_horarios.controller.js"></script>