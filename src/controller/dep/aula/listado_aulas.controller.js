var tabla = $('#table_created_rooms').DataTable({
    "language": {
        "url": "./app/json/lenguaje.json"
    },"ajax":'./model/admin/aula/model_lista_aula.php',
    "columns": [
        {"data": "aula", className: "text-center"},
        {"data": "capacidad", className: "text-center"},
        {"data": "ubicacion", className: "text-center"},
        {"data": "estatus_aula", className: "text-center"},
        {"data": "observaciones", className: "text-center"},
        {"data": "btnEditar", className: "text-center"},
        {"data": "btnEliminar", className: "text-center"}
    ]
});


