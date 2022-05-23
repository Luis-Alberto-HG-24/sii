let plan_id = '';
let curp = Array;
let lugar_naciemiento = "";

$('#lugar_naciemiento').change(function() {
    var dt = $(this).val();
    $('#curp').val(dt);
    console.log(dt);
});


const obtener_carrera = ()=> {  
    let datos = new FormData();
    datos.append('funcion', "consultar_carrera");
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('carrera_reticula','codigo_html');
}

const obtener_especialidad = (carrera) => {  
    let datos = new FormData();
    datos.append('funcion', "consultar_especialidad");
    datos.append('carrera_reticula', `${carrera}`);
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('especialidad','codigo_html');  
}

const obtener_tipo_ingreso = ()=> {  
    let datos = new FormData();
    datos.append('funcion', "consultar_ingreso");
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('tipo_ingresos','codigo_html');  
}

const obtener_plan_estudios = (carrera) => {  
    let datos = new FormData();
    datos.append('funcion', "consultar_plan_estudios");
    datos.append('carrera', `${carrera}`);
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('plan_estudios','valor_input');    
    /* $.ajax({
        type: "POST",
        data: "carrera=" + carrera + "&funcion=",
        url: "model/se/model_informacion_cat_dir.php",
        success: (r) => {
            datos_precarga = jQuery.parseJSON(r);
            $('#plan_est').val(datos_precarga['id_cat_plan_estudio']);
        }
    });   */
}

const obtener_nivel_estudios = ()=> {    
    let datos = new FormData();
    datos.append('funcion', "consulta_nivel_estudios");
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('nivel_escolar','codigo_html');
}

const obtener_estatus_alumno = ()=> {    
    let datos = new FormData();
    datos.append('funcion', "consulta_estatus_alumno");
    const ejecucion = new Consultas("se/creacion_alumno/informacion_catalogo", datos);
    ejecucion.catalogo('estatus_alumno','codigo_html');
}

const obtener_estado = (codigo_postal)=>{    
    $.ajax({
        type: "POST",
        data: "codigo_postal=" + codigo_postal + "&funcion=consultar_estado",
        url: "model/se/model_informacion_cat_dir.php",
        success: (r) => {
            var opcion_colonia = '';
            datos_precarga = jQuery.parseJSON(r);
            $('#estado').val(datos_precarga['estado']);
            $('#alcaldia').val(datos_precarga['alcaldia']);

            datos_precarga['colonia'].forEach((colonia)=> {
                opcion_colonia += '<option value="' + colonia + '">' + colonia + '</option>';
            });
            $('#colonia').html(opcion_colonia);
        }
    });  
}

obtener_carrera();
obtener_tipo_ingreso();
obtener_nivel_estudios();
obtener_estatus_alumno();

$(document).on('keyup', '#codigo_postal', ()=> {
    let codigo_postal= $('#codigo_postal').val();
    if(codigo_postal != ""){
        obtener_estado(codigo_postal);
    }else{
        obtener_estado("");
    }
});

$('#carrera_reticula').on('change', () => {
    let carrera = $('#carrera_reticula').val();
    obtener_especialidad(carrera);
    obtener_plan_estudios(carrera);
});