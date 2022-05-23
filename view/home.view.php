<?php
    if (!Sesion::validar_sesion()){
		Redireccion::redirigir("login");
	}
    $usuario = strtolower(Sesion::datos_sesion("rol"));
    require_once 'view/'.$usuario.'/'.$usuario.'_dashboard.view.php'; 
?>