<?php
$title = "CREACION DE PARALELO";
if (!Sesion::validar_sesion()) {
    Redireccion::redirigir("login");
}
Redireccion::validar_vista("DEP");
?>

<div class="container px-5">
    <div class="row my-5">
        <div class="col-md-12">
            <h1 class="border-bottom text-center pb-2 text-uppercase lead">Creación de grupo paralelo</h1>
        </div>
    </div>
    <form id="frm_agregar_paralelo" enctype="multipart/form-data" method="POST">
        <div class="row">
            <!-- GRUPO DE ORIGEN -->
            <div class="col-lg-4 col-md-6 text-start card-form me-5 offset-2">
                <h1 class="text-center lead mb-5">Grupo Origen</h1>
                <div class="mb-4">
                    <label for="carrera" class="form-label">Carrera</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <select class="form-select break_size" id="carrera" name="carrera">
                            <option value="">Elegir carrera</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="semestre" class="form-label">semestre</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                        <select class="form-select break_size" name="semestre">
                            <option value="">Elegir semestre</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="materia" class="form-label">Materia</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                        <select class="form-select break_size" name="materia">
                            <option value="">Eligir Materia</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="grupo" class="form-label">Grupo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user-group"></i></span>
                        <select class="form-select break_size" name="materia">
                            <option value="">Eligir Grupo</option>
                        </select>
                    </div>
                </div>
            </div>  
            <!-- GRUPO DE PARALELO -->
            <div class="col-lg-4 col-md-6 text-start card-form">
                <h1 class="text-center lead mb-5">Grupo Paralelo</h1>
                <div class="mb-5">
                    <label for="carrera" class="form-label">Carrera</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <select class="form-select break_size" id="carrera" name="carrera">
                            <option value="">Elegir carrera</option>
                        </select>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="semestre" class="form-label">semestre</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                        <select class="form-select break_size" name="semestre">
                            <option value="">Elegir semestre</option>
                        </select>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="grupo" class="form-label">Grupo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user-group"></i></span>
                        <select class="form-select break_size" name="materia">
                            <option value="">Eligir Grupo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12 text-end">
                <span class="btn btn-primary" id="button_create"><i class="fas fa-plus me-2"></i>Crear</span>
            </div>
        </div>
    </form>
    <div class="row mb-5" id="container_table">
        <div class="col-lg-12">
            <h2 class="border-bottom mb-4 text-uppercase fs-5 pb-2">Grupos paralelos Creados</h2>
            <div class="table-responsive" style="overflow: hidden;">
                <table class="table table-hover table-sm table-responsive-lg" id="table_created_rooms">
                    <thead class="text-center fw-bolder">
                        <th>Grupo origen</th>
                        <th>Semestre</th>
                        <th>Grupo paralelo</th>
                        <th>Semestre</th>
                        <th>Materia</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<a href="<?=Router::redirigir('dep_dashboard')?>" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>
<!-- 
<script src="<//?=CONTROLLER?>dep</?=$control = $_GET['view']=="aula_dep" ? "/aula_dep/": "/";?>controller_aula.js"></script>
<script src="<//?=CONTROLLER?>dep<//?=$control = $_GET['view']=="aula_dep" ? "/aula_dep/": "/";?>controller_lista_aulas.js"></script> -->