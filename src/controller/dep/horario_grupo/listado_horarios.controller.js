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
                    <td id="lunes${id_horario}">${lunes}</td>
                    <td id="martes${id_horario}">${martes}</td>
                    <td id="miercoles${id_horario}">${miercoles}</td>
                    <td id="jueves${id_horario}">${jueves}</td>
                    <td id="viernes${id_horario}">${viernes}</td>
                    <td id="sabado${id_horario}">${sabado}</td>
                    <td>${nombre_grupo}</td>
                    <td>
                        <button class="btn btn-outline-success btn-sm"" title="Actualizar" onclick="obtener_informacion(${id_horario})" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-check"></i></button>
                        <button class="btn btn-outline-primary btn-sm"" title="Editar"><i class="fa-solid fa-eye"></i></button>
                    </td>
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

    //funcion para obtener la disponibilidad de un aula en el dia y horario seleccionado
    const obtener_disponibilidad = (aula, dia, hora_inicio, hora_fin, id) => {
        let datos = new FormData();
        datos.append('funcion', "obtener_disponibilidad");
        datos.append('aula',`${aula}`);
        datos.append('dia',`${dia}`);
        datos.append('hora_inicio',`${hora_inicio}`);
        datos.append('hora_fin',`${hora_fin}`);
        datos.append('periodo',`1`);
        cargar();
		fetch(`model/dep/horarios_grupo/horarios_grupo.model.php`, {
				method: `POST`,
				body: datos
			}).then(respuesta => respuesta.json())
			.then(respuesta => {
				finalizado();
				if(respuesta != "1")	{
                    msj_error("El aula seleccionada no esta disponible en el horario ingresado!");
                    $('#aula' + id).val("");                    
                }									
			}).catch(error => {
				finalizado();
				msj_error(`${error}`);
			});
    }
});

const actualizar_hora_final = (inicio, fin) => { 
    inicio = parseInt(inicio) + 1;       
    let opciones = '<option value="">--:--</option>';
    for (let i = inicio; i < (22); i++) {
        if (i < 10) {
            opciones = opciones + '<option value="0' + i + ':00">0' + i + ':00</option>';
        } else {
            opciones = opciones + '<option value="' + i + ':00">' + i + ':00</option>';
        }
    }         
    $('#hora_fin').html(opciones);
    $('#aula').val("");
};

$('#hora_inicio').bind('change', () => {
    actualizar_hora_final($('#hora_inicio').val(), 1);
    //contar_horas_seleccionadas(1);
    $('#aula').val("");
    $('#aula').prop('disabled', true);
});

$('#hora_fin').bind('change', () => {
    //contar_horas_seleccionadas(1);
    $('#aula').val("");
    if($('#hora_fin').val() != ""){
        $('#aula').prop('disabled', false);
    }else{
        $('#aula').val("");
        $('#aula').prop('disabled', true);
    }
});

const obtener_aula = () => {
    let datos = new FormData();
    datos.append('funcion', "consultar_aula");
    const ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
    ejecucion.catalogo(`aula`,'codigo_html');
}

const obtener_informacion = (id)=> {
    obtener_aula();
    $('#hora_inicio').val("");
    actualizar_hora_final($('#hora_inicio').val(), 1);
    $('#hora_fin').val("");
    $('#aula').prop('disabled', true);
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
                $(`[name=id_horario]`).val(id_horario);
            })
            finalizado();										
        }).catch(error => {
            finalizado();
            msj_error(`${error}`);
        });
}


$(`#btn_limpiar`).click(()=> {
    $(`[name=hora_inicio_actual]`).val("");
    $(`[name=hora_fin_actual]`).val("");
    $(`[name=aula_actual]`).val("");   
    $(`#lunes1`).html("");   
});