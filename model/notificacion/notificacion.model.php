<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';

    Conector::abrir_conexion();
    call_user_func('Notificacion::'.$_POST['funcion'],Conector::obtener_conexion());
    
    class Notificacion {
        
        
        static function verificacion_notificacion($conexion){
            $contar = 0;
            $user = Sesion::datos_sesion("id_usuario");
            foreach ($conexion->query("SELECT * from t_solicitud ts INNER JOIN t_cat_rol tcr ON ts.id_usuario_envio_solicitud = tcr.id_cat_rol WHERE id_usuario_recibio_solicitud='$user' OR id_usuario_envio_solicitud='$user'") as $notify){
                if($notify['estado_solicitud']== 1 && $user == $notify['id_usuario_envio_solicitud']){
                    $contar++;
                    echo '<div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-primary"><i class="fas fa-bell text-warning"></i> '.$notify['descripcion_rol'].'</h5>
                            <small class="text-muted">Respondida <button type="button" class="btn btn-link text-danger btn-sm" onclick="marcar_leida('.$notify['id_solicitud'].')"><i class="far fa-times-circle"></i></button></small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1 text-justify"><b>A solicitado:</b> '.$notify['descripcion_solicitud']. '</p>
                            <small class="text-end text-muted">'.$notify['fecha_realizo_solicitud'].'</small>
                        </div>
                    </div>'; 
                }else if($notify['estado_solicitud']== 0 && $user == $notify['id_usuario_recibio_solicitud']){
                    $contar++;
                    echo '<a href="aprobar_ctrl" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-primary"><i class="fas fa-bell text-warning"></i> '.$notify['descripcion_rol'].'</h5>
                            <small class="text-muted">Pendiente</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1 text-justify"><b>A solicitado:</b> '.$notify['descripcion_solicitud']. '</p>
                            <small class="text-end text-muted">'.$notify['fecha_realizo_solicitud'].'</small>
                        </div>
                    </a>'; 
                }
                
            }
            if($contar == 0){
                echo '<input type="text" value="" id="cantidad-notify" hidden>';     
                echo '<h3 class="text-center py-4">No tienes notificaciones pendientes <i class="fas fa-bell-slash text-warning"></i></h3>';            
            }else{
               echo '<input type="text" value="'.$contar.'" id="cantidad-notify" hidden>'; 
            }
            Conector::cerrar_conexion();
        }
        static function toast_notificacion($conexion){
            
            $usuario = Sesion::datos_sesion('id_usuario');
            
            foreach ($conexion->query("SELECT * from t_solicitud ts INNER JOIN t_cat_rol tcr ON ts.id_usuario_envio_solicitud = tcr.id_cat_rol WHERE id_usuario_recibio_solicitud='$usuario' AND estado_solicitud = 0 AND estado_mensaje_emergente = 0") as $notify){
                
                echo '
                
                    <div id="toas_noti" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="fas fa-bell text-warning"></i>
                                <strong class="me-auto">'.$notify['descripcion_rol'].'</strong>                            
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                <p class="mb-1 text-justify"><b>A solicitado:</b> '.$notify['descripcion_solicitud']. '</p>
                                <small class="text-end text-muted">'.$notify['fecha_realizo_solicitud'].'</small>
                            </div>
                    </div>
                ';
                $conexion->query("UPDATE t_solicitud SET estado_mensaje_emergente = 1 WHERE id_usuario_recibio_solicitud = '$usuario' AND estado_solicitud = 0");
            }
            Conector::cerrar_conexion();

        }
      
        static function marcar_notificacion($conexion){
            $update = $conexion->prepare("UPDATE t_solicitud SET estado_solicitud = '2' WHERE id_solicitud = ?");      
            $update->execute([$_POST['id_solicitud']]);
        }

    }
?>