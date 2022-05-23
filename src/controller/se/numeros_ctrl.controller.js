const inputRange = () => {
    $("#rango_matriculas").val($("#num_matriculas").val());
}

const range = () => {
    $("#num_matriculas").val($("#rango_matriculas").val());
}

$(document).ready(() => {
    const valorInicial = 50; //Valor por defecto de matriculas
    $("#num_matriculas").val(valorInicial);
    $("#rango_matriculas").val(valorInicial);
    caracter_numeros("num_matriculas");//limita los caracteres a solo numeros

    const status_solicitud = ()=> { //funcion para cambiar el estatus de la solicitud
        if($("#id_solicitud").val() != 0){
            if($("#estado_solicitud").val() == 0){
                $("#alerta").remove()
                $("#status_solicitud").append(
                    `<div id="alerta" class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-clock"></i> Pendiente</h4>
                        <p>Tu solicitud de numeros de control fue enviada.</p>
                        <hr>
                        <p class="mb-0">Espera la aprobacion para generar una nueva solicitud.</p>
                    </div>`
                );
                $("#enviar_solicitud").attr("disabled", true);
            } else {
                $("#alerta").remove()
                $("#status_solicitud").append(
                    `<div id="alerta" class="alert alert-secondary" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-envelope-open-text"></i> Sin Enviar</h4>
                        <p>No tienes solicitudes de numeros de control enviadas.</p>
                        <hr>
                        <p class="mb-0">Para generar una nueva solicitud de numeros de control selecciona un rango de matriculas y da click en "Enviar solicitud"</p>
                    </div>
                `)
            }
        } else {
            $("#alerta").remove()
            $("#status_solicitud").append(
                `<div id="alerta" class="alert alert-secondary" role="alert">
                    <h4 class="alert-heading"><i class="fas fa-envelope-open-text"></i> Sin Enviar</h4>
                    <p>No tienes solicitudes de numeros de control enviadas.</p>
                    <hr>
                    <p class="mb-0">Para generar una nueva solicitud de numeros de control selecciona un rango de matriculas y da click en "Enviar solicitud"</p>
                </div>`
            );
        }
    }
    
    const consultar_estado_solicitud = ()=> {// funcion para consultar el estado de la solicitud actual
        cargar();
        let datos = new FormData($('#frm_num_ctrl')[0]);
        datos.append('funcion', "consultar_estado_solicitud");
        fetch(`model/se/num_ctrl.model.php`, {
            method: `post`,
            body: datos
        }).then(respuesta => respuesta.json())
        .then(respuesta => {
            finalizado();
            $("#estado_solicitud").val(respuesta.estado_solicitud);
            $("#id_solicitud").val(respuesta.id_solicitud);
            status_solicitud();										
        }).catch(error => {
            finalizado();
            msj_error(`${error}`);
        });
    }

    const enviar_solicitud = ()=> { //funcion para enviar solicitud
        let datos = new FormData($('#frm_num_ctrl')[0]);
        datos.append('funcion', "enviar_solicitud");
        const ejecucion = new Consultas("se/num_ctrl", datos);
        ejecucion.insercion();
        consultar_estado_solicitud();
        $('#tabla_datos').DataTable().ajax.reload();        
    }

    const validar = ()=> {  //funcion para validar el input de numeros de control
        if(validar_campo(["num_matriculas"],"numeros")){
           
        } 
        
        if(limitar_valor("num_matriculas", 1, 200, "Solo puedes ingresar números entre 1 y 200")){

        } else {
            enviar_solicitud();
        }
    }  

    const cancelar_solicitud = ()=> { //funcion para cancelar y eliminar la solicitud actual
        swal({
            title: "¿Estas seguro de cancelar la solicitud?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                opening();
                let datos = new FormData($('#frm_num_ctrl')[0]);
                datos.append('funcion', "cancelar_solicitud");
                const ejecucion = new Consultas("se/num_ctrl", datos);
                ejecucion.insercion();
                consultar_estado_solicitud();
                $('#tabla_datos').DataTable().ajax.reload();
            } else {
                swal("¡La solicitud sigue activa!");
            }
        });
    }
    consultar_estado_solicitud();
    $("#enviar_solicitud").click( ()=>{
        validar();
    });

    $("#cancelar_solicitud").click(() => {
        $("#funcion").val("cancelar_solicitud");
        cancelar_solicitud();
    });
});