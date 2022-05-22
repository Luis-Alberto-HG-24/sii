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
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <label for="carrera" class="form-label">Carrera</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select break_size" id="carrera" name="carrera">
                                <option value="">Elegir carrera</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>

                </div>
            </form>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4 my-5">
            <div class="col mb-5">
                <div class="card-materia text-center mb-3 w-50 position-relative">
                    <div class="card-body">
                        <i class="img-fluid fas fa-9x fa-book card-icono-materia mb-4"></i>
                        <h6 class="card-title">Calculo diferencial</h6>
                        <div>ACF-0901</div>
                        <div class="fs-6">3-2-5</div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <button class="btn rounded-circle boton-ver-card">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn rounded-circle boton-editar-card">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn rounded-circle boton-eliminar-card">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span type="button" data-bs-toggle="modal" data-bs-target="#modalHistorial" class="position-absolute top-0 start-100 translate-middle p-2 border rounded-circle historial-card">
                        <i class="fa-solid fa-clock-rotate-left historial-icon"></i>
                        <span class="visually-hidden">Historial</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="dashboard" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>
<!-- Modal -->
<div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="modalHistorial" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistorial">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>