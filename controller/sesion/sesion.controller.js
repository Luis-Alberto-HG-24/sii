"use strict";

$(document).ready(function () {
  var cerrar_sesion = function cerrar_sesion() {
    var datos = new FormData();
    datos.append('funcion', 'cerrar_sesion');
    var ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
  };

  $('#btn_cerrar_sesion').on('click', function (e) {
    cerrar_sesion();
  });
  $('#btn_cerrar_sesion_movil').on('click', function (e) {
    cerrar_sesion();
  });

  var comprobar_inicio_sesion = function comprobar_inicio_sesion() {
    var datos = new FormData();
    datos.append('funcion', 'comprobar_sesion');
    fetch("model/sesion/login.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      finalizado();

      if (respuesta[0] == "0") {
        cerrar_sesion();
      }
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  };

  setInterval(function () {
    comprobar_inicio_sesion();
    ;
  }, 4000);
});