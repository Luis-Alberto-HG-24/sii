<?php 
    require_once '../conector.model.php';
    require_once 'sesion.model.php';
    require_once '../token/token.model.php';
          
    Conector::abrir_conexion();
    call_user_func('Login::'.$_POST['funcion'],Conector::obtener_conexion());
         
    class Login {
        
        static function iniciar_sesion($conexion){            
            $resultado = self::verificacion_acceso($conexion);            
            if ($resultado && password_verify($_POST['password'], $resultado['password'])) {
                if($resultado['estado'] == 0){
                    $resultado['token_usuario'] = Token::generar_token();
                    $resultado['estado'] = "1";
                    Sesion::crear_sesion($resultado);  
                    self::actualizar_estado($conexion, $resultado['id_usuario'], 1);
                    echo json_encode(["1","Credenciales de acceso validas!","home"]);
                }else{
                    echo json_encode(["2","La cuenta a la que quiere acceder esta siendo utilizada en otro dispositivo.\n¿Desea cerrar la sesion anterior e iniciar en este dispositivo?"]);	
                }                
            }else {
                echo json_encode(["0","Correo electronico o constraseña no validos"]);		
            } 
            Conector::cerrar_conexion();
        }

        static function verificacion_acceso($conexion){            
            $consulta = $conexion->prepare("SELECT * FROM t_usuario tu INNER JOIN t_cat_rol rol ON tu.id_cat_rol = rol.id_cat_rol WHERE correo_usuario= ?");
            $consulta -> execute([$_POST['correo_institucional']]);      
            return $consulta -> fetch(PDO::FETCH_ASSOC);
        }

        static function actualizar_estado($conexion, $id, $estado){
            $sql = $conexion -> prepare("UPDATE t_usuario SET estado= ? WHERE id_usuario = ?");
            $sql -> execute([$estado, $id]);
        }

        static function cerrar_sesion($conexion){
            self::actualizar_estado($conexion, $_SESSION['user']['id_usuario'], 0);
            Sesion::destruir_sesion();  
            Conector::cerrar_conexion();     
            echo json_encode(["1","Cerrando sesion...","login"]);
        }

        static function comprobar_sesion($conexion){   
            $id = Sesion::datos_sesion("id_usuario");         
            $consulta = $conexion->prepare("SELECT estado FROM t_usuario WHERE id_usuario= ?");
            $consulta -> execute([$id]);      
            $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();
            echo '' . $resultado['estado'];        
        }

        static function cerrar_sesion_dispositivo($conexion){
            $resultado = self::verificacion_acceso($conexion);
            self::actualizar_estado($conexion, $resultado['id_usuario'], 0);
            Conector::cerrar_conexion();
            echo json_encode(["1","Cerrando sesion...","login"]);
        }
        
    }
?>