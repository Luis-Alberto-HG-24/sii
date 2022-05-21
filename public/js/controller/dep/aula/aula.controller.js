"use strict";

$(document).ready(function () {
  var bandera = true;
  $("#contenedor_observaciones").hide();
  $('#agregar_observacion').click(function () {
    showAndhide();
  });

  showAndhide = function showAndhide() {
    if (bandera == true) {
      bandera = false;
      console.log(bandera);
      $("#contenedor_observaciones").show();
    } else {
      bandera = true;
      console.log(bandera);
      $("#contenedor_observaciones").hide();
    }
  };

  $('#btn_cambiar').change(function () {
    $('#btn_inactivo').is(':checked') ? $('#cambio_texto').text('Activo') : $('#cambio_texto').text('Inactivo');
  });
  $('#actualizar_btn_cambiar').change(function () {
    $('#actualizar_btn_inactivo').is(':checked') ? $('#actualizar_cambio_texto').text('Activo') : $('#actualizar_cambio_texto').text('Inactivo');
  });
  $('#button_create').click(function () {
    Validar_vacios_aula();
  });
  $('#btn_actualizar').click(function () {
    validar_vacios_actualizar_aula();
  });

  $('#capacidad')[0].oninput = function () {
    if ($('#capacidad').val() > 0 && $('#capacidad').val() <= 50) {
      $('#background_ability').addClass('bg-success').addClass('text-white');
      $('#capacidad').addClass('bg-success').addClass('text-white');
      $('#capacidad').removeClass('bg-warning');
      $('#capacidad').removeClass('bg-danger');
      $('#background_ability').removeClass('bg-warning');
      $('#background_ability').removeClass('bg-danger');
      $('#message_label').addClass('text-success');
      $('#message_label').removeClass('text-primary');
      $('#message_label').removeClass('text-danger');
      $('#message_label').text('Limite aceptable.');
    } else if ($('#capacidad').val() > 50 && $('#capacidad').val() <= 60) {
      $('#background_ability').removeClass('bg-success').removeClass('text-white');
      $('#capacidad').removeClass('bg-success').removeClass('text-white');
      $('#background_ability').addClass('bg-warning');
      $('#capacidad').addClass('bg-warning');
      $('#background_ability').removeClass('bg-danger');
      $('#message_label').removeClass('text-success');
      $('#message_label').addClass('text-primary');
      $('#message_label').removeClass('text-danger');
      $('#message_label').text('Limite aceptable excedido.');
    } else if ($('#capacidad').val() > 60 && $('#capacidad').val() <= 80) {
      $('#background_ability').removeClass('bg-success');
      $('#background_ability').removeClass('bg-warning');
      $('#background_ability').addClass('bg-danger').addClass('text-white');
      $('#capacidad').removeClass('bg-success');
      $('#capacidad').removeClass('bg-warning');
      $('#capacidad').addClass('bg-danger').addClass('text-white');
      $('#message_label').removeClass('text-success');
      $('#message_label').removeClass('text-primary');
      $('#message_label').addClass('text-danger');
      $('#message_label').text('¡Sobre población de alumnos!');
    } else {
      $('#capacidad').val('');
      $('#capacidad').removeClass('bg-success').removeClass('text-white');
      $('#capacidad').removeClass('bg-warning');
      $('#capacidad').removeClass('bg-danger').removeClass('text-white');
      $('#background_ability').removeClass('bg-success').removeClass('text-white');
      $('#background_ability').removeClass('bg-warning');
      $('#background_ability').removeClass('bg-danger').removeClass('text-white');
      $('#message_label').removeClass('text-success');
      $('#message_label').removeClass('text-primary');
      $('#message_label').removeClass('text-danger');
      $('#message_label').text('');
    }
  };

  var remover_colores_capacidad = function remover_colores_capacidad() {
    $('#capacidad').val('');
    $('#capacidad').removeClass('bg-success').removeClass('text-white');
    $('#capacidad').removeClass('bg-warning');
    $('#capacidad').removeClass('bg-danger').removeClass('text-white');
    $('#background_ability').removeClass('bg-success').removeClass('text-white');
    $('#background_ability').removeClass('bg-warning');
    $('#background_ability').removeClass('bg-danger').removeClass('text-white');
    $('#message_label').removeClass('text-success');
    $('#message_label').removeClass('text-primary');
    $('#message_label').removeClass('text-danger');
    $('#message_label').text('');
  };

  $('#actualizar_capacidad')[0].oninput = function () {
    colores_actualizar_capacidad();
  };

  $('#table_created_rooms').DataTable();

  var alertaAula = function alertaAula(msj) {
    swal({
      title: "Error!",
      text: msj,
      icon: "warning",
      button: "Aceptar"
    });
  }; // Validar vacios aula


  var Validar_vacios_aula = function Validar_vacios_aula() {
    if ($('#nombre_aula').val() == "" || /^\s+$/.test($('#nombre_aula').val()) || $('#nombre_aula').val() == undefined) {
      alertaAula("Debes llenar el campo nombre de aula");
      return false;
    } else if ($('#capacidad').val() == "" || /^\s+$/.test($('#capacidad').val()) || $('#capacidad').val() == undefined) {
      alertaAula("Debes llenar el campo capacidad");
      return false;
    } else if ($('#ubicacion').val() == "" || /^\s+$/.test($('#ubicacion').val()) || $('#ubicacion').val() == undefined) {
      alertaAula("Debes llenar el campo ubicacion");
      return false;
    } else {
      agregar_aulas();
    }
  };

  var validar_vacios_actualizar_aula = function validar_vacios_actualizar_aula() {
    if ($('#actualizar_nombre_aula').val() == "" || /^\s+$/.test($('#actualizar_nombre_aula').val()) || $('#actualizar_nombre_aula').val() == undefined) {
      alertaAula("Debes llenar el campo nombre de aula");
      return false;
    } else if ($('#actualizar_capacidad').val() == "" || /^\s+$/.test($('#actualizar_capacidad').val()) || $('#actualizar_capacidad').val() == undefined) {
      alertaAula("Debes llenar el campo capacidad");
      return false;
    } else if ($('#actualizar_ubicacion').val() == "" || /^\s+$/.test($('#actualizar_ubicacion').val()) || $('#actualizar_ubicacion').val() == undefined) {
      alertaAula("Debes llenar el campo ubicacion");
      return false;
    } else {
      actualizar_aula();
    }
  }; // limitacion de caracteres


  var limitacion_caracteres_aula = function limitacion_caracteres_aula() {
    $('#nombre_aula').on('input', function () {
      $('#nombre_aula').val($('#nombre_aula').val().replace(/[^A-Za-z ñÑ 0-9]/g, ''));
      $('#nombre_aula').val($('#nombre_aula').val().toUpperCase());
    });
    $('#capacidad').on('input', function () {
      $('#capacidad').val($('#capacidad').val().replace(/[^0-9]/g, ''));
    });
    $('#ubicacion').on('input', function () {
      $('#ubicacion').val($('#ubicacion').val().replace(/[^A-Za-z ñÑ 0-9]/g, ''));
      $('#ubicacion').val($('#ubicacion').val().toUpperCase());
    });
    $('#observaciones').on('input', function () {
      $('#observaciones').val($('#observaciones').val().replace(/[^a-zA-Z ñÑ .]/g, ''));
      $('#observaciones').val($('#observaciones').val().charAt(0).toUpperCase() + $('#observaciones').val().slice(1));
    });
  };

  var limitacion_caracteres_actualizar_aula = function limitacion_caracteres_actualizar_aula() {
    $('#actualizar_nombre_aula').on('input', function () {
      $('#actualizar_nombre_aula').val($('#actualizar_nombre_aula').val().replace(/[^A-Za-z ñÑ 0-9]/g, ''));
      $('#actualizar_nombre_aula').val($('#actualizar_nombre_aula').val().toUpperCase());
    });
    $('#actualizar_capacidad').on('input', function () {
      $('#actualizar_capacidad').val($('#actualizar_capacidad').val().replace(/[^0-9]/g, ''));
    });
    $('#actualizar_ubicacion').on('input', function () {
      $('#actualizar_ubicacion').val($('#actualizar_ubicacion').val().replace(/[^A-Za-z ñÑ 0-9]/g, ''));
      $('#actualizar_ubicacion').val($('#actualizar_ubicacion').val().toUpperCase());
    });
    $('#actualizar_observaciones').on('input', function () {
      $('#actualizar_observaciones').val($('#actualizar_observaciones').val().replace(/[^a-zA-Z ñÑ .]/g, ''));
      $('#actualizar_observaciones').val($('#actualizar_observaciones').val().charAt(0).toUpperCase() + $('#actualizar_observaciones').val().slice(1));
    });
  };

  limitacion_caracteres_aula();
  limitacion_caracteres_actualizar_aula();

  var agregar_aulas = function agregar_aulas() {
    $('#funcion').attr('name', 'funcion');
    $('#funcion').val("agregar_aula");
    var Form = new FormData($('#frm_agregar_aula')[0]);
    opening();
    $.ajax({
      type: "POST",
      data: Form,
      url: "model/admin/aula/model_agregar_aula.php",
      processData: false,
      contentType: false,
      success: function success(r) {
        if (r === "1") {
          remover_colores_capacidad();
          tabla.ajax.reload(null, false);
          $('#frm_agregar_aula')[0].reset();
          $('#funcion_actualizar').removeAttr('name');
          posicion = 0;
          ending();
          swal({
            title: "Ejecucion completada",
            icon: "success",
            text: "Se ha agregado el aula! "
          });
        } else {
          console.log(r);
          ending();
          swal({
            title: "Ejecucion rechazada",
            icon: "error",
            text: "ha habido un error al agregar el aula! " + r
          });
          return false;
        }
      }
    });
  };
});

