$(document).ready(() => {

    var numeros_control = "";
    var posicion = 0;

    var regCurp = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
    //Validacion de campos alumno
    const validar_vacios_datos_generales = ()=> {

        if ($('#apellido_paterno').val() == "" && $('#apellido_materno').val() == "" && $('#nombres').val() == "" && $('#lugar_nacimiento').val() == "" && $('#fecha_nacimiento').val() == "" 
            && $('#selector_sexo').val() == 0 && $('#selector_edo_civil').val() == 0 && $('#telefono').val() == "" && $('#curp').val() == "" && $('#correo_electronico').val() == "") {

            alertaAlumnos("No puedes dejar todos los campos vacios");
            return false;

        } else if ($('#apellido_paterno').val() == "" || /^\s+$/.test($('#apellido_paterno').val()) || $('#apellido_paterno').val() == undefined){

            alertaAlumnos("Debes de ingresar el apellido paterno del alumno");
            return false;

        } else if ($('#apellido_materno').val() == "" || /^\s+$/.test($('#apellido_materno').val()) || $('#apellido_materno').val() == undefined) {

            alertaAlumnos("Debes de ingresar el apellido materno del alumno");
            return false;

        } else if ($('#nombres').val() == "" || /^\s+$/.test($('#nombres').val()) || $('#nombres').val() == undefined) {

            alertaAlumnos("Debes de ingresar el nombre del alumno");
            return false;

        }else if ($('#lugar_nacimiento').val() == "" || /^\s+$/.test($('#lugar_nacimiento').val()) || $('#lugar_nacimiento').val() == undefined) {

            alertaAlumnos("Debes de ingresar el lugar de nacimiento del alumno");
            return false;

        } else if ($('#fecha_nacimiento').val() == "" || /^\s+$/.test($('#fecha_nacimiento').val()) || $('#fecha_nacimiento').val() == undefined) {

            alertaAlumnos("Debes de ingresar la fecha de nacimiento del alumno");
            return false;

        } else if ($('#selector_sexo').val() == 0 || $('#selector_sexo').val() == null || $('#selector_sexo').val() == undefined) {

            alertaAlumnos("Debes de ingresar el sexo del alumno");
            return false;

        } else if ($('#selector_edo_civil').val() == 0 || $('#selector_edo_civil').val() == null || $('#selector_edo_civil').val() == undefined) {

            alertaAlumnos("Debes de ingresar el estado civil del alumno");
            return false;

        } else if ($('#telefono').val() == "" || /^\s+$/.test($('#telefono').val()) || $('#telefono').val() == undefined) {

            alertaAlumnos("Debes de ingresar el telefono del alumno");
            return false;

        } else if ($('#curp').val() == "" || /^\s+$/.test($('#curp').val()) || $('#curp').val() == undefined) {

            alertaAlumnos("Debes de ingresar el curp del alumno");
            return false;

        } else if ($('#correo_electronico').val() == "" || /^\s+$/.test($('#correo_electronico').val()) || $('#correo_electronico').val() == undefined) {

            alertaAlumnos("Debes de ingresar el correo electronico del alumno");
            return false;

        } else if ($('#telefono').val().length > 10 || $('#telefono').val().length < 10) {

            alertaAlumnos("El telefono debe de tener 10 digitos");
            return false;

        } else if ($('#curp').val().length > 18 || $('#curp').val().length < 18) {

            alertaAlumnos("El curp debe de tener 18 digitos");
            return false;

        } else if (!regCurp.test($('#curp').val())) {

            alertaAlumnos("El curp debe de seguir una estructura valida");
            return false;


        } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('#correo_electronico').val()))) {

            alertaAlumnos("El correo electronico debe de seguir la siguiente estructura example@mail.com");
            return false;

        } else {

            estadoFormulario = 1;
            //$('#numero_control').prop('redonly', true);
            $("#form-part").text("Datos del Domicilio")
            $("#form_part_uno").hide()
            $("#form_part_dos").show()
        }





    }


    const generarCURP = ()=> {
        abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        random09a = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
        random09b = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
        randomAZ = Math.floor(Math.random() * (26 - 0 + 1)) + 0;
        ano = Number($("#fecha_nacimiento").val().slice(2, 4));
        var CURP = [];
        CURP[0] = $("#apellido_paterno").val().charAt(0).toUpperCase();
        CURP[1] = encontrar_vocales();
        CURP[2] = $("#apellido_materno").val().charAt(0).toUpperCase();
        CURP[3] = validar_nombre().charAt(0);
        altisonante = CURP[0]+CURP[1]+CURP[2]+CURP[3];
        CURP[0] = filtra_inconvenientes(altisonante).slice(0,1);
        CURP[1] = filtra_inconvenientes(altisonante).slice(1,2);
        CURP[2] = filtra_inconvenientes(altisonante).slice(2,3);
        CURP[3] = filtra_inconvenientes(altisonante).slice(3,4);
        cambiar_caracter = CURP[0]+CURP[1]+CURP[2]+CURP[3];
        CURP[0] = cambiar_caracteres_especiales(cambiar_caracter).slice(0,1).toUpperCase();
        CURP[1] = cambiar_caracteres_especiales(cambiar_caracter).slice(1,2).toUpperCase();
        CURP[2] = cambiar_caracteres_especiales(cambiar_caracter).slice(2,3).toUpperCase();
        CURP[3] = cambiar_caracteres_especiales(cambiar_caracter).slice(3,4).toUpperCase();
        CURP[4] = ano.toString().length == 1 ? "0" + ano.toString() : ano.toString();
        CURP[5] = $("#fecha_nacimiento").val().slice(5, 7);
        CURP[6] = $("#fecha_nacimiento").val().slice(8, 10);
        CURP[7] = $("#selector_sexo").val() == 1 ? "H" : $("#selector_sexo").val() == 2 ? "M" : "";
        CURP[8] = abreviacion[estados.indexOf($("#lugar_nacimiento").val().toLowerCase())];
        CURP[9] = $("#apellido_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
        CURP[10] = $("#apellido_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
        CURP[11] = $("#nombres").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
        cambiar_caracter_final = CURP[9] + CURP[10] + CURP[11];
        CURP[9] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(0,1).toUpperCase();
        CURP[10] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(1,2).toUpperCase();
        CURP[11] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(2,3).toUpperCase();
        return CURP.join("");
    }
        let estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        let abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];
        
        const filtra_inconvenientes = (str)=> {
            let inconvenientes = ['BACA', 'LOCO', 'BUEI', 'BUEY', 'MAME', 'CACA', 'MAMO',
                'CACO', 'MEAR', 'CAGA', 'MEAS', 'CAGO', 'MEON', 'CAKA', 'MIAR', 'CAKO', 'MION',
                'COGE', 'MOCO', 'COGI', 'MOKO', 'COJA', 'MULA', 'COJE', 'MULO', 'COJI', 'NACA',
                'COJO', 'NACO', 'COLA', 'PEDA', 'CULO', 'PEDO', 'FALO', 'PENE', 'FETO', 'PIPI',
                'GETA', 'PITO', 'GUEI', 'POPO', 'GUEY', 'PUTA', 'JETA', 'PUTO', 'JOTO', 'QULO',
                'KACA', 'RATA', 'KACO', 'ROBA', 'KAGA', 'ROBE', 'KAGO', 'ROBO', 'KAKA', 'RUIN',
                'KAKO', 'SENO', 'KOGE', 'TETA', 'KOGI', 'VACA', 'KOJA', 'VAGA', 'KOJE', 'VAGO',
                'KOJI', 'VAKA', 'KOJO', 'VUEI', 'KOLA', 'VUEY', 'KULO', 'WUEI', 'LILO', 'WUEY',
                'LOCA'];
        
            if (inconvenientes.indexOf(str) > -1) {
                str = str.replace(/^(\w)\w/, '$1X');
            }
            return str;
        }
        const cambiar_caracteres_especiales = (str)=> {
            let caracter_especial, caracter, respuesta;
        
            caracter_especial = ['Ã', 'À', 'Á', 'Ä', 'Â', 'È', 'É', 'Ë', 'Ê', 'Ì', 'Í', 'Ï', 'Î',
                'Ò', 'Ó', 'Ö', 'Ô', 'Ù', 'Ú', 'Ü', 'Û', 'ã', 'à', 'á', 'ä', 'â',
                'è', 'é', 'ë', 'ê', 'ì', 'í', 'ï', 'î', 'ò', 'ó', 'ö', 'ô', 'ù',
                'ú', 'ü', 'û', 'Ñ', 'ñ', 'Ç', 'ç'];
        
            caracter = ['A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I',
                'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'a', 'a', 'a', 'a', 'a',
                'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u',
                'u', 'u', 'u', 'n', 'n', 'c', 'c'];
        
            str = str.split('');
        
            respuesta = str.map((char)=> {
                let pos = caracter_especial.indexOf(char);
                return (pos > -1) ? caracter[pos] : char;
            });
        
            return respuesta.join('');
        }
        const encontrar_vocales = ()=> {
            let vocales = $('#apellido_paterno').val();
            if(vocales.slice(0,1).match(/[aeiou]/gi)){
                vocales = vocales.replace(/[^a,e,i,o,u,A,E,I,O,U]/g,'');
                vocales = vocales.slice(1).charAt(0).toUpperCase();
            }else{
                vocales = vocales.slice(1).charAt(0).toUpperCase();
            }
            
            return vocales;        
        }

        const validar_nombre = ()=> {
            let comunes, nombres, primer_nombre;
            comunes = ['MARIA', 'MA', 'MA.', 'JOSE', 'J', 'J.'];
            nombres = $('#nombres').val().toUpperCase().trim().split(/\s+/);
            primer_nombre = (nombres.length > 1 && comunes.indexOf(nombres[0]) > -1);
        
            if (primer_nombre) {
                return nombres[1].substring(0, 1);
            }
            if (!primer_nombre) {
                return nombres[0].substring(0, 1);
            }
        }
        

    $('#selector_sexo').change(() => {
        $("#curp").val(generarCURP());
    
    });



    //Datos del Domicilio
    const validar_vacios_datos_domicilio = ()=> {

        if ($('#codigo_postal').val() == "" || /^\s+$/.test($('#codigo_postal').val()) || $('#codigo_postal').val() == undefined) {

            alertaAlumnos("Debes de ingresar el codigo postal del alumno");
            return false;

        } else if ($('#estado').val() == "" || /^\s+$/.test($('#estado').val()) || $('#estado').val() == undefined) {

            alertaAlumnos("Debes de ingresar el estado del alumno");
            return false;

        } else if ($('#alcaldia').val() == "" || /^\s+$/.test($('#alcaldia').val()) || $('#alcaldia').val() == undefined) {

            alertaAlumnos("Debes de ingresar la alcaldia del alumno");
            return false;

        } else if ($('#colonia').val() == "" || /^\s+$/.test($('#colonia').val()) || $('#colonia').val() == undefined) {

            alertaAlumnos("Debes de ingresar la colonia del alumno");
            return false;

        } else if ($('#calle').val() == "" || /^\s+$/.test($('#calle').val()) || $('#calle').val() == undefined) {

            alertaAlumnos("Debes de seleccionar la calle del alumno");
            return false;

        }else if ($('#no_exterior').val() == "" || /^\s+$/.test($('#no_exterior').val()) || $('#no_exterior').val() == undefined) {

            alertaAlumnos("Debes de ingresar el numero exterior del alumno");
            return false;

        }else if ($('#codigo_postal').val().length > 5) {

            alertaAlumnos("El codigo postal debe de tener menos de 5 digitos");
            return false;

        }else if ($('#no_exterior').val().length > 5) {

            alertaAlumnos("El numero exterior debe de tener menos de 5 digitos");
            return false;

        } else if ($('#no_interior').val().length > 5) {

            alertaAlumnos("El numero interior debe tener menos de 5 digitos");
            return false;

        } else {
            estadoFormulario = 2;
            $("#form-part").text("Datos Escolares")
            $("#form_part_dos").hide()
            $("#form_part_tres").show()
            
        }
    } 

    //Datos Escolares
    const validar_vacios_datos_escolares = ()=> {

        if($('#carrera_reticula').val() == "" || /^\s+$/.test($('#carrera_reticula').val()) || $('#carrera_reticula').val() == undefined){

            alertaAlumnos("Debes de seleccionar la carrera del alumno");
            return false;
        }else if($('#especialidad').val() == "" || /^\s+$/.test($('#especialidad').val()) || $('#especialidad').val() == undefined){
                
            alertaAlumnos("Debes de seleccionar la especialidad del alumno");
            return false;
        }else if($('#periodo_ingreso').val() == "" || /^\s+$/.test($('#periodo_ingreso').val()) || $('#periodo_ingreso').val() == undefined){
                
            alertaAlumnos("Debes de seleccionar el periodo de ingreso del alumno");
            return false;
        }else if($('#plan_estudios').val() == "" || /^\s+$/.test($('#plan_estudios').val()) || $('#plan_estudios').val() == undefined){

            alertaAlumnos("Debes de seleccionar el plan de estudios del alumno");
            return false;
        }else if($('#nivel_escolar').val() == "" || /^\s+$/.test($('#nivel_escolar').val()) || $('#nivel_escolar').val() == undefined){
            alertaAlumnos("Debes de seleccionar el nivel escolar del alumno");
            return false;
        }else if($('#estatus_alumno').val() == "" || /^\s+$/.test($('#estatus_alumno').val()) || $('#estatus_alumno').val() == undefined){
            alertaAlumnos("Debes de seleccionar el estatus del alumno");
            return false;
        }else if(!($('#img_alumno').val())){
            alertaAlumnos("Debes agregar una fotografia para completar el registro!");
            
        }else{
            crear_alumno();
        }
    }      

    const fecha_nacimient = ()=> {
        let año = new Date();
        let yyyy = año.getFullYear();
        año_valido = yyyy - 17;
        año_valido = año_valido.toString();
        año_valido = año_valido + "-12-31";
        año_valido_min = yyyy - 80;
        año_valido_min = año_valido_min.toString();
        año_valido_min = año_valido_min + "-01-01";
        console.log(año_valido_min);
        $('#fecha_nacimiento').attr('max', año_valido);
        $('#fecha_nacimiento').attr('min', año_valido_min);
        
    }
    fecha_nacimient();

    const mostrarDatosControl = ()=> {
        posicion = 0;
        $.ajax({
            async: false,
            type: "POST",
            data: "funcion=mostrar_num_control",
            url: "model/se/model_creacion_alumno_se.php",
            success: (r) => {
                numeros_control = jQuery.parseJSON(r);
            }
        });
    }

    const insertarDatosControl = ()=> {
        mostrarDatosControl();
        $('#no_control').val(numeros_control[posicion].numero_control);
        $('#numero_control').val(numeros_control[posicion].id_numero_control);
    }

    insertarDatosControl();

    $('#btn_decrementar').click(()=>{
        if(posicion > 0){
            posicion--;
            $('#no_control').val(numeros_control[posicion].numero_control);
            $('#numero_control').val(numeros_control[posicion].id_numero_control);
        }
    });

    $('#btn_incrementar').click(()=>{
        if(posicion < numeros_control.length){
            posicion ++;
            $('#no_control').val(numeros_control[posicion].numero_control);
            $('#numero_control').val(numeros_control[posicion].id_numero_control);
        }
    });


    const alertaAlumnos = (msj)=> {
        swal({
            title: "Error!",
            text: msj,
            icon: "warning",
            button: "Aceptar",
        });
    }


    //Limitacion de caracteres
    const limitacion_caracteres = ()=> {

        $('#apellido_paterno').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
            
        });

        $('#apellido_materno').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        $('#nombres').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        $('#lugar_nacimiento').on('input', function () {
            this.value = this.value.replace(/[^A-Za-z0-9ñÑ# ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        $('#telefono').on('input', function () {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        $('#curp').on('input', function () {
            this.value = this.value.replace(/[^A-Za-z0-9ñÑ]/g, '');
            this.value = this.value.toUpperCase();
        });

        $('#codigo_postal').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $('#estado').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });
        $('#alcaldia').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });
        $('#colonia').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });
        $('#calle').on('input', function () {
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        $('#no_calle').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#no_exterior').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#no_interior').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#periodos_revalidados').on('input', function () {
            if(this.value > 12){
                this.value = 12;
            }else if(this.value < 1){
                this.value = 1;
            }
        });



        $( '#cb_revalidado' ).on( 'click', function() {
            if ($(this).is(':checked') ){
                $("#periodos_revalidados").prop('disabled', false);
                $("#periodos_revalidados").val(1);

            } else {
                $("#periodos_revalidados").prop('disabled', true);
                $("#periodos_revalidados").val(0);
    
               
            }
        });


    }

    $('#escritura_manual').on( 'click', function() {
        if ($(this).is(':checked') ){
            $('#estado').prop('readonly', false);
            $('#alcaldia').prop('readonly', false);
            // $('#colonia').prop('readonly', true);
            $('#colonia').replaceWith('<input type="text" class="form-control break_size" name="colonia" id="colonia">');
            $('#codigo_postal').val("");
            $('#estado').val("");
            $('#alcaldia').val("");
            $('#check_ditar').html('<input class="form-control" type="text" id="escritura" name="escritura" value="1" hidden>');
            $('#colonia').on('input', function () {
                this.value = this.value.replace(/[^a-zA-Z ñÑ]/g, '');
                this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
            });
        } else {
            $('#estado').prop('readonly', true);
            $('#alcaldia').prop('readonly', true);
            // $('#colonia').prop('readonly', false);
            $('#colonia').replaceWith('<select name="colonia" class="form-control break_size" id="colonia"></select>');
            $('#codigo_postal').val("");
            $('#estado').val("");
            $('#alcaldia').val("");
            $('#check_ditar').html('');
        }
    });

    //Informacion Inicial
    let estadoFormulario = 0
    $("#progreso-form").css("width", "1%")
    $("#form-part").text("Datos Generales")
    $("#form_part_dos").hide()
    $("#form_part_tres").hide()
    $("#form_part_uno").show()
    $("#atras").hide()
    $("#crear_alumno").hide();



    $("#siguiente").click(() => {

        if (estadoFormulario == 0) {
            validar_vacios_datos_generales();

        } else if (estadoFormulario == 1) {
            validar_vacios_datos_domicilio();

        }
        comprobarEstadoForm(estadoFormulario)
        comprobarVisualBotones()
    });


    $("#atras").click(() => {
        if (estadoFormulario == 1) {
            estadoFormulario = 0;
            $("#form-part").text("Datos Generales")
            $('#numero_control').prop('disabled', false);
            $("#form_part_dos").hide()
            $("#form_part_tres").hide()
            $("#form_part_uno").show()
        } else if (estadoFormulario == 2) {
            estadoFormulario = 1;
            $("#form-part").text("Datos del Domicilio")
            $("#form_part_uno").hide()
            $("#form_part_tres").hide()
            $("#form_part_dos").show()
        }
        comprobarEstadoForm(estadoFormulario)
        comprobarVisualBotones()
    });


    const comprobarEstadoForm = (edoForm) => {
        if (edoForm == 0) {
            $("#progreso-form").css("width", "1%")
        } else if (edoForm == 1) {
            $("#progreso-form").css("width", "50%")
        } else if (edoForm == 2) {
            $("#progreso-form").css("width", "100%")
        }
    }




    const comprobarVisualBotones = () => {
        if (estadoFormulario == 0) {
            $("#atras").hide()
            $("#crear_alumno").hide();
            $("#siguiente").show();
        } else {
            $("#atras").show()
        }
        if (estadoFormulario != 2) {
            $("#siguiente").text("Siguiente")
            $("#siguiente").show();
            $("#crear_alumno").hide();
        } else {
            $("#siguiente").hide();
            $("#crear_alumno").show();
            //$("#siguiente").text("Crear Alumno")
        }
    }

    limitacion_caracteres();

    $("#crear_alumno").click(()=>{
       validar_vacios_datos_escolares();
    });


    const reset_formulario = ()=> {
        $('#colonia').replaceWith('<select name="colonia" class="form-control break_size" id="colonia"></select>');
        $('#codigo_postal').val("");
        $('#estado').prop('readonly', true);
        $('#alcaldia').prop('readonly', true);
        $('#check_ditar').html('');

        estadoFormulario = 0
        comprobarVisualBotones()
        $("#progreso-form").css("width", "1%")
        $("#form-part").text("Datos Generales")
        $("#form_part_dos").hide()
        $("#form_part_tres").hide()
        $("#form_part_uno").show()
        $("#atras").hide()
        $("#crear_alumno").hide();
    }

    const crear_alumno = ()=> {
        $('#funcion').val("crear_alumno");
        let Form = new FormData($('#frm_creacion_alumno')[0]);
        opening();
        $.ajax({
            type: "POST",
            data: Form,
            url: "model/se/model_creacion_alumno_se.php",
            processData: false,
            contentType: false,
            success: (r) => {
                if(r === "2"){
                    $('#frm_creacion_alumno')[0].reset();
                    limpiar_foto();
                    posicion = 0;
                    insertarDatosControl();
                    reset_formulario();
                    ending();
                    swal({
                        title: "Ejecucion completada",
                        icon: "success",
                        text: "La creacion del nuevo alumno ha sido correcta! ",
                    }); 
                }else{
                    ending();
                    alertaAlumnos("Error al crear alumno! " + r);
                    return false;
                }
                
            }
        });  
    }

    const fecha_nacimiento = ()=> {
        let año = new Date();
        let yyyy = año.getFullYear();
        año_valido = yyyy - 17;
        año_max = yyyy - 17;
        año_valido = año_valido.toString();
        año_valido = año_valido + "-12-31";
        año_valido_min = yyyy - 80;
        año_min = yyyy- 80;
        año_valido_min = año_valido_min.toString();
        año_valido_min = año_valido_min + "-01-01";
        $('#fecha_nacimiento').attr('max', año_valido);
        $('#fecha_nacimiento').attr('min', año_valido_min);
        $('#fecha_nacimiento').on('input', () => {
            año_teclado = $('#fecha_nacimiento').val().slice(0, 4);
            año_teclado = parseInt(año_teclado);
            año_length = año_teclado.toString().length;
            if(año_length == "4"){
                console.log(año_length);
                if(año_teclado < año_min){
                    this.value = año_valido_min;

                }else if(año_teclado > año_max){
                    this.value = año_valido;
                }
            }
           
            
        });    
    }
    fecha_nacimiento();
    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

});