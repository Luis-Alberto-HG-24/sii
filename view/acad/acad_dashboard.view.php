<?php
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("ACAD");
?>
<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col-md-12 text-center">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">

                <div class="col">
                    <a href="<?= Router::redirigir('aprobar_ctrl') ?>">
                        <div class="card-pricing text-center shadow mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-check-double icono mb-4"></i>
                                <h5 class="card-title">Aprobar Numeros de Control</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#">
                        <div class="card-pricing text-center shadow mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h5 class="card-title">Pendiente</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#">
                        <div class="card-pricing text-center shadow mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h5 class="card-title">Pendiente</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
