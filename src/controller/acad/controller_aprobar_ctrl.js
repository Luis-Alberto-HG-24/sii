$(document).ready(() => {
    var numeroControl = [];
    var ultimoNumero, anioCtrl;

    function consultar_solicitud(){ //funcion para consultar la solicitud de numeros de control
        let obj;
        $("#funcion").val("consultar_solicitud");
        $.ajax({
            type: "POST",
            data: $("#frm_aprobar_ctrl").serialize(),
            url: "model/acad/model_aprobar_ctrl.php",
            success: (r) => {
                obj = JSON.parse(r);
                $("#num_matriculas").val(obj.solicitud);
                $("#id_solicitud").val(obj.id_solicitud);
                status_botones();
            }
        });
    }

    function status_botones(){ //funcion para cambiar el estatus de los botones si no hay una solicitud o si ya se aprobo
        if($("#num_matriculas").val() == ""){
            $("#btn_generar").attr("disabled", true);
            $("#btn_aprobar").attr("disabled", true);
            $("#btn_rechazar").attr("disabled", true);
            $("#num_matriculas").attr("placeholder", "No tienes solicitudes");
        } else {
            $("#btn_generar").removeAttr("disabled");
            $("#btn_aprobar").removeAttr("disabled");
            $("#btn_rechazar").removeAttr("disabled");
        }
    }

    function consultar_numeros(){ //funcion para consultar los numeros de control
        $("#funcion").val("consultar_numero_ctrl");
        $.ajax({
            type: "POST",
            data: $("#frm_aprobar_ctrl").serialize(),
            url: "model/acad/model_aprobar_ctrl.php",
            success: (r) => {
                
                ultimoNumero = r;
                
                $("#num_ctrl").val(ultimoNumero);
                
                console.log($("#num_ctrl").val());
                
            }
        });
    }

    function crear_numeros(){ //funcion para generar los numeros de control y mostrarlos en la tabla (esto solo es visual, los numeros reales se generan en php)
        let fecha = new Date();
        let num = $("#num_matriculas").val();
        ultimoNumero ++;
        for(let i = 0; i < num; i++){
            $("#tabla_num_ctrl tbody").append(`<tr><th scope="row">${ultimoNumero}</th><td>${fecha.getDate()}-${fecha.getMonth()+1}-${fecha.getFullYear()}</td></tr>`);
            ultimoNumero++;
        }
    }

    function enviar_numeros(){ //esta funcion aprueba la solicitud y envia la cantidad de numeros que necesitamos al modelo
        $("#funcion").val("generar_num_ctrl");
        opening();
        $.ajax({
            type: "POST",
            data: $("#frm_aprobar_ctrl").serialize(),
            url: "model/acad/model_aprobar_ctrl.php",
            success: (r) => {
                if(r == "1"){
                    ending();
                    swal({
                        title: "La solicitud se ha aprobado!",
                        icon: "success",
                        buttons: true,
                    }).then(()=>{
                        consultar_solicitud();
                        $('#tabla_datos').DataTable().ajax.reload();
                    });
                    
                } else {
                    ending();
                    swal({
                        title: "La solicitud no se pudo aprobar!",
                        icon: "error",
                        buttons: true,
                    })
                }
                
                console.log(r);
            }
        });
    }

    function rechazar_numeros(){ //funcion para rechazar la solicitud 
        $("#funcion").val("rechazar_solicitud");
        swal({
            title: "¿Estas seguro de rechazar la solicitud?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                opening();
                $.ajax({
                    type: 'POST',
                    data: $("#frm_aprobar_ctrl").serialize(),
                    url: 'model/acad/model_aprobar_ctrl.php',
                    success: (r) => {
                        if(r == "1"){
                            ending();
                            swal({
                                    title: "La solicitud ha sido rechazada!",
                                    icon: "success",
                                }).then(()=>{
                                    consultar_solicitud();
                                    $('#tabla_datos').DataTable().ajax.reload();;
                                });
                        } else {
                            ending();
                            swal({
                                title: "Error al rechazar la solicitud!",
                                icon: "error",
                                text: "Por favor contacte al administrador",
                                }); 
                            return false;
                        }
                    }
                });
            } else {
                swal("¡La solicitud sigue activa!");
            }
        });
    }
    consultar_solicitud();

    consultar_numeros();

    $("#btn_generar").click( ()=>{
        crear_numeros();
    });

    $("#btn_aprobar").click( ()=>{
        enviar_numeros();
    });

    $("#btn_rechazar").click(() => {
        rechazar_numeros();
    })
})