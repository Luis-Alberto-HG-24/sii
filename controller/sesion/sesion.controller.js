"use strict";

$(document).ready(function () {
  $('#btn_cerrar_sesion').on('click', function (e) {
    var datos = new FormData();
    datos.append('funcion', 'cerrar_sesion');
    var ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
  });
  $('#btn_cerrar_sesion_movil').on('click', function (e) {
    var datos = new FormData();
    datos.append('funcion', 'cerrar_sesion');
    var ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
  });
});