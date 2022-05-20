<?php
    $title = "ADMINISTRACION DE USUARIOS";
    if (!Sesion::validar_sesion()) {
        Redireccion::redirigir("login");
    }
    Redireccion::validar_vista("ADMIN");
?>


<div class="container" id="listado_titulo">
    <div class="row justify-content-around py-5">
        <div class="col text-center">
            <h2 class="mb-4">LISTADO DE USUARIOS</h2>
            <hr>
        </div>
    </div>
</div>
<div class="container mb-5" id="listado_info">
    <div class="row justify-content-around">
        <div class="col">
            <div class="table-responsive" style="overflow: hidden;">
                <table class="table table-md table-hover table-responsive-lg mt-3" id="tabla_registro_usuario">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Correo Usuario</th>
                            <th scope="col">Nombre Usuario</th>
                            <th scope="col">Ap. Paterno</th>
                            <th scope="col">Ap. Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Borrar</th>
                        </tr>
                        <thead>
                    <tbody>
                        <tr>
                            <!-- <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="frm_actualizar_usuario"  enctype="multipart/form-data" method="POST">
                <div class="row align-items-end mb-3 prueba">
                    <div class="col-lg-12 col-md-6 text-start">
                        <label for="correo_electronico" class="form-label">Correo Electronico</label>
                            <input name="funcion" class="form-control break_size"
                                id="funcion" type="hidden" maxlength="100">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                            <input name="id_usuario" class="form-control break_size"
                                id="id_usuario" placeholder="id_usuario" maxlength="100" type="hidden">
                            <input name="fk_persona" class="form-control break_size"
                                id="fk_persona" placeholder="fk_persona" maxlength="100" type="hidden">
                            <input name="correo_electronico" type="text" class="form-control break_size"
                                id="correo_electronico" placeholder="Correo Electronico" maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="row align-items-end mb-3 prueba">
                    <div class="col-lg-6 col-md-6 text-start">
                        <label for="nombre_usuario" class="form-label">Nombre del Usuario</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                            <input name="nombre_usuario" type="text" class="form-control break_size"
                                id="nombre_usuario" placeholder="Nombre del Usuario" maxlength="100">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 text-start">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                            <input name="apellido_paterno" type="text" class="form-control break_size"
                                id="apellido_paterno" placeholder="Apellido Paterno" maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="row align-items-end mb-3 prueba">
                    <div class="col-lg-6 col-md-6 text-start">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                            <input name="apellido_materno" type="text" class="form-control break_size"
                                id="apellido_materno" placeholder="Apellido Materno" maxlength="100">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 text-start">
                        <label for="telefono" class="form-label">Telefono</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                            <input name="telefono" type="text" class="form-control break_size"
                                id="telefono" placeholder="Telefono" maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="validar_vacios_datos_generales()">Actualizar Usuario</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


    <!-- <script src="<//?=CONTROLLER?>admin/usuarios/controller_usuarios.js"></script>
    <script src="<//?=CONTROLLER?>admin/usuarios/controller_obtencion_datos_usuario.js"></script> -->