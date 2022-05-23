"use strict";

$(document).ready(function () {
  var obtener_carrera = function obtener_carrera() {
    var datos = new FormData();
    datos.append('funcion', "consultar_carrera");
    var ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
    ejecucion.catalogo('carrera_origen', 'codigo_html');
    ejecucion.catalogo('carrera_paralelo', 'codigo_html');
  };

  obtener_carrera();
});