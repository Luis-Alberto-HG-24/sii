<?php 
    //session_start();

    class Router {
        static function direccion(){
            $direccion = isset($_GET['view']) ? $_GET['view'] : "home";
            $view = explode("/", $direccion);
            $url = count($view) < 2 ? (array_key_exists($view[0], direccion) ? direccion[$view[0]] : direccion['error']) : direccion['error'];
            require_once $url . '.php';    
            $titulo = !isset($title) ? TITULO_PAGINA : $title;
            echo "<title>".$titulo."</title>";
        }

        static function redirigir($url){
            return SERVIDOR . $url;
        }
    }

    class Redireccion{

        static function redirigir($url){
            echo '<script> window.location="'. $url .'" </script>';
        }

        static function validar_vista($usuario){
            if($usuario != $_SESSION['user']['rol']){
                Self::redirigir("home");
            }
        }
    }
?>