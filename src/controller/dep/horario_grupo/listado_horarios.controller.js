$(document).ready(() => {
    const determinar_dia  = (dia, dia_tabla, hora_inicio, hora_fin, aula)=> {
        return dia == dia_tabla ? `${hora_inicio} - ${hora_fin} <br> ${aula}` : ''; 
    }

    const filtrar_contenido = (filtro)=> {
        cargar();    
        $(`#tabla_horarios`).html(``);  
        $('#table_created_rooms').DataTable().destroy();
        let datos = new FormData();
        if(filtro != 0){
            datos.append('funcion','consulta_filtrada');    
            datos.append('filtro', `${filtro}`)
        }else{
            datos.append('funcion','consultar_horarios');    
        }
            
        fetch(`model/dep/horarios_grupo/listado_horarios.model.php`, {
            method: `POST`,
            body: datos
        }).then(respuesta => respuesta.json())
        .then(respuesta => {
            let tabla = ``;
            respuesta.map(horario => {
                let {id_horario} = horario;
                let {lunes} = horario;
                let {martes} = horario;
                let {miercoles} = horario;
                let {jueves} = horario;
                let {viernes} = horario;
                let {sabado} = horario;
                let {nombre_grupo} = horario;
                let {nombre} = horario;
                let {creditos_totales} = horario;
                tabla += `
                <tr> 
                    <td>${nombre}</td>
                    <td>${creditos_totales}</td>
                    <td>${lunes}</td>
                    <td>${martes}</td>
                    <td>${miercoles}</td>
                    <td>${jueves}</td>
                    <td>${viernes}</td>
                    <td>${sabado}</td>
                    <td>${nombre_grupo}</td>
                    <td><button class="btn btn-primary btn-sm"" title="Editar"><i class="fa-solid fa-eye"></i></button></td>
                </tr>`;
            });
            $(`#tabla_horarios`).html(`${tabla}`);  
            $('#table_created_rooms').DataTable({
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
    filtrar_contenido(0);
    $(`[name=carrera]`).on('change', ()=>{
        filtrar_contenido(($(`[name=carrera]`).val()));
    });
});

const obtener_informacion = (id)=> {
    let datos = new FormData();
    datos.append('funcion', "consultar_horario");
    datos.append('id_horario', `${id}`);
    cargar();
    fetch(`model/dep/horarios_grupo/listado_horarios.model.php`, {
            method: `POST`,
            body: datos
        }).then(respuesta => respuesta.json())
        .then(respuesta => {
            respuesta.map(horario => {
                let {id_horario} = horario;
                let {hora_inicio} = horario;
                let {hora_fin} = horario;
                let {id_cat_aula} = horario;
                let {aula} = horario;
                let {id_grupo} = horario;
                $(`[name=hora_inicio_actual]`).val(hora_inicio);
                $(`[name=hora_fin_actual]`).val(hora_fin);
                $(`[name=aula_actual]`).val(aula);
            })
            finalizado();										
        }).catch(error => {
            finalizado();
            msj_error(`${error}`);
        });
}
