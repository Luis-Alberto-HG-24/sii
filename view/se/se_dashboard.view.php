<?php 
    Redireccion::validar_vista("SE");
?>
<div class="container">
    <div class="row justify-content-around py-5">
        <div class="col-md-12 text-center">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
                
                <div class="col mb-5">
                    <a href="<?=Router::redirigir('ctrl')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-digital-tachograph icono mb-4"></i>
                                <h5 class="card-title">Creacion de Numeros de Control</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?=Router::redirigir('alumnos')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fas fa-9x fa-user-plus icono mb-4"></i>
                                <h5 class="card-title">Creacion de Alumnos</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="<?=Router::redirigir('listado_alumno')?>">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fa-9x far fa-list-alt icono mb-4"></i>
                                <h5 class="card-title">Listado de Alumnos</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="#">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h5 class="card-title">Pendiente</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="#">
                        <div class="card-pricing text-center mb-3 h-100">
                            <div class="card-body">
                                <i class="img-fluid fab fa-9x fa-algolia icono mb-4"></i>
                                <h5 class="card-title">Pendiente</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <a href="#">
                        <div class="card-pricing text-center mb-3 h-100">
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