var eliminar_aula = function eliminar_aula(buscar) {
  swal({
    icon: "warning",
    title: "Seguro que quieres eliminar el aula?",
    html: true,
    text: '\n\n Una vez eliminado no lo podras recuperar',
    closeOnClickOutside: false,
    closeOnEsc: false,
    value: true,
    showCancelButton: true,
    buttons: ["Cancelar", "Eliminar Aula"]
  }).then(function (value) {
    if (value) {
      opening();
      $.ajax({
        type: "POST",
        data: "id_cat_aula=" + buscar + "&funcion=eliminar_aula",
        url: "./model/admin/aula/model_agregar_aula.php",
        success: function success(r) {
          console.log(r);

          if (r == 1) {
            tabla.ajax.reload(null, false);
            swal({
              title: "Aula eliminada",
              icon: "success",
              text: "Se ha removido el aula con exito"
            });
            ending();
          } else {
            ending();
            swal({
              title: "Error al eliminar aula",
              icon: "error",
              text: "Se ha removido el aula con exito"
            });
          }
        }
      });
    }
  });
};

var colores_actualizar_capacidad = function colores_actualizar_capacidad() {
  if ($('#actualizar_capacidad').val() > 0 && $('#actualizar_capacidad').val() <= 50) {
    $('#background_abilit_actualizar').addClass('bg-success').addClass('text-white');
    $('#actualizar_capacidad').addClass('bg-success').addClass('text-white');
    $('#actualizar_capacidad').removeClass('bg-warning');
    $('#actualizar_capacidad').removeClass('bg-danger');
    $('#background_abilit_actualizar').removeClass('bg-warning');
    $('#background_abilit_actualizar').removeClass('bg-danger');
    $('#message_label_actualizar').addClass('text-success');
    $('#message_label_actualizar').removeClass('text-primary');
    $('#message_label_actualizar').removeClass('text-danger');
    $('#message_label_actualizar').text('Limite aceptable.');
  } else if ($('#actualizar_capacidad').val() > 50 && $('#actualizar_capacidad').val() <= 60) {
    $('#background_abilit_actualizar').removeClass('bg-success').removeClass('text-white');
    $('#actualizar_capacidad').removeClass('bg-success').removeClass('text-white');
    $('#background_abilit_actualizar').addClass('bg-warning');
    $('#actualizar_capacidad').addClass('bg-warning');
    $('#background_abilit_actualizar').removeClass('bg-danger');
    $('#message_label_actualizar').removeClass('text-success');
    $('#message_label_actualizar').addClass('text-primary');
    $('#message_label_actualizar').removeClass('text-danger');
    $('#message_label_actualizar').text('Limite aceptable excedido.');
  } else if ($('#actualizar_capacidad').val() > 60 && $('#actualizar_capacidad').val() <= 80) {
    $('#background_abilit_actualizar').removeClass('bg-success');
    $('#background_abilit_actualizar').removeClass('bg-warning');
    $('#background_abilit_actualizar').addClass('bg-danger').addClass('text-white');
    $('#actualizar_capacidad').removeClass('bg-success');
    $('#actualizar_capacidad').removeClass('bg-warning');
    $('#actualizar_capacidad').addClass('bg-danger').addClass('text-white');
    $('#message_label_actualizar').removeClass('text-success');
    $('#message_label_actualizar').removeClass('text-primary');
    $('#message_label_actualizar').addClass('text-danger');
    $('#message_label_actualizar').text('¡Sobre población de alumnos!');
  } else {
    $('#actualizar_capacidad').val('');
    $('#actualizar_capacidad').removeClass('bg-success').removeClass('text-white');
    $('#actualizar_capacidad').removeClass('bg-warning');
    $('#actualizar_capacidad').removeClass('bg-danger').removeClass('text-white');
    $('#background_abilit_actualizar').removeClass('bg-success').removeClass('text-white');
    $('#background_abilit_actualizar').removeClass('bg-warning');
    $('#background_abilit_actualizar').removeClass('bg-danger').removeClass('text-white');
    $('#message_label_actualizar').removeClass('text-success');
    $('#message_label_actualizar').removeClass('text-primary');
    $('#message_label_actualizar').removeClass('text-danger');
    $('#message_label_actualizar').text('');
  }
};

