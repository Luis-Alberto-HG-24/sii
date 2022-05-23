"use strict";

var x, y, w, h;
var ver = 0;

var mostar_area_recorte = function mostar_area_recorte(url) {
  //$('#recorte_img').attr('src', url);
  $('#crear').html('<img src="' + url + '" name="recorte_img" id="recorte_img" alt="Foto Alumno"> ');
  recorte();
};

var validar_fotografia = function validar_fotografia() {
  var foto = $('#img_alumno').val();
  var extensiones = /(.jpg|.jpeg)$/i;

  if (!extensiones.exec(foto)) {
    $('#img_alumno').val("");
    msj_error("Formato de imagen no valido, solo se admiten archivos con extension \".jpg\"");
    return false;
  } else {
    var peso = $('#img_alumno')[0].files[0].size;

    if (peso > 2000 * 1024) {
      $('#img_alumno').val("");
      msj_error("El peso de la imagen no puede ser mayor 2MB!");
      return false;
    } else {
      return true;
    }
  }
};

var handleFileSelect = function handleFileSelect(evt) {
  if (validar_fotografia()) {
    $('#input_file').css("display", "none");
    var archivos = evt.target.files;

    for (var i = 0, archivo; archivo = archivos[i]; i++) {
      if (!archivo.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      reader.onload = function (theFile) {
        return function (e) {
          var span = '<span class="btn-cancelar"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="thumb rounded" src="' + e.target.result + '" title="' + escape(theFile.name) + '"/></a><div class="boton-emergente"><button onclick="limpiar_foto()" class="btn btn-img btn-sm" type="button" title="Eliminar"><i class="fas fa-times" style="font-size: 9px; margin-left: -3px"></i></button></div></span>';
          $('#img_foto').html(span);
          mostar_area_recorte(e.target.result);
        };
      }(archivo);

      reader.readAsDataURL(archivo);
    }
  }
};

$('#img_alumno').on('change', handleFileSelect);

var limpiar_foto = function limpiar_foto() {
  $('#input_file').css("display", "block");
  $('#img_foto').html("");
  $('#img_alumno').val("");
  x = "";
  y = "";
  w = "";
  h = "";
};

var precargar_foto = function precargar_foto() {
  ver++;
  $('#input_file').css("display", "none");
  var span = '<span class="btn-cancelar"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="thumb rounded" src="public/img/se/fotografia.webp?ver=' + ver + '" title="Fotografia alumno"/></a><div class="boton-emergente"><button onclick="limpiar_foto()" class="btn btn-img btn-sm" type="button" title="Eliminar"><i class="fas fa-times" style="font-size: 9px; margin-left: -3px"></></button></div></span>';
  $('#img_foto').html(span);
};

var showCoords = function showCoords(c) {
  x = c.x;
  y = c.y;
  w = c.w;
  h = c.h;
};

var recorte = function recorte() {
  $('#recorte_img').Jcrop({
    onSelect: showCoords,
    bgColor: 'black',
    bgOpacity: .4,
    aspectRatio: 16 / 16
  });
};

var recortarImagen = function recortarImagen() {
  if (parseInt(w)) {
    var datos = new FormData($('#frm_login')[0]);
    datos.append('funcion', "pre_recorte_img");
    datos.append('medidas_recorte', 'm' + x + 'm' + y + 'm' + w + 'm' + h);
    var ejecucion = new Consultas("login", datos);
    ejecucion.insercion();
    $("#cerrar_modal").trigger("click");
    var Form = new FormData($('#frm_creacion_alumno')[0]);
    cargar();
    $.ajax({
      type: "POST",
      data: Form,
      url: "model/se/creacion_alumno.model.php",
      processData: false,
      contentType: false,
      success: function success(r) {
        if (r != "Error") {
          $('#img_foto').html("");
          precargar_foto();
          finalizar();
          msj_exito("La foto se ha recortado de manera correcta!");
        } else {
          finalizar();
          msj_error('Se ha producido un error!');
          return false;
        }
      }
    });
  } else {
    msj_error("Si quieres conservar la imagen original oprime el boton 'No recortar' de lo contrario selecciona un area e intenta otra vez.");
  }
};

$('#btn_recorte').click(function () {
  recortarImagen();
});