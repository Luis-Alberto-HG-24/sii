<?php
$title = "Generar matricula";
if (!Sesion::validar_sesion()) {
    Redireccion::redirigir("login");
} else {
    Redireccion::validar_vista("ADMIN");
}
?>

<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <h1 class="border-bottom text-center pb-2 text-uppercase">Generar matricula</h1>
        </div>
        <div class="row my-5">
            <form action="">
                <div class="row">
                    <div class="col-lg-4">
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
    </div>
</div>
<a href="dashboard" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>
