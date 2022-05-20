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
        tabla += "\n                <tr> \n                    <td>".concat(nombre, "</td>\n                    <td>").concat(creditos_totales, "</td>\n                    <td>").concat(lunes, "</td>\n                    <td>").concat(martes, "</td>\n                    <td>").concat(miercoles, "</td>\n                    <td>").concat(jueves, "</td>\n                    <td>").concat(viernes, "</td>\n                    <td>").concat(sabado, "</td>\n                    <td>").concat(nombre_grupo, "</td>\n                    <td><button class=\"btn btn-primary btn-sm\"\" title=\"Editar\"><i class=\"fa-solid fa-eye\"></i></button></td>\n                </tr>");
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
  });
});

var obtener_informacion = function obtener_informacion(id) {
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
    });
    finalizado();
  })["catch"](function (error) {
    finalizado();
    msj_error("".concat(error));
  });
};