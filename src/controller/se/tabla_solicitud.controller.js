$(document).ready(function () {
    var tabla = $("#tabla_datos").DataTable({
        language:{
            "url": "./app/json/lenguaje.json"
        },"ajax": "./model/se/tabla_solicitud.model.php",
        "columns": [
            
            {"data": "descripcion_solicitud"},
            {"data": "solicitud", className: "text-center"},
            {"data": "estado_solicitud", 
            render: function(data, type, row){
                if(row.estado_solicitud == 1){
                    return '<span class="text-success">Aprobada</span>';
                }else if(row.estado_solicitud == 2){
                    return '<span class="text-danger">Rechazada</span>';
                }else{
                    return '<span class="text-primary">En espera</span>';
                }
            }},
            {"data": "fecha_realizo_solicitud"},
            {"data": "fecha_atencion_solicitud", 
            render: function(data, type, row){
                if(row.fecha_atencion_solicitud == null){
                    return '<span class="text-primary">En espera</span>';
                } else {
                    return row.fecha_atencion_solicitud;
                }
            }},
            
    ]
    });
});