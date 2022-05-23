<?php
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("ADMIN");
?>

<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col-md-12 text-center">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('generar_reticula_admin')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-file icono mb-4"></i>
                                <h6 class="card-title">Crear Reticula</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('usuarios')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-users icono mb-4"></i>
                                <h6 class="card-title">Usuarios</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('materias')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-book icono mb-4"></i>
                                <h6 class="card-title">Materias</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?= Router::redirigir('crear_aula_admin') ?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-door-open icono mb-4"></i>
                                <h6 class="card-title">Crear Aula</h6>
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