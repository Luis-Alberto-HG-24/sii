<?php
  require_once 'model/sesion/sesion.model.php';
  if(Sesion::validar_sesion()):
?>
<!-- nabvar para dispositivos moviles -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary" id="nav-menu">
    <div class="container text-center">
        <a class="navbar-brand text-white" href="<?=Router::redirigir('home')?>"><img loading="lazy"
                src="<?=DEP_IMG?>itma2.png" width="30px" height="30px"> ITMA II</a>
        <button class="navbar-toggler position-relative" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
            <div id="avisar"></div>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mt-4 mb-4">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('home')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                </div>
            </ul>
            <?php if(Sesion::datos_sesion('rol') == 'ADMIN'):?>
            <ul class="navbar-nav mt-2">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('generar_reticula_admin')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-file"></i> Crear Reticula
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('usuarios')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('materias')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-book"></i> Materias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('usuarios')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                    </li>
                </div>
            </ul>
            <?php elseif(Sesion::datos_sesion('rol') == 'DEP'):?>
            <ul class="navbar-nav">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('aula_dep')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-door-open"></i> creacion de aula
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('crear_horario_grupo')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-users"></i> Crear grupos y horarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('listado_horarios')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-user-clock"></i> Listado de horarios y grupos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('crear_grupo_paralelo')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-book-open-reader"></i> Crear grupo paralelo
                        </a>
                    </li>
                </div>
            </ul>
            <?php elseif(Sesion::datos_sesion("rol") == "SE"):?>
        <ul class="navbar-nav">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('ctrl')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-book-open-reader"></i> Creación de número de control
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('alumnos')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-book-open-reader"></i> Creación de alumnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('listado_alumno')?>"><i class="bi bi-house"></i>
                                <i class="fas fa-book-open-reader"></i> Listado de alumnos
                        </a>
                    </li>
                </div>
            </ul>
            <?php elseif(Sesion::datos_sesion("rol") == "ACAD"):?>
            <ul class="navbar-nav">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('aprobar_ctrl')?>"><i class="bi bi-house"></i>
                            <i class="fas fa-check-double"></i> Aprobar Numeros de Control
                        </a>
                    </li>
                </div>
            </ul>
            <?php endif?>
            <ul class="navbar-nav mt-4">
                <li class="nav-item">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_ciclo">
                        <i class="fas fa-calendar"></i> Ciclo
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-primary position-relative" data-bs-toggle="modal"
                        data-bs-target="#modal_notificaciones" href="#" title="Notificaciones">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="noti_responsive"></span>
                        <i class="fas fa-bell"></i> Notificaciones
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user ml-1"></i> <?=Sesion::datos_sesion("correo_usuario")?>
                    </a>
                    <ul class="dropdown-menu bg-primary text-white text-center" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item btn btn-primary" href="<?= Router::redirigir('about')?>"><i class="fa-solid fa-user-gear"></i> Perfil</a></li>
                        <li>
                            <button type="button" class="dropdown-item btn btn-primary" id="btn_cerrar_sesion_movil"><i
                                    class="fas fa-power-off text-danger"></i> Cerrar Sesion
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- sidemenu para computadoras -->
<div id="sidemenu" class="menu-collapsed">
    <div id="header">
        <div id="title">SII</div>
        <div class="text-center" id="menu-btn">
            <i class="fas fa-bars text-white"></i>
        </div>
    </div>
    <div id="profile">
        <div class="text-center" id="photo">
            <a href="<?=Router::redirigir('home')?>"><img src="<?=DEP_IMG?>itma2.png" alt="Logo Itma II"
                    title="Inicio"></a>
        </div>
        <div class="text-center" id="name">
            <div>
                <span><?=Sesion::datos_sesion("correo_usuario")?></span>
                <br>
                <span><?=Sesion::datos_sesion("rol")?></span>
            </div>
        </div>
    </div>
    <div id="menu-items">
        <?php if(Sesion::datos_sesion('rol') == 'ADMIN'):?>
        <div class="item">
            <a href="<?=Router::redirigir('dashboard')?>" title="Dashboard">
                <div class="ico text-center">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="title">
                    <span>Dashboard</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('generar_reticula_admin')?>" title="Usuarios">
                <div class="ico text-center">
                  <i class="fas fa-file"></i>
                </div>
                <div class="title">
                    <span>Crear Reticula</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('usuarios')?>" title="Usuarios">
                <div class="ico text-center">
                  <i class="fas fa-users"></i>
                </div>
                <div class="title">
                    <span>Usuarios</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('materias')?>" title="Materias">
                <div class="ico text-center">
                  <i class="fas fa-book"></i>
                </div>
                <div class="title">
                    <span>Materias</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('crear_aula_admin')?>" title="Aulas">
                <div class="ico text-center">
                  <i class="fas fa-door-open"></i>
                </div>
                <div class="title">
                    <span>Crear Aula</span>
                </div>
            </a>
        </div>
        <?php elseif(Sesion::datos_sesion('rol') == 'DEP'):?>
        <div class="item">
            <a href="<?=Router::redirigir('home')?>" title="Dashboard">
                <div class="ico text-center">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="title">
                    <span>Dashboard</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('aula_dep')?>" title="Crear Aula">
                <div class="ico text-center">
                  <i class="fas fa-door-open"></i>
                </div>
                <div class="title">
                    <span>creacion de aula</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('crear_horario_grupo')?>" title="Crear Horarios y grupos">
                <div class="ico text-center">
                  <i class="fas fa-users"></i>
                </div>
                <div class="title">
                    <span>Crear grupos y horarios</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('listado_horarios')?>" title="Listado de horarios y grupos">
                <div class="ico text-center">
                  <i class="fas fa-user-clock"></i>
                </div>
                <div class="title">
                    <span>Listado de horarios y grupos</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('crear_grupo_paralelo')?>" title="Crear grupo paralelo">
                <div class="ico text-center">
                  <i class="fas fa-book-open-reader"></i>
                </div>
                <div class="title">
                    <span>Crear grupo paralelo</span>
                </div>
            </a>
        </div>
        <?php elseif(Sesion::datos_sesion("rol") == "SE"):?>
        <div class="item">
            <a href="<?=Router::redirigir('dashboard')?>" title="Dashboard">
                <div class="ico text-center">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="title">
                    <span>Dashboard</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('ctrl')?>" title="Creación de número de control">
                <div class="ico text-center">
                    <i class="fas fa-digital-tachograph"></i>
                </div>
                <div class="title">
                    <span>Creación de número de control</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('alumnos')?>" title="Creación de alumnos">
                <div class="ico text-center">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="title">
                    <span>Creación de alumnos</span>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="<?=Router::redirigir('listado_alumno')?>" title="Listado de alumnos">
                <div class="ico text-center">
                    <i class="far fa-list-alt"></i>
                </div>
                <div class="title">
                    <span>Listado de alumnos</span>
                </div>
            </a>
        </div>
        <?php elseif(Sesion::datos_sesion("rol") == "ACAD"):?>
        <div class="item">
            <a href="<?=Router::redirigir('aprobar_ctrl')?>" title="Aprobar Numeros de Control">
                <div class="ico text-center">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="title">
                    <span>Aprobar Numeros de Control</span>
                </div>
            </a>
        </div>
        <?php endif ?>
        <div class="item">
            <a data-bs-toggle="modal" data-bs-target="#modal_ciclo">
                <div class="ico text-center">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="title">
                    <span>Ciclo</span>
                </div>
            </a>
        </div>

        <div class="item">
            <a data-bs-toggle="modal" data-bs-target="#modal_notificaciones">
                <div class="ico text-center">
                    <i class="fas fa-bell"></i><span class="badge rounded-pill badge-notification bg-danger"
                        id="noti"></span>
                </div>
                <div class="title">
                    <span>Notificaciones</span>
                </div>
            </a>
        </div>

        <div class="item">
            <?=Sesion::obtener_sesion()?>
        </div>
    </div>
</div>
<?php 
  require_once 'view/main/ciclo.modal.php';
  require_once 'view/main/notificaciones.modal.php';
?>
<script src="<?=CONTROLLER?>navbar/navbar.controller.js"></script>
<?php endif;?>
