<div id="form_part_uno">
    <div class="row align-items-end mb-3 prueba">
        <div class="col-lg-3 col-md-6 text-start">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                <input name="apellido_paterno" type="text" class="form-control break_size" id="apellido_paterno"
                    placeholder="Apellido" maxlength="100">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                <input name="apellido_materno" type="text" class="form-control break_size" id="apellido_materno"
                    placeholder="Apellido" maxlength="100">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="nombres" class="form-label">Nombres</label>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input name="nombres" type="text" class="form-control break_size" id="nombres"
                    placeholder="Nombres" maxlength="100">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-map"></i></span>
                <select class="form-select" name="lugar_nacimiento" id="lugar_nacimiento">
                    <option value="">Seleccionar</option>
                    <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                    <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                    <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                    <option value="CAMPECHE">CAMPECHE</option>
                    <option value="COAHUILA">COAHUILA</option>
                    <option value="COLIMA">COLIMA</option>
                    <option value="CHIAPAS">CHIAPAS</option>
                    <option value="CHIHUAHUA">CHIHUAHUA</option>
                    <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                    <option value="DURANGO">DURANGO</option>
                    <option value="ESTADO DE MEXICO">ESTADO DE MÉXICO</option>
                    <option value="GUANAJUATO">GUANAJUATO</option>
                    <option value="GUERRERO">GUERRERO</option>
                    <option value="HIDALGO">HIDALGO</option>
                    <option value="JALISCO">JALISCO</option>
                    <option value="MICHOACÁN">MICHOACÁN</option>
                    <option value="MORELOS">MORELOS</option>
                    <option value="NAYARIT">NAYARIT</option>
                    <option value="NUEVO LEÓN">NUEVO LEÓN</option>
                    <option value="OAXACA">OAXACA</option>
                    <option value="PUEBLA">PUEBLA</option>
                    <option value="QUERÉTARO">QUERÉTARO</option>
                    <option value="QUINTANA ROO">QUINTANA ROO</option>
                    <option value="SAN LUIS POTOSI">SAN LUIS POTOSÍ</option>
                    <option value="SINALOA">SINALOA</option>
                    <option value="SONORA">SONORA</option>
                    <option value="TABASCO">TABASCO</option>
                    <option value="TAMAULIPAS">TAMAULIPAS</option>
                    <option value="TLAXCALA">TLAXCALA</option>
                    <option value="VERACRUZ">VERACRUZ</option>
                    <option value="YUCATAN">YUCATÁN</option>
                    <option value="ZACATECAS">ZACATECAS</option>
                    <option value="NACIDO EN EL EXTRANJERO">NACIDO EN EL EXTRANJERO</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 text-start">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" max="2004-12-31" value="" date_format="YYYY-MM-DD" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"
                    placeholder="Fecha">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="sexo" class="form-label">Sexo</label>
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-venus-mars fa-lg"></i></span>
            <select class="form-select" name="selector_sexo" id="selector_sexo">
                <option value="">Seleccionar</option>    
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
            </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="edo_civil" class="form-label" id="label_mt">Estado Civil</label>
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-ring"></i></span>
            <select class="form-select" name="selector_edo_civil" id="selector_edo_civil">
                <option value="">Estado Civil</option>
                <option value="1">Soltero</option>
                <option value="2">Casado</option>
                <option value="3">Divorciado</option>
                <option value="4">Separación en proceso judicial</option>
                <option value="5">Viudo</option>
                <option value="6">Concubinato</option>
            </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 text-start">
            <label for="telefono" class="form-label">Telefono</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="10" placeholder="10 Digitos">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 text-start">
            <label for="curp" class="form-label">CURP</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                <input name="curp" type="tel" class="form-control break_size" id="curp"
                    placeholder="18 Caracteres" maxlength="18">
            </div>
        </div>
        <div class="col-lg-6 text-start">
            <label for="correo_electronico" class="form-label">Correo Electronico</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-at"></i></i></span>
                <input name="correo_electronico" type="email" class="form-control break_size"
                    id="correo_electronico" placeholder="example@correo.com">
            </div>

        </div>
    </div>

</div>

<!-- 
    1.- Input -> name="" id="apellido_paterno"
    2.- Input -> name="" id="apellido_materno"
    3.- Input -> name="" id="nombres"
    4.- Input -> name="" id="lugar_naciemiento"
    5.- Input -> name="" id="fecha_naciemiento"
    6.- Select -> id="selector_sexo"
    7.- Select -> id="selector_edo_civil"
    8.- Input -> name="" id="telefono"
    9.- Input -> name="" id="curp"
    10.- Input -> name="" id="correo-electronico"
 -->