var precargar_aula = function precargar_aula(buscar) {
  opening();
  $.ajax({
    type: "POST",
    data: "id_cat_aulas=" + buscar + "&funcion=precargar_aula",
    url: "model/admin/aula/model_agregar_aula.php",
    success: function success(r) {
      datos_usuario = jQuery.parseJSON(r);
      $("#id_cat_aula").val(datos_usuario['id_cat_aulas']);
      $("#actualizar_nombre_aula").val(datos_usuario['aula']);
      $("#actualizar_capacidad").val(datos_usuario['capacidad']);
      $("#actualizar_ubicacion").val(datos_usuario['ubicacion']);

      if (datos_usuario['estatus_aula'] == "ACTIVA") {
        $("#actualizar_btn_inactivo").prop("checked", true);
        $('#actualizar_cambio_texto').text('Activo');
        $("#actualizar_btn_inactivo").val('ACTIVA');
      } else {
        $("#actualizar_btn_inactivo").prop("checked", false);
        $('#actualizar_cambio_texto').text('Inactivo');
        $("#actualizar_btn_inactivo").val('INACTIVO');
      }

      colores_actualizar_capacidad();
      $("#actualizar_observaciones").val(datos_usuario['observaciones']);
      ending();
    }
  });
};

var actualizar_aula = function actualizar_aula() {
  $('#funcion_actualizar').attr('name', 'funcion');
  $('#funcion_actualizar').val("actualizar_aula");

  if (!$('#actualizar_btn_inactivo').prop('checked')) {
    $('#actualizar_btn_inactivo').val('INACTIVO');
  } else {
    $('#actualizar_btn_inactivo').val('ACTIVA');
  }

  var Form = new FormData($('#frm_actualizar_aula')[0]);
  opening();
  $.ajax({
    type: "POST",
    data: Form,
    url: "model/admin/aula/model_agregar_aula.php",
    processData: false,
    contentType: false,
    success: function success(r) {
      if (r === "1") {
        console.log($('#actualizar_btn_inactivo').val());
        tabla.ajax.reload(null, false);
        $("#aulaActualizar").modal("hide");
        $('#frm_actualizar_aula')[0].reset();
        $('#funcion_actualizar').removeAttr('name');
        posicion = 0;
        ending();
        swal({
          title: "Ejecucion completada",
          icon: "success",
          text: "Se ha agregado el aula! "
        });
      } else {
        ending();
        swal({
          title: "Ejecucion rechazada",
          icon: "error",
          text: "ha habido un error al agregar el aula! " + r
        });
        return false;
      }
    }
  });
};