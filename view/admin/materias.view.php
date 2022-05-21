<?php
$title = "MATERIAS";
if (!Sesion::validar_sesion()) {
    Redireccion::redirigir("login");
} else {
    Redireccion::validar_vista("ADMIN");
}
?>

<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <h1 class="border-bottom text-center pb-2 text-uppercase">Materias</h1>
        </div>
        <div class="row my-5">
            <form action="">
                <div class="row">
                    <div class="col-lg-4 offset-4">
                        <label for="carrera" class="form-label">Carrera</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select break_size" id="carrera" name="carrera">
                                <option value="">Elegir carrera</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4 my-5">
            <div class="col-sm-2 mb-5">
                    <div class="card-materia text-center mb-3 w-50">
                        <div class="card-body">
                            <i class="img-fluid fas fa-9x fa-book card-icono-materia mb-4"></i>
                            <h6 class="card-title">Calculo diferencial</h6>
                            <div class="codigo">ACF-0901</div><hr class="divisor">
                            <div class="creditos">3-2-5</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<a href="dashboard" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>