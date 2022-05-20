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
            <ul class="navbar-nav mt-4">
                <div class="d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=Router::redirigir('home')?>"><i class="bi bi-house"></i>
                            Modulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_ciclo"><i
                                class="fas fa-calendar"></i> Ciclo</a>
                    </li>
                </div>
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
                        <li><a class="dropdown-item btn btn-primary" href="#">Action</a></li>
                        <li><a class="dropdown-item btn btn-primary" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
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
            <a href="<?=Router::redirigir('aula')?>" title="Aulas">
                <div class="ico text-center">
                  <i class="fas fa-door-open"></i>
                </div>
                <div class="title">
                    <span>Aula</span>
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
                    <span>cracion de aula</span>
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
            <a href="<?= Router::redirigir('about') ?>" title="Usuario Actual">
                <div class="ico text-center">
                <i class="fa-solid fa-address-card"></i>
                </div>
                <div class="title">
                    <span>Información de Usuario</span>
                </div>

            </a>
        </div>
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
