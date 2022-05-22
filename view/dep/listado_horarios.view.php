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
                <select name="carrera" class="form-select" >
                    <option value="0">Todas</option>
                    <option value="1">Ingeniería en Gestión Empresarial</option>
                    <option value="2">Ingeniería Industrial</option>
                    <option value="3">Ingeniería en Sistemas Computacionales</option>
                </select>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <label for="materia">Filtrar por materia</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-filter"></i></span>
                <select name="materia" class="form-select" >
                    <option value=""></option>
                </select>
            </div>
        </div> -->
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-responsive-lg table-striped  table-hover table-bordered border-primary" id="table_created_rooms">
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
                    </thead>
                    <tbody id="tabla_horarios" class="text-center">                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<a href="<?=Router::redirigir('dep_dashboard')?>" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>

<script src="<?=CONTROLLER?>dep/horario_grupo/listado_horarios.controller.js"></script>