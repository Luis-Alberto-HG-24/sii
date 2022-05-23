$(document).ready(() => { 
    const obtener_carrera = () => {
        let datos = new FormData();
        datos.append('funcion', "consultar_carrera");
        const ejecucion = new Consultas("dep/horarios_grupo/horarios_grupo", datos);
        ejecucion.catalogo('carrera_origen','codigo_html');
        ejecucion.catalogo('carrera_paralelo','codigo_html');
    }
    obtener_carrera();
});