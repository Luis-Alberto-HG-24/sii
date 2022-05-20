<?php
    Redireccion::validar_vista("DEP");
?>
<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col-md-12 text-center">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('aula_dep') ?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-door-open icono mb-4"></i>
                                <h6 class="card-title">Crear Aula</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('crear_horario_grupo') ?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-users icono mb-4"></i>
                                <h6 class="card-title">Crear grupo y horarios</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('listado_horarios') ?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-user-clock icono mb-4"></i>
                                <h6 class="card-title">Listado de horarios y grupos</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('crear_grupo_paralelo') ?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fa-9x fas fa-book-open-reader icono mb-4"></i>
                                <h6 class="card-title">Crear grupo paralelo </h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="#">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h6 class="card-title">Pendiente</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="#">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h6 class="card-title">Pendiente</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>