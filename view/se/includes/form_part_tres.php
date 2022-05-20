<div id="form_part_tres">
    <div class="row align-items-end mb-3">
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="carrera_reticula" class="form-label">Carrera y Reticula</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-book-reader"></i></span>
                <select name="carrera_reticula" class="form-control break_size"
                    id="carrera_reticula"></select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="especialidad" class="form-label">Especialidad</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-archive"></i></span>
                <select name="especialidad" class="form-control break_size"
                    id="especialidad"></select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="periodo_ingreso" class="form-label">Periodo Ingreso IT</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input name="periodo_ingreso" type="text" class="form-control break_size"
                    id="periodo_ingreso" readonly value="Ago-Dic 2021" placeholder="Ciclo Escolar">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="periodos_revalidados" class="form-label">Periodos Revalidados</label>
            <div class="row">
                <div class="col-9">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-file-download"></i></span>
                        <input name="periodos_revalidados" type="number" placeholder="0"
                            class="form-control break_size" id="periodos_revalidados"
                            placeholder="No seleccionado" disabled>
                    </div>
                </div>
                <div class="col-3 align-self-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="cb_revalidado" name="cb_revalidado">
                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="tipo_ingresos" class="form-label">Tipo de Ingreso</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-stream"></i></span>
                <select name="tipo_ingresos" class="form-control break_size"
                    id="tipo_ingresos"></select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="plan_estudios" class="form-label">Plan de Estudios</label>
            <input type="text" name="plan_est" id="plan_est" value="" hidden>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                <input name="plan_estudios" readonly type="text" class="form-control break_size"
                    name="plan_estudios" id="plan_estudios" value="" placeholder="No seleccionado">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="nivel_escolar" class="form-label">Nivel Escolar Alumno</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                <select name="nivel_escolar" class="form-control break_size"
                    id="nivel_escolar"></select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="estatus_alumno" class="form-label">Estatus del Alumno</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                <select name="estatus_alumno" class="form-control break_size"
                    id="estatus_alumno"></select>
            </div>
        </div>
    </div>
</div>

<!-- 
    1.- Input -> name="" id="carrera_reticula"
    2.- Input -> name="" id="especialidad"
    3.- Input -> name="" id="periodo_ingreso"
    4.- Input -> name="" id="periodos_revalidados"
    5.- Input -> name="" id="tipo_ingresos"
    6.- Input -> name="" id="plan_estudios"
    7.- Input -> name="" id="nivel_escolar"
    8.- Input -> name="" id="estatus_alumno"
 -->