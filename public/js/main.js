"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

$(document).ready(function () {
  var altura = $('.menu').offset().top;
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > altura) {
      $('.menu').addClass('menu-fixed');
    } else {
      $('.menu').removeClass('menu-fixed');
    }
  });
});

window.onload = function () {
  var carga = document.getElementById('contenedor');
  carga.style.visibility = 'hidden';
  carga.style.opacity = '0';
};

var cargar = function cargar() {
  var carga = document.getElementById('contenedor2');
  carga.style.visibility = 'visible';
  carga.style.opacity = '100';
};

var finalizado = function finalizado() {
  var carga = document.getElementById('contenedor2');
  carga.style.visibility = 'hidden';
  carga.style.opacity = '0';
};

var msj_error = function msj_error(msj) {
  swal({
    title: "Error!",
    text: msj,
    icon: "warning",
    button: "Aceptar"
  });
};

var msj_exito = function msj_exito(msj) {
  swal({
    title: "Correcto!",
    text: msj,
    icon: "success",
    button: "Aceptar"
  });
};

var msj_ = function msj_(titulo, conty) {
  swal({
    icon: "success",
    title: "Credenciales de acceso validas!",
    html: true,
    text: "\n\n Estas siendo redirigido automaticamente...",
    closeOnClickOutside: false,
    closeOnEsc: false,
    value: true,
    buttons: false,
    timer: 1500
  }).then(function (value) {
    window.location = "home";
  });
};

