"use strict";

$(document).ready(function () {
  var total_actual = 0; //variable para llevar conteo de horas asignadas

  var aulas = new Array(); //funcion para evitar la insercion de caracteres diferentes a numeros en el campo capacidad de grupo

  caracter_numeros('capacidad');
  caracter_mayus('nombre_grupo'); //funcion para obtener el listado de carreras

  var obtener_carrera = function obtener_carrera() {
    var datos = new FormData();
    datos.append('funcion', "consultar_carrera");
    var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
    ejecucion.catalogo('carrera', 'codigo_html');
  }; //funcion para obtener el periodo activo


  var obtener_periodo = function obtener_periodo() {
    var datos = new FormData();
    datos.append('funcion', "consultar_semestre");
    var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
    ejecucion.catalogo('periodo', 'valor_input');
  };

  var obtener_aula = function obtener_aula() {
    var datos = new FormData();
    datos.append('funcion', "consultar_aula");
    var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);

    for (var i = 0; i < 7; i++) {
      ejecucion.catalogo("aula".concat(i), 'codigo_html');
    }
  }; //funcion para reiniciar el conteo de horas asignadas


  var reiniciar_contenido_tabla = function reiniciar_contenido_tabla() {
    $('#contador_horas').removeClass("alert-danger").addClass("alert-success");
    $('#contador_horas').removeClass("border-danger").addClass("border-success");
    $('#semestre').val("");
    $('#cambio_texto').html("<b><i class=\"fas fa-universal-access\"></i></b>");

    for (var i = 1; i < 7; i++) {
      actualizar_hora_final("", i);
      $("[name=horas_dia".concat(i)).val("");
      $("[name=hora_inicio".concat(i)).val("");
      $("[name=hora_inicio".concat(i)).prop('disabled', true);
      $("[name=hora_fin".concat(i)).prop('disabled', true);
      $("[name=aula".concat(i)).val("");
      $("[name=aula".concat(i)).prop('disabled', true);
    }
  }; //Reinicia todo el formulario en caso de utilizar F5 cuando ya se habian ingresado datos


  $('#frm_horario_grupo')[0].reset(); //invocacion de la funcion obtener_carrera

  obtener_carrera();
  obtener_aula();
  obtener_periodo(); //funcion change para detectar la selecion de carrera

  $("[name=carrera").on('change', function () {
    obtener_materia($("[name=carrera").val());
    $('[name=clave]').val("");
    $('[name=horas]').val("");
    $('[name=contador_horas]').html("<b>Horas por asignar: 0</b>");
    reiniciar_contenido_tabla();
  }); //funcion para obtener el listado de materias para la carrera seleccionada

  var obtener_materia = function obtener_materia(carrera) {
    var datos = new FormData();
    datos.append('funcion', "consultar_materia");
    datos.append('carrera', "".concat(carrera));
    var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
    ejecucion.catalogo('materia', 'codigo_html');
  }; //funcion change para detectar la selecion de materia


  $("[name=materia]").on('change', function () {
    obtener_datos_materia($("[name=materia").val());
    reiniciar_contenido_tabla();
    if ($("[name=materia").val() != "") for (var i = 1; i < 7; i++) {
      $("[name=hora_inicio".concat(i)).prop('disabled', false);
      $("[name=hora_fin".concat(i)).prop('disabled', false);
    }
  }); //funcion para obtener la informacion de la materia seleccionada

  var obtener_datos_materia = function obtener_datos_materia(materia) {
    var datos = new FormData();
    datos.append('funcion', "obtener_datos_materia");
    datos.append('materia', "".concat(materia));
    fetch("model/dep/horarios_grupo/horarios_grupo.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      if (respuesta) {
        $('#clave').val(respuesta['clave']);
        $('#horas').val(respuesta['creditos_totales']);
        $('#cambio_texto').html(respuesta['exclusivo_carrera'] == 1 ? "<b class=\"text-danger\"><i class=\"fas fa-universal-access\"></i> Si" : "<b class=\"text-success\"><i class=\"fas fa-universal-access\"></i> No" + "</b>");
        $('#contador_horas').html("<b>Horas por asignar: " + $('#horas').val() + "</b>");
      } else {
        $('#clave').val("");
        $('#horas').val("");
        $('#contador_horas').html("<b>Horas por asignar: 0</b>");
      }
    })["catch"](function (error) {
      msj_error("".concat(error));
    });
  }; //funcion para obtener la disponibilidad de un aula en el dia y horario seleccionado


  var obtener_disponibilidad = function obtener_disponibilidad(aula, dia, hora_inicio, hora_fin, id) {
    var datos = new FormData();
    datos.append('funcion', "obtener_disponibilidad");
    datos.append('aula', "".concat(aula));
    datos.append('dia', "".concat(dia));
    datos.append('hora_inicio', "".concat(hora_inicio));
    datos.append('hora_fin', "".concat(hora_fin));
    datos.append('periodo', "1");
    cargar();
    fetch("model/dep/horarios_grupo/horarios_grupo.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      finalizado();

      if (respuesta != "1") {
        msj_error("El aula seleccionada no esta disponible en el horario ingresado!");
        $('#aula' + id).val("");
      }
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  }; //funciones change para detectar la hora iniciar de la clase cada, funcion es para un dia de la semana


  $('#hora_inicio1').bind('change', function () {
    actualizar_hora_final($('#hora_inicio1').val(), 1);
    contar_horas_seleccionadas(1);
    $('#aula1').val("");
    $('#aula1').prop('disabled', true);
  });
  $('#hora_inicio2').bind('change', function () {
    actualizar_hora_final($('#hora_inicio2').val(), 2);
    contar_horas_seleccionadas(2);
    $('#aula2').val("");
    $('#aula2').prop('disabled', true);
  });
  $('#hora_inicio3').bind('change', function () {
    actualizar_hora_final($('#hora_inicio3').val(), 3);
    contar_horas_seleccionadas(3);
    $('#aula3').val("");
    $('#aula3').prop('disabled', true);
  });
  $('#hora_inicio4').bind('change', function () {
    actualizar_hora_final($('#hora_inicio4').val(), 4);
    contar_horas_seleccionadas(4);
    $('#aula4').val("");
    $('#aula4').prop('disabled', true);
  });
  $('#hora_inicio5').bind('change', function () {
    actualizar_hora_final($('#hora_inicio5').val(), 5);
    contar_horas_seleccionadas(5);
    $('#aula5').val("");
    $('#aula5').prop('disabled', true);
  });
  $('#hora_inicio6').bind('change', function () {
    actualizar_hora_final($('#hora_inicio6').val(), 6);
    contar_horas_seleccionadas(6);
    $('#aula6').val("");
    $('#aula6').prop('disabled', true);
  }); //funciones change para detectar la hora de finalizacion de clase, cada funcion es para un dia de la semana

  $('#hora_fin1').bind('change', function () {
    contar_horas_seleccionadas(1);

    if ($('#hora_fin1').val() != "") {
      $('#aula1').prop('disabled', false);
    } else {
      $('#aula1').val("");
      $('#aula1').prop('disabled', true);
    }
  });
  $('#hora_fin2').bind('change', function () {
    contar_horas_seleccionadas(2);

    if ($('#hora_fin2').val() != "") {
      $('#aula2').prop('disabled', false);
    } else {
      $('#aula2').val("");
      $('#aula2').prop('disabled', true);
    }
  });
  $('#hora_fin3').bind('change', function () {
    contar_horas_seleccionadas(3);

    if ($('#hora_fin3').val() != "") {
      $('#aula3').prop('disabled', false);
    } else {
      $('#aula3').val("");
      $('#aula3').prop('disabled', true);
    }
  });
  $('#hora_fin4').bind('change', function () {
    contar_horas_seleccionadas(4);

    if ($('#hora_fin4').val() != "") {
      $('#aula4').prop('disabled', false);
    } else {
      $('#aula4').val("");
      $('#aula4').prop('disabled', true);
    }
  });
  $('#hora_fin5').bind('change', function () {
    contar_horas_seleccionadas(5);

    if ($('#hora_fin5').val() != "") {
      $('#aula5').prop('disabled', false);
    } else {
      $('#aula5').val("");
      $('#aula5').prop('disabled', true);
    }
  });
  $('#hora_fin6').bind('change', function () {
    contar_horas_seleccionadas(6);

    if ($('#hora_fin6').val() != "") {
      $('#aula6').prop('disabled', false);
    } else {
      $('#aula6').val("");
      $('#aula6').prop('disabled', true);
    }
  }); //funciones change para detectar la hora de finalizacion de clase, cada funcion es para un dia de la semana

  $('#aula1').bind('change', function () {
    obtener_disponibilidad($('#aula1').val(), "lunes", $('#hora_inicio1').val(), $('#hora_fin1').val(), 1);
  });
  $('#aula2').bind('change', function () {
    obtener_disponibilidad($('#aula2').val(), "martes", $('#hora_inicio2').val(), $('#hora_fin2').val(), 2);
  });
  $('#aula3').bind('change', function () {
    obtener_disponibilidad($('#aula3').val(), "miercoles", $('#hora_inicio3').val(), $('#hora_fin3').val(), 3);
  });
  $('#aula4').bind('change', function () {
    obtener_disponibilidad($('#aula4').val(), "jueves", $('#hora_inicio4').val(), $('#hora_fin4').val(), 4);
  });
  $('#aula5').bind('change', function () {
    obtener_disponibilidad($('#aula5').val(), "viernes", $('#hora_inicio5').val(), $('#hora_fin5').val(), 5);
  });
  $('#aula6').bind('change', function () {
    obtener_disponibilidad($('#aula6').val(), "sabado", $('#hora_inicio6').val(), $('#hora_fin6').val(), 6);
  }); //funcion para actualizar las horas finales de la clase en base a la seleccion de la hora de inicio

  var actualizar_hora_final = function actualizar_hora_final(inicio, fin) {
    inicio = parseInt(inicio) + 1;
    var opciones = '<option value="">--:--</option>';

    for (var i = inicio; i < 22; i++) {
      if (i < 10) {
        opciones = opciones + '<option value="0' + i + ':00">0' + i + ':00</option>';
      } else {
        opciones = opciones + '<option value="' + i + ':00">' + i + ':00</option>';
      }
    }

    $('#hora_fin' + fin).html(opciones);

    if ($('#hora_inicio' + fin).val() == "") {
      $('#aula' + fin).val("");
      $('#aula' + fin).prop('disabled', true);
      $('#aula' + fin).val("");
    }
  }; //funcion para contar el numero de horas que se aignan por dia


  var contar_horas_seleccionadas = function contar_horas_seleccionadas(dia) {
    var horas_por_dia = $('#hora_inicio' + dia).val() != "" && $('#hora_fin' + dia).val() != "" ? parseInt($('#hora_fin' + dia).val()) - parseInt($('#hora_inicio' + dia).val()) : "";
    $('#horas_dia' + dia).val(horas_por_dia);
    contador_horas_materia(dia);
  }; //funcion para obtener y validar la ca|ntidad de horas aignadas no pueden ser mayor a la cantidad de horas disponibles


  var contador_horas_materia = function contador_horas_materia(dia) {
    var asignadas = 0;

    for (var i = 1; i < 7; i++) {
      if (/[0-9]/.test($('#horas_dia' + i).val())) {
        asignadas += parseInt($('#horas_dia' + i).val());
      }
    }

    var calcular = parseInt($('#horas').val()) - asignadas;
    var total = calcular < 1 ? "<b>Horas por asignar: 0</b>" : "<b>Horas por asignar: " + calcular + "</b>";

    if (calcular == 0) {
      total_actual = calcular;
      $('#contador_horas').removeClass("alert-success").addClass("alert-danger");
      $('#contador_horas').removeClass("border-success").addClass("border-danger");
      $('#contador_horas').html(total);
    } else if (calcular < 0) {
      msj_error("Tienes " + total_actual + "hr(s) disponible(s) para asignar!\n Por favor intentalo de nuevo.");
      actualizar_hora_final("", dia);
      $('#horas_dia' + dia).val("");
      contador_horas_materia(dia);
      $('#hora_inicio' + dia).val("");
      $('#aula' + dia).val("");
      $('#aula' + dia).prop('disabled', true);
    } else {
      total_actual = calcular;
      $('#contador_horas').html(total);
      $('#contador_horas').removeClass("alert-danger").addClass("alert-success");
      $('#contador_horas').removeClass("border-danger").addClass("border-success");
    }
  }; //funcion para evaluar si se asigno un aula a los dias que tienen un horario asignado


  var validar_total = function validar_total() {
    aulas = new Array();
    var total = 0,
        horas_totales = parseInt($('#horas').val());

    for (var i = 1; i < 7; i++) {
      if ($('#horas_dia' + i).val() != "") {
        aulas.push("aula".concat(i));
        total += parseInt($('#horas_dia' + i).val());
      }
    }

    if (total != horas_totales) {
      msj_error("Debes asignar un total de " + horas_totales + " hrs.");
      return false;
    } else {
      return true;
    }
  };

  $('#frm_horario_grupo').on('submit', function (e) {
    e.preventDefault();
    var datos = new FormData($('#frm_horario_grupo')[0]);
    datos.append("funcion", "insercion_horario");

    if (validar_campo(["carrera", "materia", "semestre", "nombre_grupo", "capacidad"], "vacios")) {
      if (validar_campo) {
        if (validar_campo(aulas, "vacios", "Debes asignar un aula a todos los dias designados para clase.")) {
          var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
          ejecucion.insercion();
          reiniciar_contenido_tabla();
          obtener_materia();
          obtener_aula();
          obtener_periodo();
        }
      }
    }
  });
});