"use strict";

$(document).ready(function () {
  var determinar_dia = function determinar_dia(dia, dia_tabla, hora_inicio, hora_fin, aula) {
    return dia == dia_tabla ? "".concat(hora_inicio, " - ").concat(hora_fin, " <br> ").concat(aula) : '';
  };

  var filtrar_contenido = function filtrar_contenido(filtro) {
    cargar();
    $("#tabla_horarios").html("");
    $('#table_created_rooms').DataTable().destroy();
    var datos = new FormData();

    if (filtro != 0) {
      datos.append('funcion', 'consulta_filtrada');
      datos.append('filtro', "".concat(filtro));
    } else {
      datos.append('funcion', 'consultar_horarios');
    }

    fetch("model/dep/horarios_grupo/listado_horarios.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      var tabla = "";
      respuesta.map(function (horario) {
        var id_horario = horario.id_horario;
        var lunes = horario.lunes;
        var martes = horario.martes;
        var miercoles = horario.miercoles;
        var jueves = horario.jueves;
        var viernes = horario.viernes;
        var sabado = horario.sabado;
        var nombre_grupo = horario.nombre_grupo;
        var nombre = horario.nombre;
        var creditos_totales = horario.creditos_totales;
        tabla += "\n                <tr> \n                    <td>".concat(nombre, "</td>\n                    <td>").concat(creditos_totales, "</td>\n                    <td id=\"lunes").concat(id_horario, "\">").concat(lunes, "</td>\n                    <td id=\"martes").concat(id_horario, "\">").concat(martes, "</td>\n                    <td id=\"miercoles").concat(id_horario, "\">").concat(miercoles, "</td>\n                    <td id=\"jueves").concat(id_horario, "\">").concat(jueves, "</td>\n                    <td id=\"viernes").concat(id_horario, "\">").concat(viernes, "</td>\n                    <td id=\"sabado").concat(id_horario, "\">").concat(sabado, "</td>\n                    <td>").concat(nombre_grupo, "</td>\n                    <td>\n                        <button class=\"btn btn-outline-success btn-sm\"\" title=\"Actualizar\" onclick=\"obtener_informacion(").concat(id_horario, ")\" data-bs-toggle=\"modal\" data-bs-target=\"#staticBackdrop\"><i class=\"fa-solid fa-check\"></i></button>\n                        <button class=\"btn btn-outline-primary btn-sm\"\" title=\"Editar\"><i class=\"fa-solid fa-eye\"></i></button>\n                    </td>\n                </tr>");
      });
      $("#tabla_horarios").html("".concat(tabla));
      $('#table_created_rooms').DataTable({
        "language": {
          "url": "./app/json/lenguaje.json"
        },
        responsive: 'true',
        dom: 'Bfrtip',
        buttons: [{
          extend: 'pdfHtml5',
          text: 'PDF <i class="fa-solid fa-file-pdf"></i>',
          titleAttr: 'Exportar como PDF',
          className: 'btn btn-outline-danger',
          orientation: "landscape",
          title: 'Horarios',
          exportOptions: {
            modifier: {
              page: 'current'
            }
          }
        }]
      });
      finalizado();
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  };

  filtrar_contenido(0);
  $("[name=carrera]").on('change', function () {
    filtrar_contenido($("[name=carrera]").val());
  }); //funcion para obtener la disponibilidad de un aula en el dia y horario seleccionado

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
  };
});

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

  $('#hora_fin').html(opciones);
  $('#aula').val("");
};

$('#hora_inicio').bind('change', function () {
  actualizar_hora_final($('#hora_inicio').val(), 1); //contar_horas_seleccionadas(1);

  $('#aula').val("");
  $('#aula').prop('disabled', true);
});
$('#hora_fin').bind('change', function () {
  //contar_horas_seleccionadas(1);
  $('#aula').val("");

  if ($('#hora_fin').val() != "") {
    $('#aula').prop('disabled', false);
  } else {
    $('#aula').val("");
    $('#aula').prop('disabled', true);
  }
});

var obtener_aula = function obtener_aula() {
  var datos = new FormData();
  datos.append('funcion', "consultar_aula");
  var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
  ejecucion.catalogo("aula", 'codigo_html');
};

var obtener_informacion = function obtener_informacion(id) {
  obtener_aula();
  $('#hora_inicio').val("");
  actualizar_hora_final($('#hora_inicio').val(), 1);
  $('#hora_fin').val("");
  $('#aula').prop('disabled', true);
  var datos = new FormData();
  datos.append('funcion', "consultar_horario");
  datos.append('id_horario', "".concat(id));
  cargar();
  fetch("model/dep/horarios_grupo/listado_horarios.model.php", {
    method: "POST",
    body: datos
  }).then(function (respuesta) {
    return respuesta.json();
  }).then(function (respuesta) {
    respuesta.map(function (horario) {
      var id_horario = horario.id_horario;
      var hora_inicio = horario.hora_inicio;
      var hora_fin = horario.hora_fin;
      var id_cat_aula = horario.id_cat_aula;
      var aula = horario.aula;
      var id_grupo = horario.id_grupo;
      $("[name=hora_inicio_actual]").val(hora_inicio);
      $("[name=hora_fin_actual]").val(hora_fin);
      $("[name=aula_actual]").val(aula);
      $("[name=id_horario]").val(id_horario);
    });
    finalizado();
  })["catch"](function (error) {
    finalizado();
    msj_error("".concat(error));
  });
};

$("#btn_limpiar").click(function () {
  $("[name=hora_inicio_actual]").val("");
  $("[name=hora_fin_actual]").val("");
  $("[name=aula_actual]").val("");
  $("#lunes1").html("");
});