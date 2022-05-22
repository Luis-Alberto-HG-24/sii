"use strict";

var plan_id = '';
var curp = Array;
var lugar_naciemiento = "";
$('#lugar_naciemiento').change(function () {
  var dt = $(this).val();
  $('#curp').val(dt);
  console.log(dt);
});

var obtener_carrera = function obtener_carrera() {
  var datos = new FormData();
  datos.append('funcion', "consultar_carrera");
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('carrera_reticula', 'codigo_html');
};

var obtener_especialidad = function obtener_especialidad(carrera) {
  var datos = new FormData();
  datos.append('funcion', "consultar_especialidad");
  datos.append('carrera_reticula', "".concat(carrera));
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('especialidad', 'codigo_html');
};

var obtener_tipo_ingreso = function obtener_tipo_ingreso() {
  var datos = new FormData();
  datos.append('funcion', "consultar_ingreso");
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('tipo_ingresos', 'codigo_html');
};

var obtener_plan_estudios = function obtener_plan_estudios(carrera) {
  var datos = new FormData();
  datos.append('funcion', "consultar_plan_estudios");
  datos.append('carrera', "".concat(carrera));
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('plan_estudios', 'valor_input');
  /* $.ajax({
      type: "POST",
      data: "carrera=" + carrera + "&funcion=",
      url: "model/se/model_informacion_cat_dir.php",
      success: (r) => {
          datos_precarga = jQuery.parseJSON(r);
          $('#plan_est').val(datos_precarga['id_cat_plan_estudio']);
      }
  });   */
};

var obtener_nivel_estudios = function obtener_nivel_estudios() {
  var datos = new FormData();
  datos.append('funcion', "consulta_nivel_estudios");
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('nivel_escolar', 'codigo_html');
};

var obtener_estatus_alumno = function obtener_estatus_alumno() {
  var datos = new FormData();
  datos.append('funcion', "consulta_estatus_alumno");
  var ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
  ejecucion.catalogo('estatus_alumno', 'codigo_html');
};

var obtener_estado = function obtener_estado(codigo_postal) {
  $.ajax({
    type: "POST",
    data: "codigo_postal=" + codigo_postal + "&funcion=consultar_estado",
    url: "model/se/model_informacion_cat_dir.php",
    success: function success(r) {
      var opcion_colonia = '';
      datos_precarga = jQuery.parseJSON(r);
      $('#estado').val(datos_precarga['estado']);
      $('#alcaldia').val(datos_precarga['alcaldia']);
      datos_precarga['colonia'].forEach(function (colonia) {
        opcion_colonia += '<option value="' + colonia + '">' + colonia + '</option>';
      });
      $('#colonia').html(opcion_colonia);
    }
  });
};

obtener_carrera();
obtener_tipo_ingreso();
obtener_nivel_estudios();
obtener_estatus_alumno();
$(document).on('keyup', '#codigo_postal', function () {
  var codigo_postal = $('#codigo_postal').val();

  if (codigo_postal != "") {
    obtener_estado(codigo_postal);
  } else {
    obtener_estado("");
  }
});
$('#carrera_reticula').on('change', function () {
  var carrera = $('#carrera_reticula').val();
  obtener_especialidad(carrera);
  obtener_plan_estudios(carrera);
});