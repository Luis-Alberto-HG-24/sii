<div id="form_part_dos">
    <div class="row align-items-end mb-3">
        <div class="col-lg-2 col-md-6 text-start">
            <label for="codigo_postal" class="form-label">Codigo Postal</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                <input name="codigo_postal" type="text" maxLength="5" class="form-control break_size" id="codigo_postal" value="" placeholder="CP. 00000">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start mt-md-2">
            <label for="estado" class="form-label">Estado</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                <input name="estado" type="text" class="form-control break_size" value="" id="estado" readonly placeholder="Estado">
            </div>
        </div>
        <div class="col-lg-3 col-md-5 text-start mt-md-2">
            <label for="alcaldia" class="form-label">Alcaldia</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-archway"></i></span>
                <input name="alcaldia" type="text" class="form-control break_size" id="alcaldia" readonly placeholder="Alcaldia">
            </div>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-9 text-start mt-md-2 ">
            <label for="colonia" class="form-label">Colonia</label>
            <div class="input-group">   
                <span class="input-group-text"><i class="fas fa-map"></i></span>
                <select name="colonia" class="form-control break_size" id="colonia"></select>
            </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-3 align-self-center mt-1">
            <div id="check_ditar"></div>
            <div class="form-check form-switch mt-5 ms-3 ms-md-0 ms-sm-3">
                <input class="form-check-input" type="checkbox" id="escritura_manual" name="escritura_manual">
                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                <button type="button" class="btn borded-0 mb-2" data-bs-toggle="tooltip" data-bs-placement="top" 
                    title ="Escritura manual de Colonia, Alcaldia y Estado.">
                    <i class="fas fa-question-circle"></i>
                </button> 
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4 col-md-6 text-start mt-md-2">
            <label for="calle" class="form-label">Calle</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-directions"></i></span>
                <input name="calle" type="text" class="form-control break_size" id="calle" placeholder="Calle">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 text-start mt-md-2">
            <label for="no_exterior" class="form-label">No. Exterior</label>
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
            <input name="no_exterior" type="text" class="form-control break_size" id="no_exterior" placeholder="Mz. 0000">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 text-start mt-md-2">
            <label for="no_interior" class="form-label">No. Interior</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                <input name="no_interior" type="text" class="form-control break_size" id="no_interior" placeholder="Lt. 0000">
            </div>
        </div>
    </div>
</div>
<!-- 
    1.- Input -> name="" id="codigo_postal"
    2.- Input -> name="" id="estado"
    3.- Input -> name="" id="alcaldia"
    4.- Input -> name="" id="colonia"
    5.- Input -> name="" id="calle"
    6.- Input -> name="" id="no_exterior"
    7.- Input -> name="" id="no_interior"
    
 -->