var restriccion = {
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
var caracter = {
  "numeros": {
    "expresion": /[^0-9]/g,
    "msj": "No puedes dejar vacio el campo "
  },
  "letras": {
    "expresion": /^([a-zA-Záéíóú]+[\s]?)/i,
    "msj": "Solo puedes ingresar letras en el campo "
  }
};
/**
 * 
 * @param {string[]||String} input lista de input a validar
 * @param {String[]||String} tipo_validacion nombre de la validacion a realizar
 * @param {String} msj texto que se mostrara en caso de no cumplirse la valicion en caso de no ingresar alguno se generara de manera automatica
 * @returns {boolean} devuelve un false en caso de cumplirse la condicion en alguno de los inputs
 */

var validar_campo = function validar_campo(input, tipo_validacion) {
  var mensaje = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "";
  var resultado = true;
  var error = "";
  var msj_final = "";

  var incorrecto = function incorrecto(nombre, msj) {
    error = error == "" ? nombre : error;
    msj_final = msj_final == "" ? msj : msj_final;
    return false;
  };

  if (Array.isArray(input)) {
    if (Array.isArray(tipo_validacion)) {
      tipo_validacion.map(function (validacion) {
        var expresion = restriccion["".concat(validacion)].expresion;
        var msj = restriccion["".concat(validacion)].msj;
        input.map(function (nombre) {
          resultado = expresion.test($("[name=".concat(nombre, "]")).val()) ? resultado : incorrecto(nombre, msj);
        });
      });
    } else {
      var expresion = restriccion["".concat(tipo_validacion)].expresion;
      var msj = restriccion["".concat(tipo_validacion)].msj;
      input.map(function (nombre) {
        resultado = expresion.test($("[name=".concat(nombre, "]")).val()) ? resultado : incorrecto(nombre, msj);
      });
    }
  } else {
    if (Array.isArray(tipo_validacion)) {
      tipo_validacion.map(function (validacion) {
        var expresion = restriccion["".concat(validacion)].expresion;
        var msj = restriccion["".concat(validacion)].msj;
        resultado = expresion.test($("[name=".concat(input, "]")).val()) ? resultado : incorrecto(input, msj);
      });
    } else {
      var _expresion = restriccion["".concat(tipo_validacion)].expresion;
      var _msj = restriccion["".concat(tipo_validacion)].msj;
      resultado = _expresion.test($("[name=".concat(input, "]")).val()) ? resultado : incorrecto(input, _msj);
    }
  }

  error != "" ? msj_error(mensaje != "" ? mensaje : "".concat(msj_final, " ").concat(error)) : error;
  return resultado;
};
/**
 * 
 * @param {String} input recibe el nombre del input a convertir su contenido a mayusculas 
 */


var caracter_mayus = function caracter_mayus(input) {
  $("[name=".concat(input, "]")).on('input', function () {
    $("[name=".concat(input, "]")).val($("[name=".concat(input, "]")).val().toUpperCase());
  });
};
/**
 * 
 * @param {String} input recibe el nombre del input a convertir su contenido a minusculas
 */


var caracter_minus = function caracter_minus(input) {
  $("[name=".concat(input, "]")).on('input', function () {
    $("[name=".concat(input, "]")).val($("[name=".concat(input, "]")).val().toLowerCase());
  });
};
/**
 * 
 * @param {String} input recibe el nombre del input para admitir solo caracteres numericos
 */


var caracter_numeros = function caracter_numeros(input) {
  $("[name=".concat(input, "]")).on('input', function () {
    $("[name=".concat(input, "]")).val($("[name=".concat(input, "]")).val().replace(/[^0-9]/g, ''));
  });
};
/**
 * 
 * @param {String} input recibe el nombre del input para admitir solo letras
 */


var caracter_letras = function caracter_letras(input) {
  $("[name=".concat(input, "]")).on('input', function () {
    $("[name=".concat(input, "]")).val($("[name=".concat(input, "]")).val().replace(/([^a-zA-Záéíóú\s])/i, ''));
  });
};

var limitar_valor = function limitar_valor(input, inicio, fin, msj) {
  return $("[name=".concat(input, "]")).val() > inicio && $("[name=".concat(input, "]")).val() < fin ? true : msj_error(msj);
};

var funciones = {
  "codigo_html": function codigo_html(input, codigo) {
    $("[name=".concat(input, "]")).html("".concat(codigo));
  },
  "valor_input": function valor_input(input, valor) {
    $("[name=".concat(input, "]")).val("".concat(valor));
  },
  "valor_inputs": function valor_inputs(input, valor) {
    input.map(function () {});
  }
};

var Consultas = /*#__PURE__*/function () {
  /**
   * @param {String} modelo nombre del modelo al que se le enviaran los datos
   * @param {FormData} formulario objeto con la informacion del formulario correspondiente
   * @param {String} tipo de metodo que se usara para el envio de informacion POST o GET por defecto se insertara POST
   */
  function Consultas(modelo, formulario) {
    var metodo = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'POST';

    _classCallCheck(this, Consultas);

    this.modelo = modelo;
    this.formulario = formulario;
    this.metodo = metodo;
  }

  _createClass(Consultas, [{
    key: "sesion",
    value: function sesion() {
      cargar();
      fetch("model/sesion/login.model.php", {
        method: "".concat(this.metodo),
        body: this.formulario
      }).then(function (respuesta) {
        return respuesta.json();
      }).then(function (respuesta) {
        finalizado();

        if (respuesta[0] === "1") {
          swal({
            icon: "success",
            title: "".concat(respuesta[1]),
            html: true,
            text: "\n\n Estas siendo redirigido automaticamente...",
            closeOnClickOutside: false,
            closeOnEsc: false,
            value: true,
            buttons: false,
            timer: 1500
          }).then(function (value) {
            window.location = "".concat(respuesta[2]);
          });
        } else if (respuesta[0] === "2") {
          swal({
            icon: "success",
            title: "".concat(respuesta[1]),
            html: true,
            text: "\n\n Estas siendo redirigido automaticamente...",
            closeOnClickOutside: false,
            closeOnEsc: false,
            value: true,
            buttons: false,
            timer: 1500
          }).then(function (value) {
            window.location = "".concat(respuesta[2]);
          });
        } else {
          msj_error("Se ha producido un error!\n".concat(respuesta[1]));
        }
      })["catch"](function (error) {
        finalizado();
        msj_error("".concat(error));
      });
    }
  }, {
    key: "insercion",
    value: function insercion() {
      cargar();
      fetch("model/".concat(this.modelo, ".model.php"), {
        method: "".concat(this.metodo),
        body: this.formulario
      }).then(function (respuesta) {
        return respuesta.json();
      }).then(function (respuesta) {
        finalizado();
        console.log(respuesta[0]);

        if (respuesta[0] == "1") {
          msj_exito("Proceso finalizado correctamente!\n".concat(respuesta[1]));
        } else {
          msj_error("Se ha prensentado un error:\n".concat(respuesta[1], "\nPor favor intentalo de nuevo."));
        }
      })["catch"](function (error) {
        finalizado();
        msj_error("".concat(error));
      });
    }
  }, {
    key: "seleccion",
    value: function seleccion() {
      var resultado;
      cargar();
      fetch("model/".concat(this.modelo, ".model.php"), {
        method: "".concat(this.metodo),
        body: this.formulario
      }).then(function (respuesta) {
        return respuesta.json();
      }).then(function (respuesta) {
        finalizado();
        resultado = respuesta;
      })["catch"](function (error) {
        finalizado();
        msj_error("".concat(error));
      });
      return resultado;
    }
  }, {
    key: "catalogo",
    value: function catalogo(input, accion) {
      fetch("model/".concat(this.modelo, ".model.php"), {
        method: "".concat(this.metodo),
        body: this.formulario
      }).then(function (respuesta) {
        return respuesta.text();
      }).then(function (respuesta) {
        funciones["".concat(accion)](input, respuesta);
      })["catch"](function (error) {
        msj_error("".concat(error));
      });
    }
  }]);

  return Consultas;
}();