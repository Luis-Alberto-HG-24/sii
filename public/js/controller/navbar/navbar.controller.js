"use strict";

// Verifica la altura del dispositivo, si es mayor a 1024px se fija el footer.
var elementosResposivos = function elementosResposivos() {
  // Verifica el ancho del dispositivo, para poder ocultar y mostrar el nav-menu y sidemenu.
  if ($(window).width() < 768) {
    var root = document.documentElement.style.setProperty("--width-collapsed", "0px");
    $("#sidemenu").hide();
    $("#nav-menu").show();
    $("body").removeClass("body-expanded");
  } else {
    var _root = document.documentElement.style.setProperty("--width-collapsed", "50px");

    $("#nav-menu").hide();
    $("#sidemenu").show(); //Comprobar si el menu lateral tiene el valor de expanded para otorgarlo al body

    if ($("#sidemenu").hasClass("menu-expanded")) {
      $("body").addClass("body-expanded");
    }
  }
};

$(document).ready(function () {
  elementosResposivos(); // Evento click encargado de expandir y contraer el sidemenu.

  $("#menu-btn").click(function () {
    $("#sidemenu").toggleClass("menu-expanded");
    $("#sidemenu").toggleClass("menu-collapsed");
    $("body").toggleClass("body-expanded");
  }); // Evento encargado de realizar acciones al reajustar el navegador.

  $(window).resize(function () {
    elementosResposivos();
  }); // Se encarga de fijar el nav-menu al momento de hacer scroll.

  var altura = $("#nav-menu").offset().top;
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > altura) {
      $("#nav-menu").addClass("menu-fixed");
    } else {
      $("#nav-menu").removeClass("menu-fixed");
    }
  });
});