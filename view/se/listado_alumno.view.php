<div class="container" id="listado_titulo">
    <div class="row justify-content-around py-5">
        <div class="col text-center">
            <h2 class="mb-4">LISTADO DE ALUMNOS</h2>
            <hr>
        </div>
    </div>
</div>
<div class="container mb-5" id="listado_info">
    <div class="row justify-content-around">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-md table-hover table-responsive-lg mt-3" id="table_registro_alumno">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Ap. Paterno</th>
                            <th scope="col">Ap. Materno</th>
                            <th scope="col">Carrera</th>
                            <th scope="col">Semestre</th>                            
                            <th scope="col">Editar</th>
                            <!-- <th scope="col">Borrar</th> -->
                        </tr>
                    <thead>                    
                </table>
            </div>
        </div>
    </div>
</div>
<a href="dashboard" class="btn btn-flotante"><i class="fa-solid fa-arrow-rotate-left"></i></a>

<div id="editar_info" hidden>
   <?php
        require_once './view/se/creacion_alumnos.php'
    ?> 
</div>



<?php 
    //require_once 'includes/modal_editar_alumno.php'
?>

<script src="<?=CONTROLLER?>se/controller_listado_alumno.js"></script>

<!--
    1.- Table -> id="table_registro_alumno"
    2.- Button -> id="btn_ver"
    2.- Button -> id="btn_borrar"
-->
