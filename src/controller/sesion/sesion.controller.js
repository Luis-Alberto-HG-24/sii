$(document).ready(()=> {

  const cerrar_sesion = () => {
    let datos = new FormData();
    datos.append('funcion', 'cerrar_sesion');
    const ejecucion = new Consultas("login", datos);
    ejecucion.sesion();
  }

  $('#btn_cerrar_sesion').on('click', (e) => { 
    cerrar_sesion();
	});  

  $('#btn_cerrar_sesion_movil').on('click', (e) => { 
    cerrar_sesion();
	}); 

  const comprobar_inicio_sesion = () => {
    let datos = new FormData();
    datos.append('funcion', 'comprobar_sesion')
		fetch(`model/sesion/login.model.php`, {
				method: `POST`,
				body: datos
			}).then(respuesta => respuesta.json())
			.then(respuesta => {
				finalizado();
				if (respuesta[0] == "0") {
					cerrar_sesion();					
				}
			}).catch(error => {
				finalizado();
				msj_error(`${error}`);
			});
  }
  
  setInterval(() => {
    comprobar_inicio_sesion();;
  }, 4000);
});