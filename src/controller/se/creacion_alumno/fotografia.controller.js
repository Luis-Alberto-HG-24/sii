var x, y, w, h;
var ver = 0;

function validar_fotografia(){
    var foto = $('#img_alumno').val();
    var extensiones = /(.jpg|.jpeg)$/i;
    if(!extensiones.exec(foto)){
        $('#img_alumno').val("");
        swal({
            title: "Error!",
            text: "Formato de imagen no valido, solo se admiten archivos con extension '.jpg'",
            icon: "warning",
            button: "Aceptar",
        });
        return false;
    }else {
        var peso = $('#img_alumno')[0].files[0].size;
        if( peso > (2000*1024)){
            $('#img_alumno').val("");
            swal({
                title: "Error!",
                text: "El peso de la imagen no puede ser mayor 2MB!",
                icon: "warning",
                button: "Aceptar",
            });
            return false;
        }else{
            return true;
        }
    }
    
}

function handleFileSelect(evt) {
    if(validar_fotografia()){
        $('#input_file').css("display", "none");
        var archivos = evt.target.files;
        for (var i = 0, archivo; archivo = archivos[i]; i++) {
            if (!archivo.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();

            reader.onload = ((theFile) => {
                return (e) => {
                    var span = '<span class="btn-cancelar"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="thumb rounded" src="'+ e.target.result + '" title="' + escape(theFile.name) +'"/></a><div class="boton-emergente"><button onclick="limpiar_foto()" class="btn btn-img btn-sm" type="button" title="Eliminar"><i class="fas fa-times" style="font-size: 9px; margin-left: -3px"></i></button></div></span>';
                    $('#img_foto').html(span);
                    mostar_area_recorte(e.target.result);
                };
            })(archivo);
            reader.readAsDataURL(archivo);
        }
    }
}
$('#img_alumno').on('change', handleFileSelect);


function limpiar_foto(){
    $('#input_file').css("display","block");
	$('#img_foto').html("");
	$('#img_alumno').val("");
    x = "";
    y = "";
    w = "";
    h = "";
}

function mostar_area_recorte(url){
    //$('#recorte_img').attr('src', url);
    $('#crear').html('<img src="' + url + '" name="recorte_img" id="recorte_img" alt="Foto Alumno"> ');
    recorte();
}

function precargar_foto(){
    ver ++;
    $('#input_file').css("display", "none");
    var span = '<span class="btn-cancelar"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="thumb rounded" src="public/img/se/fotografia.webp?ver='+ ver +'" title="Fotografia alumno"/></a><div class="boton-emergente"><button onclick="limpiar_foto()" class="btn btn-img btn-sm" type="button" title="Eliminar"><i class="fas fa-times" style="font-size: 9px; margin-left: -3px"></></button></div></span>';
    $('#img_foto').html(span);
}

function showCoords(c) {
    x = c.x;
    y = c.y;
    w = c.w;
    h = c.h;
};

function recorte() {
    $('#recorte_img').Jcrop({
        onSelect: showCoords,
        bgColor: 'black',
        bgOpacity: .4,
        aspectRatio: 16 / 16
    });
}

function recortarImagen() {
    if (parseInt(w)) {
        $('#funcion').val("pre_recorte_img");
        $('#medidas_recorte').val('m' + x + 'm' + y + 'm' + w + 'm' + h);
        $("#cerrar_modal").trigger("click");
        var Form = new FormData($('#frm_creacion_alumno')[0]);
        opening();
        $.ajax({
            type: "POST",
            data: Form,
            url: "model/se/model_creacion_alumno_se.php",
            processData: false,
            contentType: false,
            success: (r) => {
                if(r != "Error"){
                    $('#img_foto').html("");
                    precargar_foto();
                    ending();
                    swal({
                        title: "Proceso finalizado!",
                        icon: "success",
                        text: "La foto se ha recortado de manera correcta!",
                    }); 
                }else{
                    ending();
                    swal({
                        title: "Se ha producido un error!",
                        icon: "error",
                        text: "El proceso ha fallado!",
                    }); 
                    return false;
                }
                
            }
        });  
    }else{
        swal({
            title: "Area no selecionada!",
            text: "Si quieres conservar la imagen original oprime el boton 'No recortar' de lo contrario selecciona un area e intenta otra vez.",
            icon: "warning",
            button: "Aceptar",
        });
    }
}

$('#btn_recorte').click(()=>{
    recortarImagen();
});