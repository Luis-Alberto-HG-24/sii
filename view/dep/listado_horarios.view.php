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
</div>
<a href="<?=Router::redirigir('dashboard')?>" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="input-group mb-2">
                                    <span class="input-group-text d-none d-md-block"
                                        id="basic-addon1"><i
                                            class="fas fa-clock"></i></span>
                                    <input class="form-control" type="text" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5" id="asignar_horario">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="row g-0">
                                        <div class="col-sm-6 col-md-8 text-start border-bottom pb-2 fw-bolder my-2">
                                            <h2 class="fs-5">Asignación de horas por semana</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-4 text-center border-bottom pb-2 fw-bolder my-2">
                                            <h2><span class="alert alert-success rounded-3 border-success p-2 g-0 fs-5"
                                                    role="alert" id="contador_horas">Horas por asignar: </span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="tabla_horas" class="table-responsive">
                                        <table class="table table-sm table-responsive-lg" id="table_created_rooms">
                                            <thead class="text-center fw-bolder">
                                                <th>Hora</th>
                                                <th>Lunes</th>
                                                <th>Martes</th>
                                                <th>Miércoles</th>
                                                <th>Jueves</th>
                                                <th>Viernes</th>
                                                <th>Sábado</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="container text-center">
                                                            <div class="row my-2">
                                                                <div class="col-lg-12">
                                                                    <div class="py-2 mb-1">
                                                                        <span><b>Inicial:</b></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12">
                                                                    <div class="py-2 mb-1">
                                                                        <span><b>Final:</b></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12">
                                                                    <div class="py-2 mb-1">
                                                                        <span><b>Aula:</b></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12">
                                                                    <div class="py-2 mb-1">
                                                                        <span><b>HRS:</b></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php for($i = 1; $i < 7; $i++):?>
                                                    <td>
                                                        <div class="container">
                                                            <div class="row my-2">
                                                                <div class="col-lg-12 text-center">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text d-none d-md-block"
                                                                            id="basic-addon1"><i
                                                                                class="fas fa-clock"></i></span>
                                                                        <select class="form-select"
                                                                            name="hora_inicio<?=$i?>"
                                                                            id="hora_inicio<?=$i?>" disabled>
                                                                            <option value="">--:--</option>
                                                                            <?php for($j = 7; $j < 21; $j++):?>
                                                                            <option value="<?=$j?>">
                                                                                <?=$j > 9 ? $j : '0' . $j?>:00</option>
                                                                            <?php endfor ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12 text-center">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text d-none d-md-block"
                                                                            id="basic-addon1"><i
                                                                                class="fas fa-clock"></i></span>
                                                                        <select class="form-select"
                                                                            name="hora_fin<?=$i?>" id="hora_fin<?=$i?>"
                                                                            disabled></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12 text-center">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text d-none d-md-block"
                                                                            id="basic-addon1"><i
                                                                                class="fas fa-map-marker-alt"></i></span>
                                                                        <select class="form-control form-control-sm"
                                                                            name="aula<?=$i?>" id="aula<?=$i?>"
                                                                            disabled>
                                                                            <option value="">Aula</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row my-2">
                                                                <div class="col-lg-12 text-center">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text d-none d-md-block"
                                                                            id="basic-addon1"><i
                                                                                class="fas fa-hourglass-half"></i></span>
                                                                        <input class="form-control" type="text"
                                                                            name="horas_dia<?=$i?>"
                                                                            id="horas_dia<?=$i?>" placeholder="hrs"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php endfor ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 mb-5" id="_group_button_group">
                                <div class="col-lg-12 text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="fas fa-plus me-2"></i>Actulizar horario</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                class="fas fa-ban me-2"></i>Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- 
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Aplicar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div> -->
        </div>
    </div>
</div>
<script src="<?=CONTROLLER?>dep/horario_grupo/listado_horarios.controller.js"></script>