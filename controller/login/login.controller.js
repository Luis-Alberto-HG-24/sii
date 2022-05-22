"use strict";

$(document).ready(function () {
  $('#frm_login').on('submit', function (e) {
    e.preventDefault();
    var datos = new FormData($('#frm_login')[0]);
    datos.append('funcion', "iniciar_sesion");

    if (validar_campo(['correo_institucional', 'password'], 'vacios')) {
      var ejecucion = new Consultas("login", datos);
      ejecucion.sesion();
    }
  });
});