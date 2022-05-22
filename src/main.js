$(document).ready(() => {
	let altura = $('.menu').offset().top;
	$(window).on('scroll', () => {
		if ($(window).scrollTop() > altura) {
			$('.menu').addClass('menu-fixed');
		} else {
			$('.menu').removeClass('menu-fixed');
		}
	});
});

window.onload = () => {
	let carga = document.getElementById('contenedor');
	carga.style.visibility = 'hidden';
	carga.style.opacity = '0';
}

const cargar = () => {
	let carga = document.getElementById('contenedor2');
	carga.style.visibility = 'visible';
	carga.style.opacity = '100';
}

const finalizado = () => {
	let carga = document.getElementById('contenedor2');
	carga.style.visibility = 'hidden';
	carga.style.opacity = '0';
}

const msj_error = (msj) => {
	swal({
		title: `Error!`,
		text: msj,
		icon: `warning`,
		button: `Aceptar`,
	});
}

const msj_exito = (msj) => {
	swal({
		title: `Correcto!`,
		text: msj,
		icon: `success`,
		button: `Aceptar`,
	});
}

const msj_ = (titulo, conty) => {
	swal({
		icon: `success`,
		title: `Credenciales de acceso validas!`,
		html: true,
		text: `\n\n Estas siendo redirigido automaticamente...`,
		closeOnClickOutside: false,
		closeOnEsc: false,
		value: true,
		buttons: false,
		timer: 1500
	}).then((value) => {
		window.location = `home`;
	});
}

const restriccion = {
	"vacios": {
		"expresion": /(?!(^$))/,
		"msj": "No puedes dejar vacio el campo "
	},
	"letras": {
		"expresion": /^([a-zA-Záéíóú]+[\s]?)/i,
		"msj": "Solo puedes ingresar letras en el campo "
	},
	"numeros": {
		"expresion": /^([0-9])+$/,
		"msj": "Solo puedes ingresar numeros en el campo "
	},
	"email": {
		"expresion": /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/,
		"msj": "Estructura de correo no valida! en campo "
	}
};

const caracter = {
	"numeros": {
		"expresion": /[^0-9]/g,
		"msj": "No puedes dejar vacio el campo "
	},
	"letras": {
		"expresion": /^([a-zA-Záéíóú]+[\s]?)/i,
		"msj": "Solo puedes ingresar letras en el campo "
	},
};

/**
 * 
 * @param {string[]||String} input lista de input a validar
 * @param {String[]||String} tipo_validacion nombre de la validacion a realizar
 * @param {String} msj texto que se mostrara en caso de no cumplirse la valicion en caso de no ingresar alguno se generara de manera automatica
 * @returns {boolean} devuelve un false en caso de cumplirse la condicion en alguno de los inputs
 */
const validar_campo = (input, tipo_validacion, mensaje = "") => {
	let resultado = true;
	let error = "";
	let msj_final = "";
	const incorrecto = (nombre, msj) => { error = (error == "") ? nombre : error; msj_final = (msj_final == "") ? msj : msj_final; return false }
	if (Array.isArray(input)) {	
		if(Array.isArray(tipo_validacion)){
			tipo_validacion.map( validacion => {
				let {expresion} = restriccion[`${validacion}`];
				let {msj} = restriccion[`${validacion}`];
				input.map( nombre => { 
					resultado =  expresion.test( $(`[name=${nombre}]`).val() ) ? resultado : incorrecto(nombre, msj);
				});
			});			
		} else {
			const {expresion} = restriccion[`${tipo_validacion}`];
			const {msj} = restriccion[`${tipo_validacion}`];
			input.map( nombre => { 
				resultado =  expresion.test( $(`[name=${nombre}]`).val() ) ? resultado : incorrecto(nombre, msj);
			});
		}	
	} else {
		if(Array.isArray(tipo_validacion)){
			tipo_validacion.map( validacion => {
				let {expresion} = restriccion[`${validacion}`];
				let {msj} = restriccion[`${validacion}`];
				resultado = expresion.test( $(`[name=${input}]`).val() ) ?  resultado : incorrecto(input, msj);
			});			
		}else{
			const {expresion} = restriccion[`${tipo_validacion}`];
			const {msj} = restriccion[`${tipo_validacion}`];
			resultado = expresion.test( $(`[name=${input}]`).val() ) ?  resultado : incorrecto(input, msj);
		}
	}
	error != "" ? msj_error(mensaje != "" ? mensaje :  `${msj_final} ${error}`) : error;
	return resultado;
}
/**
 * 
 * @param {String} input recibe el nombre del input a convertir su contenido a mayusculas 
 */
