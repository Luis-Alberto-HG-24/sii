<?php
    if($_GET['view'] == "crear_horario_grupo"){
        $title = "CREACIÓN DE HORARIOS Y GRUPOS";
        if (!Sesion::validar_sesion()) {
            Redireccion::redirigir("login");
        }
        Redireccion::validar_vista("DEP");
    }
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="border-bottom text-center pb-2 text-uppercase">Creación de horarios y grupos</h1>
        </div>
    </div>
    <form id="frm_horario_grupo">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6 mb-4">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h2 class="border-bottom pb-2 fs-5 text-muted">Datos generales</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="carrera" class="form-label">Carrera</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select break_size" name="carrera">
                                    <option value="">Elegir carrera</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="text" id="tk_frm" name="tk_frm" value="<?=Token::generar_token_frm("frm_horario_grupo")?>" hidden>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="periodo" class="form-label">Periodo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input name="periodo" type="text" class="form-control break_size" id="periodo" placeholder="Periodo" maxlength="100" readonly>
                                <input type="text" name="periodo_id" id="periodo_id" value="1" hidden>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="semestre" class="form-label">Semestre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                <select name="semestre" id="semestre" class="form-select break_size">
                                    <option value="">Elegir semestre</option>
                                    <?php for($j = 1; $j < 13; $j++):?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 " id="datos_materia_grupo">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h2 class="border-bottom pb-2 fs-5 text-muted">Datos sobre materia y grupo</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-sm-6">
                            <label for="materia" class="form-label">Materia</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                <select name="materia" id="materia" class="form-select break_size">
                                    <option value="none">Eligir materia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label for="clave" class="form-label">Clave</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input name="clave" type="text" class="form-control break_size" id="clave" placeholder="Clave" maxlength="100" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-5">
                            <label for="horas" class="form-label">Horas por semana</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-clock me-2"></i></span>
                                <input name="horas" type="text" class="form-control break_size" id="horas" placeholder="Horas" maxlength="100" readonly>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-7">
                            <label for="nombre_grupo" class="form-label">Nombre del grupo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                <input name="nombre_grupo" type="text" class="form-control break_size" id="nombre_grupo" placeholder="Nombre del grupo" maxlength="100">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="capacidad" class="form-label">Capacidad</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                <input name="capacidad" type="text" class="form-control break_size" id="capacidad" placeholder="Capacidad" maxlength="3">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12  text-center">
                            <label for="materia_exclusiva" class="form-label w-100">Materia exclusiva</label>
                            <h5 class="form-check-label ms-2" for="materia_exclusiva"  id="cambio_texto"><i class="fas fa-universal-access"></i></h5>
                        </div>
                    </div>
                    <div class="row mt-4 mb-5 d-none" id="botones_materia_grupo">
                        <div class="col-lg-12 text-end">
                            <div class="btn-group">
                                <span class="btn btn-primary" id="ir_asignar_horario"><i class="fas fa-arrow-right me-2"></i>Siguiente</span>
                                <a href="<?=Router::redirigir('dep_dashboard')?>" class="btn btn-danger"><i class="fas fa-ban me-2"></i>Cancelar</a>
                            </div>
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
                                    <h2><span class="alert alert-success rounded-3 border-success p-2 g-0 fs-5" role="alert" id="contador_horas">Horas por asignar: </span></h2>
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
                                                                <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                                                <select class="form-select" name="hora_inicio<?=$i?>" id="hora_inicio<?=$i?>" disabled >
                                                                    <option value="">--:--</option>
                                                                    <?php for($j = 7; $j < 21; $j++):?>
                                                                    <option value="<?=$j?>"><?=$j > 9 ? $j : '0' . $j?>:00</option>
                                                                    <?php endfor ?>
                                                                </select>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                                                <select class="form-select" name="hora_fin<?=$i?>" id="hora_fin<?=$i?>" disabled ></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                                                <select class="form-control form-control-sm" name="aula<?=$i?>" id="aula<?=$i?>" disabled >
                                                                    <option value="">Aula</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                    <div class="row my-2">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text d-none d-md-block" id="basic-addon1"><i class="fas fa-hourglass-half"></i></span>
                                                                <input class="form-control" type="text" name="horas_dia<?=$i?>" id="horas_dia<?=$i?>" placeholder="hrs" readonly>
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
                                <button class="btn btn-primary" type="submit"><i class="fas fa-plus me-2"></i>Registrar horario</button>
                                <a href="<?=Router::redirigir('dep_dashboard')?>" class="btn btn-danger"><i class="fas fa-ban me-2"></i>Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php if($_GET['view'] == "crear_horario_grupo"):?>
<script src="<?=CONTROLLER?>dep<?=$control = $_GET['view']=="crear_horario_grupo" ? "/horario_grupo/": "/";?>horario_grupo.controller.js"></script>
<?php endif?>