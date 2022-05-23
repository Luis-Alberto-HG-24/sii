$(document).ready(function () {
    const mostrar_contenido = () =>{
        let datos = new FormData();
        datos.append('funcion','mostrarDatos');

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
                }else if(estado_solicitud == 2){
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
    $('#btn_generar').click(()=>{
        mostrar_contenido();
    });
});