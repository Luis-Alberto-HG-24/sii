"use strict";

$(document).ready(function () {
  // var tabla = $("#tabla_datos").DataTable({
  //     language: {
  //         "decimal": "",
  //         "emptyTable": "No hay información",
  //         "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
  //         "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
  //         "infoFiltered": "(Filtrado de MAX total entradas)",
  //         "infoPostFix": "",
  //         "thousands": ",",
  //         "lengthMenu": "Mostrar _MENU_ Entradas",
  //         "loadingRecords": "Cargando...",
  //         "processing": "Procesando...",
  //         "search": "Buscar:",
  //         "zeroRecords": "Sin resultados encontrados",
  //         "paginate": {
  //             "first": "Primero",
  //             "last": "Ultimo",
  //             "next": "Siguiente",
  //             "previous": "Anterior"
  //         }
  //     },
  //     "ajax": "./model/acad/model_tabla_solicitud.php",
  //     "columns": [
  //         {"data": "descripcion_solicitud"},
  //         {"data": "solicitud", className : "text-center"},
  //         {"data": "estado_solicitud", 
  //         render: function(data, type, row){
  //             if(row.estado_solicitud == 1){
  //                 return '<span class="text-success">Aprobada</span>';
  //             }else if(row.estado_solicitud == 2){
  //                 return '<span class="text-danger">Rechazada</span>';
  //             }else{
  //                 return '<span class="text-primary">En espera</span>';
  //             }
  //         }},
  //         {"data": "fecha_realizo_solicitud"},
  //         {"data": "fecha_atencion_solicitud", 
  //         render: function(data, type, row){
  //             if(row.fecha_atencion_solicitud == null){
  //                 return '<span class="text-primary">En espera</span>';
  //             } else {
  //                 return row.fecha_atencion_solicitud;
  //             }
  //         }},
  // ]
  // });
  var mostrar_contenido = function mostrar_contenido() {
    var datos = new FormData();
    datos.append('funcion', 'consultar_solicitud');
    fetch("model/acad/aprobar_ctrl.model.php", {
      method: "POST",
      body: datos
    }).then(function (respuesta) {
      return respuesta.json();
    }).then(function (respuesta) {
      var tabla = "";
      respuesta.map(function (aux) {
        var descripcion_solicitud = aux.descripcion_solicitud;
        var solicitud = aux.solicitud;
        var estado_solicitud = aux.estado_solicitud;

        if (estado_solicitud == 1) {
          estado_solicitud = '<span class="text-success">Aprobada</span>';
        } else if (row.estado_solicitud == 2) {
          estado_solicitud = '<span class="text-danger">Rechazada</span>';
        } else {
          estado_solicitud = '<span class="text-primary">En espera</span>';
        }

        var fecha_realizo_solicitud = aux.fecha_realizo_solicitud;
        var fecha_atencion_solicitud = aux.fecha_atencion_solicitud;

        if (fecha_atencion_solicitud == null) {
          fecha_atencion_solicitud = '<span class="text-primary">En espera</span>';
        }

        tabla += "\n                <tr>\n                    <td>".concat(descripcion_solicitud, "</td>\n                    <td>").concat(solicitud, "</td>\n                    <td>").concat(estado_solicitud, "</td>\n                    <td>").concat(fecha_realizo_solicitud, "</td>\n                    <td>").concat(fecha_atencion_solicitud, "</td>\n                </tr>");
      });
      $("#tabla_datos").html("".concat(tabla));
      $("#tabla_solicitud_datos").DataTable({
        "language": {
          "url": "./app/json/lenguaje.json"
        },
        responsive: 'true',
        dom: 'Bfrtip',
        buttons: [{
          extend: 'pdfHtml5',
          text: 'PDF <i class="fa-solid fa-file-pdf"></i>',
          titleAttr: 'Exportar como PDF',
          className: 'btn btn-outline-danger',
          orientation: "landscape",
          title: 'Horarios',
          exportOptions: {
            modifier: {
              page: 'current'
            }
          }
        }]
      });
      finalizado();
    })["catch"](function (error) {
      finalizado();
      msj_error("".concat(error));
    });
  };
});