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


    const mostrar_contenido = () =>{
        let datos = new FormData();
        datos.append('funcion','consultar_solicitud');

        fetch(`model/acad/aprobar_ctrl.model.php`,{
            method: `POST`,
            body: datos
        }).then(respuesta => respuesta.json())
        .then(respuesta =>{
            let tabla = ``;
            respuesta.map(aux =>{

                let {descripcion_solicitud} = aux;
                let {solicitud} = aux;
                let {estado_solicitud} = aux;

                if(estado_solicitud == 1){
                    estado_solicitud = '<span class="text-success">Aprobada</span>';
                }else if(row.estado_solicitud == 2){
                    estado_solicitud = '<span class="text-danger">Rechazada</span>';
                }else{
                    estado_solicitud = '<span class="text-primary">En espera</span>';
                }

                let {fecha_realizo_solicitud} = aux;
                let {fecha_atencion_solicitud} = aux;

                if(fecha_atencion_solicitud == null){
                    fecha_atencion_solicitud =  '<span class="text-primary">En espera</span>';
                }


                tabla+= `
                <tr>
                    <td>${descripcion_solicitud}</td>
                    <td>${solicitud}</td>
                    <td>${estado_solicitud}</td>
                    <td>${fecha_realizo_solicitud}</td>
                    <td>${fecha_atencion_solicitud}</td>
                </tr>`;
            });
            $(`#tabla_datos`).html(`${tabla}`);
            $(`#tabla_solicitud_datos`).DataTable({
                "language": {
                    "url": "./app/json/lenguaje.json"
                },
                responsive: 'true',
                dom: 'Bfrtip',
                buttons: [
                    {
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
                    },
                ]
            });
            finalizado();
        }).catch(error => {
            finalizado();
            msj_error(`${error}`);
        });
    }
});