const caracter_mayus = (input) => {
	$(`[name=${input}]`).on('input', () => {
		$(`[name=${input}]`).val($(`[name=${input}]`).val().toUpperCase());
	});
}
/**
 * 
 * @param {String} input recibe el nombre del input a convertir su contenido a minusculas
 */
const caracter_minus = (input) => {
	$(`[name=${input}]`).on('input', () => {
		$(`[name=${input}]`).val($(`[name=${input}]`).val().toLowerCase());
	});
}
/**
 * 
 * @param {String} input recibe el nombre del input para admitir solo caracteres numericos
 */
const caracter_numeros = (input) => {
	$(`[name=${input}]`).on('input', () => {
		$(`[name=${input}]`).val($(`[name=${input}]`).val().replace(/[^0-9]/g, ''));
	});
}
/**
 * 
 * @param {String} input recibe el nombre del input para admitir solo letras
 */
const caracter_letras = (input) => {
	$(`[name=${input}]`).on('input', () => {
		$(`[name=${input}]`).val($(`[name=${input}]`).val().replace(/([^a-zA-Záéíóú\s])/i, ''));
	});
}

const limitar_valor = (input, inicio, fin, msj) => {
	return $(`[name=${input}]`).val() > inicio && $(`[name=${input}]`).val() < fin ? true : msj_error(msj) ;
}

const funciones = {
	"codigo_html": (input, codigo) =>{
		$(`[name=${input}]`).html(`${codigo}`);
	},
	"valor_input": (input, valor) =>{
		$(`[name=${input}]`).val(`${valor}`);
	},
	"valor_inputs": (input, valor) =>{
		input.map(()=>{
			
		});
	}
	
};


class Consultas {
	/**
	 * @param {String} modelo nombre del modelo al que se le enviaran los datos
	 * @param {FormData} formulario objeto con la informacion del formulario correspondiente
	 * @param {String} tipo de metodo que se usara para el envio de informacion POST o GET por defecto se insertara POST
	 */
	constructor(modelo, formulario, metodo = 'POST') {
		this.modelo = modelo;
		this.formulario = formulario;
		this.metodo = metodo;
	}

	sesion() {
		cargar();
		fetch(`model/sesion/login.model.php`, {
				method: `${this.metodo}`,
				body: this.formulario
			}).then(respuesta => respuesta.json())
			.then(respuesta => {
				finalizado();
				if (respuesta[0] === "1") {
					swal({
						icon: `success`,
						title: `${respuesta[1]}`,
						html: true,
						text: `\n\n Estas siendo redirigido automaticamente...`,
						closeOnClickOutside: false,
						closeOnEsc: false,
						value: true,
						buttons: false,
						timer: 1500
					}).then((value) => {
						window.location = `${respuesta[2]}`;
					});				
				} else if (respuesta[0] === "2") {
					swal({
						icon: `success`,
						title: `${respuesta[1]}`,
						html: true,
						text: `\n\n Estas siendo redirigido automaticamente...`,
						closeOnClickOutside: false,
						closeOnEsc: false,
						value: true,
						buttons: false,
						timer: 1500
					}).then((value) => {
						window.location = `${respuesta[2]}`;
					});				
				}else {
					msj_error(`Se ha producido un error!\n${respuesta[1]}`);
				}
			}).catch(error => {
				finalizado();
				msj_error(`${error}`);
			});
	}
	
	insercion() {
		cargar();
		fetch(`model/${this.modelo}.model.php`, {
				method: `${this.metodo}`,
				body: this.formulario
			}).then(respuesta => respuesta.json())
			.then(respuesta => {
				finalizado();
				console.log(respuesta[0])
				if (respuesta[0] == "1") {
					msj_exito(`Proceso finalizado correctamente!\n${respuesta[1]}`);					
				} else {
					msj_error(`Se ha prensentado un error:\n${respuesta[1]}\nPor favor intentalo de nuevo.`);
				}
			}).catch(error => {
				finalizado();
				msj_error(`${error}`);
			});
	}

	seleccion() {
		let resultado;
		cargar();
		fetch(`model/${this.modelo}.model.php`, {
				method: `${this.metodo}`,
				body: this.formulario
			}).then(respuesta => respuesta.json())
			.then(respuesta => {
				finalizado();
				resultado = respuesta;										
			}).catch(error => {
				finalizado();
				msj_error(`${error}`);
			});
		return resultado;
	}

	catalogo(input, accion) {
		fetch(`model/${this.modelo}.model.php`, {
				method: `${this.metodo}`,
				body: this.formulario
			}).then(respuesta => respuesta.text())
			.then(respuesta => {
				funciones[`${accion}`](input,respuesta);
			}).catch(error => {
				msj_error(`${error}`);
			});
	}
}