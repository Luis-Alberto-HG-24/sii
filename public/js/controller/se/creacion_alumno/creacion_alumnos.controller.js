"use strict";

var _this = void 0;

$(document).ready(function () {
  var numeros_control = "";
  var posicion = 0;
  var regCurp = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
  var estados = ["aguascalientes", "baja california", "baja california sur", "campeche", "chiapas", "chihuahua", "coahuila", "colima", "ciudad de mexico", "distrito federal", "durango", "guanajuato", "guerrero", "hidalgo", "jalisco", "estado de mexico", "michoacan", "morelos", "nayarit", "nuevo leon", "oaxaca", "puebla", "queretaro", "quintana roo", "san luis potosi", "sinaloa", "sonora", "tabasco", "tamaulipas", "tlaxcala", "veracruz", "yucatan", "zacatecas"];
  var abreviacion = ["AS", "BC", "BS", "CC", "CS", "CH", "CL", "CM", "CX", "DF", "DG", "GT", "GR", "HG", "JC", "MC", "MN", "MS", "NT", "NL", "OC", "PL", "QT", "QR", "SP", "SL", "SR", "TC", "TS", "TL", "VZ", "YN", "ZS"];
  primer_mayuscula('apellido_paterno');
  primer_mayuscula('apellido_materno');
  primer_mayuscula('nombres');
  caracter_mayus('curp');

  var comprobarVisualBotones = function comprobarVisualBotones() {
    if (estadoFormulario == 0) {
      $("#atras").hide();
      $("#crear_alumno").hide();
      $("#siguiente").show();
    } else {
      $("#atras").show();
    }

    if (estadoFormulario != 2) {
      $("#siguiente").text("Siguiente");
      $("#siguiente").show();
      $("#crear_alumno").hide();
    } else {
      $("#siguiente").hide();
      $("#crear_alumno").show(); //$("#siguiente").text("Crear Alumno")
    }
  }; //Validacion de campos alumno


  var validar_vacios_datos_generales = function validar_vacios_datos_generales() {
    var campos = ['apellido_paterno', 'apellido_materno', 'nombres', 'lugar_nacimiento', 'fecha_nacimiento', 'selector_sexo', 'selector_edo_civil', 'telefono', 'curp', 'correo_electronico'];

    if (validar_campo(campos, "vacios")) {
      if (validar_campo('correo_electronico', 'email')) {
        estadoFormulario = 1; //$('#numero_control').prop('redonly', true);

        $("#form-part").text("Datos del Domicilio");
        $("#form_part_uno").hide();
        $("#form_part_dos").show();
      }
    }
  };

  var encontrar_vocales = function encontrar_vocales() {
    var vocales = $('#apellido_paterno').val();

    if (vocales.slice(0, 1).match(/[aeiou]/gi)) {
      vocales = vocales.replace(/[^a,e,i,o,u,A,E,I,O,U]/g, '');
      vocales = vocales.slice(1).charAt(0).toUpperCase();
    } else {
      vocales = vocales.slice(1).charAt(0).toUpperCase();
    }

    return vocales;
  };

  var filtra_inconvenientes = function filtra_inconvenientes(str) {
    var inconvenientes = ['BACA', 'LOCO', 'BUEI', 'BUEY', 'MAME', 'CACA', 'MAMO', 'CACO', 'MEAR', 'CAGA', 'MEAS', 'CAGO', 'MEON', 'CAKA', 'MIAR', 'CAKO', 'MION', 'COGE', 'MOCO', 'COGI', 'MOKO', 'COJA', 'MULA', 'COJE', 'MULO', 'COJI', 'NACA', 'COJO', 'NACO', 'COLA', 'PEDA', 'CULO', 'PEDO', 'FALO', 'PENE', 'FETO', 'PIPI', 'GETA', 'PITO', 'GUEI', 'POPO', 'GUEY', 'PUTA', 'JETA', 'PUTO', 'JOTO', 'QULO', 'KACA', 'RATA', 'KACO', 'ROBA', 'KAGA', 'ROBE', 'KAGO', 'ROBO', 'KAKA', 'RUIN', 'KAKO', 'SENO', 'KOGE', 'TETA', 'KOGI', 'VACA', 'KOJA', 'VAGA', 'KOJE', 'VAGO', 'KOJI', 'VAKA', 'KOJO', 'VUEI', 'KOLA', 'VUEY', 'KULO', 'WUEI', 'LILO', 'WUEY', 'LOCA'];

    if (inconvenientes.indexOf(str) > -1) {
      str = str.replace(/^(\w)\w/, '$1X');
    }

    return str;
  };

  var cambiar_caracteres_especiales = function cambiar_caracteres_especiales(str) {
    var caracter_especial, caracter, respuesta;
    caracter_especial = ['??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??'];
    caracter = ['A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'n', 'n', 'c', 'c'];
    str = str.split('');
    respuesta = str.map(function (_char) {
      var pos = caracter_especial.indexOf(_char);
      return pos > -1 ? caracter[pos] : _char;
    });
    return respuesta.join('');
  };

  var validar_nombre = function validar_nombre() {
    var comunes, nombres, primer_nombre;
    comunes = ['MARIA', 'MA', 'MA.', 'JOSE', 'J', 'J.'];
    nombres = $('#nombres').val().toUpperCase().trim().split(/\s+/);
    primer_nombre = nombres.length > 1 && comunes.indexOf(nombres[0]) > -1;

    if (primer_nombre) {
      return nombres[1].substring(0, 1);
    }

    if (!primer_nombre) {
      return nombres[0].substring(0, 1);
    }
  };

  var generarCURP = function generarCURP() {
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
    altisonante = CURP[0] + CURP[1] + CURP[2] + CURP[3];
    CURP[0] = filtra_inconvenientes(altisonante).slice(0, 1);
    CURP[1] = filtra_inconvenientes(altisonante).slice(1, 2);
    CURP[2] = filtra_inconvenientes(altisonante).slice(2, 3);
    CURP[3] = filtra_inconvenientes(altisonante).slice(3, 4);
    cambiar_caracter = CURP[0] + CURP[1] + CURP[2] + CURP[3];
    CURP[0] = cambiar_caracteres_especiales(cambiar_caracter).slice(0, 1).toUpperCase();
    CURP[1] = cambiar_caracteres_especiales(cambiar_caracter).slice(1, 2).toUpperCase();
    CURP[2] = cambiar_caracteres_especiales(cambiar_caracter).slice(2, 3).toUpperCase();
    CURP[3] = cambiar_caracteres_especiales(cambiar_caracter).slice(3, 4).toUpperCase();
    CURP[4] = ano.toString().length == 1 ? "0" + ano.toString() : ano.toString();
    CURP[5] = $("#fecha_nacimiento").val().slice(5, 7);
    CURP[6] = $("#fecha_nacimiento").val().slice(8, 10);
    CURP[7] = $("#selector_sexo").val() == 1 ? "H" : $("#selector_sexo").val() == 2 ? "M" : "";
    CURP[8] = abreviacion[estados.indexOf($("#lugar_nacimiento").val().toLowerCase())];
    CURP[9] = $("#apellido_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
    CURP[10] = $("#apellido_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
    CURP[11] = $("#nombres").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
    cambiar_caracter_final = CURP[9] + CURP[10] + CURP[11];
    CURP[9] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(0, 1).toUpperCase();
    CURP[10] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(1, 2).toUpperCase();
    CURP[11] = cambiar_caracteres_especiales(cambiar_caracter_final).slice(2, 3).toUpperCase();
    return CURP.join("");
  };

  $('#selector_sexo').change(function () {
    $("#curp").val(generarCURP());
  }); //Datos del Domicilio

  var validar_vacios_datos_domicilio = function validar_vacios_datos_domicilio() {
    var campos = ['codigo_postal', 'estado', 'alcaldia', 'colonia', 'calle', 'no_exterior'];

    if (validar_campo(campos, "vacios")) {
      if (longitud_campo_exacta('codigo_postal', 5, 'El codigo postal debe contener 5 digitos!')) {
        if (longitud_campo('no_exterior', 5, 'El codigo postal debe contener 5 digitos!')) {
          if (longitud_campo('codigo_postal', 5, 'El codigo postal debe contener 5 digitos!')) {
            estadoFormulario = 2;
            $("#form-part").text("Datos Escolares");
            $("#form_part_dos").hide();
            $("#form_part_tres").show();
          }
        }
      }
    }
  }; //Datos Escolares


  var validar_vacios_datos_escolares = function validar_vacios_datos_escolares() {
    var campos = ['carrera_reticula', 'especialidad', 'periodo_ingreso', 'plan_estudios', 'nivel_escolar', 'estatus_alumno', 'img_alumno'];

    if (longitud_campo_exacta('codigo_postal', 5, 'El codigo postal debe contener 5 digitos!')) {
      crear_alumno();
    }
  };
  /*  const fecha_nacimient = () => {
       let a??o = new Date();
       let yyyy = a??o.getFullYear();
       a??o_valido = yyyy - 17;
       a??o_valido = a??o_valido.toString();
       a??o_valido = a??o_valido + "-12-31";
       a??o_valido_min = yyyy - 80;
       a??o_valido_min = a??o_valido_min.toString();
       a??o_valido_min = a??o_valido_min + "-01-01";
       console.log(a??o_valido_min);
       $('#fecha_nacimiento').attr('max', a??o_valido);
       $('#fecha_nacimiento').attr('min', a??o_valido_min);
     }
   fecha_nacimient(); */
  //funciones del apartado de numero de control


  var mostrarDatosControl = function mostrarDatosControl() {
    posicion = 0;
    cargar();
    var datos = new FormData();
    datos.append('funcion', "mostrar_num_control");
    fetch("model/se/creacion_alumno/creacion_alumno.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      finalizado();
      insertarDatosControl(respuesta);
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  };

  var insertarDatosControl = function insertarDatosControl(respuesta) {
    numeros_control = respuesta;
    $('#no_control').val(numeros_control[posicion].numero_control);
    $('#numero_control').val(numeros_control[posicion].id_numero_control);
  };

  mostrarDatosControl();
  $('#btn_decrementar').click(function () {
    if (posicion > 0) {
      posicion--;
      $('#no_control').val(numeros_control[posicion].numero_control);
      $('#numero_control').val(numeros_control[posicion].id_numero_control);
    }
  });
  $('#btn_incrementar').click(function () {
    if (posicion < numeros_control.length) {
      posicion++;
      $('#no_control').val(numeros_control[posicion].numero_control);
      $('#numero_control').val(numeros_control[posicion].id_numero_control);
    }
  }); //Limitacion de caracteres

  var limitacion_caracteres = function limitacion_caracteres() {
    caracter_letras('apellido_paterno');
    caracter_letras('apellido_materno');
    caracter_letras('nombres');
    $('#lugar_nacimiento').on('input', function () {
      this.value = this.value.replace(/[^A-Za-z0-9????# ]/g, '');
      this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
    });
    caracter_numeros('telefono');
    caracter_varios('curp');
    caracter_numeros('codigo_postal');
    caracter_letras('estado');
    caracter_letras('alcaldia');
    caracter_letras('colonia');
    primer_mayuscula('calle');
    caracter_numeros('no_calle');
    caracter_numeros('no_exterior');
    caracter_numeros('no_interior');
    $('#periodos_revalidados').on('input', function () {
      if (this.value > 12) {
        this.value = 12;
      } else if (this.value < 1) {
        this.value = 1;
      }
    });
    $('#cb_revalidado').on('click', function () {
      if ($(this).is(':checked')) {
        $("#periodos_revalidados").prop('disabled', false);
        $("#periodos_revalidados").val(1);
      } else {
        $("#periodos_revalidados").prop('disabled', true);
        $("#periodos_revalidados").val(0);
      }
    });
  };

  $('#escritura_manual').on('click', function () {
    if ($(this).is(':checked')) {
      $('#estado').prop('readonly', false);
      $('#alcaldia').prop('readonly', false); // $('#colonia').prop('readonly', true);

      $('#colonia').replaceWith('<input type="text" class="form-control break_size" name="colonia" id="colonia">');
      $('#codigo_postal').val("");
      $('#estado').val("");
      $('#alcaldia').val("");
      $('#check_ditar').html('<input class="form-control" type="text" id="escritura" name="escritura" value="1" hidden>');
      $('#colonia').on('input', function () {
        this.value = this.value.replace(/[^a-zA-Z ????]/g, '');
        this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
      });
    } else {
      $('#estado').prop('readonly', true);
      $('#alcaldia').prop('readonly', true); // $('#colonia').prop('readonly', false);

      $('#colonia').replaceWith('<select name="colonia" class="form-control break_size" id="colonia"></select>');
      $('#codigo_postal').val("");
      $('#estado').val("");
      $('#alcaldia').val("");
      $('#check_ditar').html('');
    }
  }); //Informacion Inicial

  var estadoFormulario = 0;
  $("#progreso-form").css("width", "1%");
  $("#form-part").text("Datos Generales");
  $("#form_part_dos").hide();
  $("#form_part_tres").hide();
  $("#form_part_uno").show();
  $("#atras").hide();
  $("#crear_alumno").hide();
  $("#siguiente").click(function () {
    if (estadoFormulario == 0) {
      validar_vacios_datos_generales();
    } else if (estadoFormulario == 1) {
      validar_vacios_datos_domicilio();
    }

    comprobarEstadoForm(estadoFormulario);
    comprobarVisualBotones();
  });
  $("#atras").click(function () {
    if (estadoFormulario == 1) {
      estadoFormulario = 0;
      $("#form-part").text("Datos Generales");
      $('#numero_control').prop('disabled', false);
      $("#form_part_dos").hide();
      $("#form_part_tres").hide();
      $("#form_part_uno").show();
    } else if (estadoFormulario == 2) {
      estadoFormulario = 1;
      $("#form-part").text("Datos del Domicilio");
      $("#form_part_uno").hide();
      $("#form_part_tres").hide();
      $("#form_part_dos").show();
    }

    comprobarEstadoForm(estadoFormulario);
    comprobarVisualBotones();
  });

  var comprobarEstadoForm = function comprobarEstadoForm(edoForm) {
    if (edoForm == 0) {
      $("#progreso-form").css("width", "1%");
    } else if (edoForm == 1) {
      $("#progreso-form").css("width", "50%");
    } else if (edoForm == 2) {
      $("#progreso-form").css("width", "100%");
    }
  };

  limitacion_caracteres();
  $("#crear_alumno").click(function () {
    validar_vacios_datos_escolares();
  });

  var reset_formulario = function reset_formulario() {
    $('#colonia').replaceWith('<select name="colonia" class="form-control break_size" id="colonia"></select>');
    $('#codigo_postal').val("");
    $('#estado').prop('readonly', true);
    $('#alcaldia').prop('readonly', true);
    $('#check_ditar').html('');
    estadoFormulario = 0;
    comprobarVisualBotones();
    $("#progreso-form").css("width", "1%");
    $("#form-part").text("Datos Generales");
    $("#form_part_dos").hide();
    $("#form_part_tres").hide();
    $("#form_part_uno").show();
    $("#atras").hide();
    $("#crear_alumno").hide();
  };

  var crear_alumno = function crear_alumno() {
    $('#funcion').val("crear_alumno");
    var Form = new FormData($('#frm_creacion_alumno')[0]);
    opening();
    $.ajax({
      type: "POST",
      data: Form,
      url: "model/se/model_creacion_alumno_se.php",
      processData: false,
      contentType: false,
      success: function success(r) {
        if (r === "2") {
          $('#frm_creacion_alumno')[0].reset();
          limpiar_foto();
          posicion = 0;
          insertarDatosControl();
          reset_formulario();
          ending();
          swal({
            title: "Ejecucion completada",
            icon: "success",
            text: "La creacion del nuevo alumno ha sido correcta! "
          });
        } else {
          ending();
          msj_error("Error al crear alumno! " + r);
          return false;
        }
      }
    });
  };

  var fecha_nacimiento = function fecha_nacimiento() {
    var a??o = new Date();
    var yyyy = a??o.getFullYear();
    a??o_valido = yyyy - 17;
    a??o_max = yyyy - 17;
    a??o_valido = a??o_valido.toString();
    a??o_valido = a??o_valido + "-12-31";
    a??o_valido_min = yyyy - 80;
    a??o_min = yyyy - 80;
    a??o_valido_min = a??o_valido_min.toString();
    a??o_valido_min = a??o_valido_min + "-01-01";
    $('#fecha_nacimiento').attr('max', a??o_valido);
    $('#fecha_nacimiento').attr('min', a??o_valido_min);
    $('#fecha_nacimiento').on('input', function () {
      a??o_teclado = $('#fecha_nacimiento').val().slice(0, 4);
      a??o_teclado = parseInt(a??o_teclado);
      a??o_length = a??o_teclado.toString().length;

      if (a??o_length == "4") {
        console.log(a??o_length);

        if (a??o_teclado < a??o_min) {
          _this.value = a??o_valido_min;
        } else if (a??o_teclado > a??o_max) {
          _this.value = a??o_valido;
        }
      }
    });
  };

  fecha_nacimiento();
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});