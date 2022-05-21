<?php
    define('TITULO_PAGINA', "Code Blue");
    define('SERVIDOR', "http://itma2.sii/");
    define('DEP_CSS', SERVIDOR . "public/css/");
    define('DEP_SCRIPT', SERVIDOR . "public/js/");
    define('DEP_IMG', SERVIDOR . "public/img/");
    define('CONTROLLER', SERVIDOR . "controller/");
    define('LIB_JC', SERVIDOR . "app/lib/JC/");
    
    define('AUDIO', SERVIDOR . "public/files/audio/");
    define('DOC', SERVIDOR . "public/files/doc/");
    define('PDF', SERVIDOR . "public/files/pdf/");
    define('VIDEO', SERVIDOR . "public/files/video/");
    define('EXCEL', SERVIDOR . "public/files/xlsx/");
    
    define("direccion", array(
        
        
        'home' => 'view/home.view',
        'info_personal' => 'view/main/info_personal.view',
        'error' => 'view/error/error404.view',
        'login' => 'view/login/login.view',
        'recuperar_contra' => 'view/login/recup_contra.view',


        // vistas SE
        'se' => 'view/se/se_dashboard.view',
        'ctrl' => 'view/se/creacion_numeros_ctrl.view',
        'alumnos' => 'view/se/creacion_alumnos.view',
        'aprobar_ctrl' => 'view/sa/aprobar_ctrl.view',
        'listado_alumno' => 'view/se/listado_alumno.view',

        // vistas ACAD
        'acad' => 'view/acad/acad_dashboard.view',
        'aprobar_ctrl' => 'view/acad/aprobar_ctrl.view',

       
       
        // vistas ADMIN
        'dashboard' => 'view/admin/admin_dashboard.view',
        'aula' => 'view/admin/aula.view',
        'usuarios' => 'view/admin/usuarios.view',
        'generar_matricula' => 'view/admin/creacion_matricula.view',
        'materias' => 'view/admin/materias.view',
        
        // vistas DEP
        'dep_dashboard' => 'view/dep/dep_dashboard.view',
        'listado_horarios' => 'view/dep/listado_horarios.view',
        'aula_dep' => 'view/dep/aula.view',
        'crear_horario_grupo' => 'view/dep/crear_horario_grupo.view',
        'crear_grupo_paralelo' => 'view/dep/creacion_grupo_paralelo.view'
    ));
?>
