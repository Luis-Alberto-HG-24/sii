"use strict";

$(document).ready(function () {
  caracter_minus('usuario');
  $('#frm_login').on('submit', function (e) {
    e.preventDefault();
    var datos = new FormData($('#frm_login')[0]);
    datos.append('funcion', "iniciar_sesion");

    if (validar_campo(['usuario', 'password'], 'vacios')) {
      var ejecucion = new Consultas("login", datos);
      ejecucion.sesion();
    }
  });
});