$(document).ready(()=> {
  $('#btn_cerrar_sesion').on('click', (e) => { 
    let datos = new FormData();
    datos.append('funcion', 'cerrar_sesion')
    const ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
	});  

  $('#btn_cerrar_sesion_movil').on('click', (e) => { 
    let datos = new FormData();
    datos.append('funcion', 'cerrar_sesion')
    const ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
	}); 
});