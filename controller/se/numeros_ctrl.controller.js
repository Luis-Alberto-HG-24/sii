"use strict";

var inputRange = function inputRange() {
  $("#rango_matriculas").val($("#num_matriculas").val());
};

var range = function range() {
  $("#num_matriculas").val($("#rango_matriculas").val());
};

$(document).ready(function () {
  var valorInicial = 50; //Valor por defecto de matriculas

  $("#num_matriculas").val(valorInicial);
  $("#rango_matriculas").val(valorInicial);
  caracter_numeros("num_matriculas"); //limita los caracteres a solo numeros

  var status_solicitud = function status_solicitud() {
    //funcion para cambiar el estatus de la solicitud
    if ($("#id_solicitud").val() != 0) {
      if ($("#estado_solicitud").val() == 0) {
        $("#alerta").remove();
        $("#status_solicitud").append("<div id=\"alerta\" class=\"alert alert-warning\" role=\"alert\">\n                        <h4 class=\"alert-heading\"><i class=\"fas fa-clock\"></i> Pendiente</h4>\n                        <p>Tu solicitud de numeros de control fue enviada.</p>\n                        <hr>\n                        <p class=\"mb-0\">Espera la aprobacion para generar una nueva solicitud.</p>\n                    </div>");
        $("#enviar_solicitud").attr("disabled", true);
      } else {
        $("#alerta").remove();
        $("#status_solicitud").append("<div id=\"alerta\" class=\"alert alert-secondary\" role=\"alert\">\n                        <h4 class=\"alert-heading\"><i class=\"fas fa-envelope-open-text\"></i> Sin Enviar</h4>\n                        <p>No tienes solicitudes de numeros de control enviadas.</p>\n                        <hr>\n                        <p class=\"mb-0\">Para generar una nueva solicitud de numeros de control selecciona un rango de matriculas y da click en \"Enviar solicitud\"</p>\n                    </div>\n                ");
      }
    } else {
      $("#alerta").remove();
      $("#status_solicitud").append("<div id=\"alerta\" class=\"alert alert-secondary\" role=\"alert\">\n                    <h4 class=\"alert-heading\"><i class=\"fas fa-envelope-open-text\"></i> Sin Enviar</h4>\n                    <p>No tienes solicitudes de numeros de control enviadas.</p>\n                    <hr>\n                    <p class=\"mb-0\">Para generar una nueva solicitud de numeros de control selecciona un rango de matriculas y da click en \"Enviar solicitud\"</p>\n                </div>");
    }
  };

  var consultar_estado_solicitud = function consultar_estado_solicitud() {
    // funcion para consultar el estado de la solicitud actual
    cargar();
    var datos = new FormData($('#frm_num_ctrl')[0]);
    datos.append('funcion', "consultar_estado_solicitud");
    fetch("model/se/num_ctrl.model.php", {
      method: "post",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      finalizado();
      $("#estado_solicitud").val(respuesta.estado_solicitud);
      $("#id_solicitud").val(respuesta.id_solicitud);
      status_solicitud();
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  };

  var enviar_solicitud = function enviar_solicitud() {
    //funcion para enviar solicitud
    var datos = new FormData($('#frm_num_ctrl')[0]);
    datos.append('funcion', "enviar_solicitud");
    var ejecucion = new Consultas("se/num_ctrl", datos);
    ejecucion.insercion();
    consultar_estado_solicitud();
    $('#tabla_datos').DataTable().ajax.reload();
  };

  var validar = function validar() {
    //funcion para validar el input de numeros de control
    if (validar_campo(["num_matriculas"], "numeros")) {}

    if (limitar_valor("num_matriculas", 1, 200, "Solo puedes ingresar números entre 1 y 200")) {} else {
      enviar_solicitud();
    }
  };

  var cancelar_solicitud = function cancelar_solicitud() {
    //funcion para cancelar y eliminar la solicitud actual
    swal({
      title: "¿Estas seguro de cancelar la solicitud?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(function (willDelete) {
      if (willDelete) {
        opening();
        var datos = new FormData($('#frm_num_ctrl')[0]);
        datos.append('funcion', "cancelar_solicitud");
        var ejecucion = new Consultas("se/num_ctrl", datos);
        ejecucion.insercion();
        consultar_estado_solicitud();
        $('#tabla_datos').DataTable().ajax.reload();
      } else {
        swal("¡La solicitud sigue activa!");
      }
    });
  };

  consultar_estado_solicitud();
  $("#enviar_solicitud").click(function () {
    validar();
  });
  $("#cancelar_solicitud").click(function () {
    $("#funcion").val("cancelar_solicitud");
    cancelar_solicitud();
  });
});