<?php 
	$title = 'RECUPERACION DE CUENTA'; 
	if (Sesion::validar_sesion()){
		Redireccion::redirigir("home");
	}
?>
<div class="container h-100 py-5">
    <div class="row justify-content-around">
        <div class="col-lg-4 col-md-6 col-sm-8 col-10 neumorph-card p-5">
            <div class="text-center">
                <img class="mb-2" src="<?=DEP_IMG?>itma2.png" width="50%">
            </div>
            <form id="frm_recu_contra" class="form-grup mb-3 ml-3 mr-3" method="POST">
                <input type="text" id="funcion" name="funcion" value="seleccionar_email" hidden>
                <p class="text-center fs-6 text-muted fs-md-1">Ingresa tu correo Institucional y te enviaremos las instrucciones
                    para que recuperes el acceso a tu cuenta.</p>
                <label class="mb-2 ms-2 text-primary" for=""><b>Correo Institucional</b></label>
                <div class="input-group mb-4 custom-shadow">
                    <span class="input-group-text bg-light"><i class="fas fa-user-alt"></i></span>
                    <input type="text" class="form-control border-start-0 text-primary" name="correo_usuario" id="correo_usuario" required placeholder="ejemplo@milpaalta2.tecnm.mx">
                </div>
                <label class="mb-2 ms-2 text-primary" for=""><b>Correo Personal</b></label>
                <div class="input-group mb-4 custom-shadow">
                    <span class="input-group-text bg-light"><i class="fas fa-at"></i></span>
                    <input type="text" class="form-control border-start-0 text-primary" name="correo" id="correo" required placeholder="ejemplo@example.com">
                    <button type="button" class="btn borded-0 mb-2" data-bs-toggle="tooltip" data-bs-placement="top" 
                    title ="Introduce el correo que nos proporcionaste al inscribirte para confirmar que sea tu correo institucional">
                    <i class="fas fa-question-circle"></i>
                </button> 
                </div>
                <div class="py-1 text-center">
                    <button type="button" class="btn btn-primary custom-shadow mb-2 container-fluid" id="btnRecuContra">Recuperar Contraseña</button>
                </div>
                <div class="mb-3 text-end text-center">
                    <a href="<?=Router::redirigir('login')?>" class="text-muted">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=CONTROLLER?>controller_recu_contra.js"></script>
<!-- 
    Form -> id="frm_recu_contra"
    Input -> id="tk_frm" name="tk_frm"
    Input -> id="funcion" name="funcion"
    Input -> name="correo_usuario" id="correo_usuario"
    Button -> id="btnRecuContra"

 -->