"use strict";

comprobar_notificacion();
toast_notificacion();
var numero_notificacion = 0;

function comprobar_notificacion() {
  $.ajax({
    type: 'post',
    data: 'funcion=verificacion_notificacion',
    url: 'model/notificacion/notificacion.model.php',
    success: function success(r) {
      $('#contenido-notificacion').html(r);
      $("#contenedor").html("");
      $('#noti').html($('#cantidad-notify').val());
      $('#noti_responsive').html($('#cantidad-notify').val());

      if ($('#cantidad-notify').val() >= 1) {
        $('#avisar').html('<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>');
      } else {
        $('#avisar').html('');
      }

      numero_notificacion = $('#cantidad-notify').val();
    }
  });
}

function marcar_leida(noti) {
  $.ajax({
    type: 'post',
    data: 'funcion=marcar_notificacion' + '&id_solicitud=' + noti,
    url: 'model/notificacion/notificacion.model.php',
    success: function success(r) {
      comprobar_notificacion();
    }
  });
}

function toast_notificacion() {
  $.ajax({
    type: 'post',
    data: 'funcion=toast_notificacion',
    url: 'model/notificacion/notificacion.model.php',
    success: function success(r) {
      if (!(r == "")) {
        $('#toast_notifiacion').html(r);

        if (r) {
          $("#sonido_notificacion").trigger("click");
        }

        $('#toas_noti').toast('show');
      }
    }
  });
}

function sonido_notificacion() {
  var sonido = document.getElementById("audio");
  sonido.play();
}

$("#sonido_notificacion").click(function () {
  sonido_notificacion();
});
setInterval(function () {
  comprobar_notificacion();
  ;
  toast_notificacion();
}, 10000);