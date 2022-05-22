"use strict";

$(document).ready(function () {
  var determinar_dia = function determinar_dia(dia, dia_tabla, hora_inicio, hora_fin, aula) {
    return dia == dia_tabla ? "".concat(hora_inicio, " - ").concat(hora_fin, " <br> ").concat(aula) : '';
  };

  var filtrar_contenido = function filtrar_contenido(filtro) {
    var materias = new Array();
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
      var i = 1;
      var temp_i = 0;
      var tabla = "";
      var temporal = "";
      var dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
      respuesta.map(function (horario) {
        var id_horario = horario.id_horario;
        var dia = horario.dia;
        var hora_inicio = horario.hora_inicio;
        var hora_fin = horario.hora_fin;
        var nombre_grupo = horario.nombre_grupo;
        var aula = horario.aula;
        var nombre = horario.nombre;
        var creditos_totales = horario.creditos_totales;

        if (temporal != nombre) {
          if (temporal != '') {
            tabla += "\n                        <td></td> \n                        <td>na</td>\n                        <td>".concat(nombre_grupo, "</td>\n                    </tr>\n                        ");
          }

          temporal = nombre;
          tabla += "\n                    <tr> \n                        <td>".concat(id_horario, "</td>\n                        <td>").concat(nombre, "</td>\n                        <td>").concat(determinar_dia(dia, 'lunes', hora_inicio, hora_fin, aula), "</td>");
          i = 1;
          temp_i = 0;
        } else {
          switch (dia) {
            case 'martes':
              {
                //tabla +=  `<td>${determinar_dia(dia, 'martes', hora_inicio, hora_fin, aula)}</td>`;
                i = 2;
                break;
              }

            case 'miercoles':
              {
                //tabla += `<td>${determinar_dia(dia, 'miercoles', hora_inicio, hora_fin, aula)}</td>`; 
                i = 3;
                break;
              }

            case 'jueves':
              {
                //tabla += `<td>${determinar_dia(dia, 'jueves', hora_inicio, hora_fin, aula)}</td>`;
                i = 4;
                break;
              }

            case 'viernes':
              {
                //tabla += `<td>${determinar_dia(dia, 'viernes', hora_inicio, hora_fin, aula)}</td>`; 
                i = 5;
                break;
              }

            case 'sabado':
              {
                //tabla += `<td>${determinar_dia(dia, 'sabado', hora_inicio, hora_fin, aula)}</td>`;
                i = 6;
                break;
              }

            default:
              {
                console.log('deault');
                tabla += "<td></td>";
                break;
              }
          }

          if (i - temp_i > 1) {
            for (var j = 1; j < i - temp_i; j++) {
              tabla += "<td></td>";
            }
          }

          temp_i = i;
          tabla += "<td>".concat(determinar_dia(dia, dias[i], hora_inicio, hora_fin, aula), "</td>");
        }
        /*  tabla += `
         <tr> 
             <td>${id_horario}</td>
             <td>${nombre}</td>
             <td>${determinar_dia(dia, 'lunes', hora_inicio, hora_fin)}</td>
             <td>${determinar_dia(dia, 'martes', hora_inicio, hora_fin)}</td>
             <td>${determinar_dia(dia, 'miercoles', hora_inicio, hora_fin)}</td>
             <td>${determinar_dia(dia, 'jueves', hora_inicio, hora_fin)}</td>
             <td>${determinar_dia(dia, 'viernes', hora_inicio, hora_fin)}</td>
             <td>${determinar_dia(dia, 'sabado', hora_inicio, hora_fin)}</td>
             <td>${aula}</td>
             <td>${nombre_grupo}</td>
         </tr>`; */

      });
      console.log(tabla);
      $("#tabla_horarios").html("".concat(tabla));
      $('#table_created_rooms').DataTable({
        "language": {
          "url": "./app/json/lenguaje.json"
        }
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