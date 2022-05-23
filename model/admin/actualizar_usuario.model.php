<?php
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';
    require_once '../token/token.model.php';
    
    Conector::abrir_conexion();
    
    call_user_func('Actualizar_usuario::'.$_POST['funcion'],Conector::obtener_conexion());

    class Actualizar_usuario{

        static function precargar_usuario($conexion){
            $consulta = $conexion->prepare("SELECT id_usuario, fk_persona, correo_usuario, nombre_persona, apellido_paterno, apellido_materno, telefono FROM t_usuario tu INNER JOIN t_persona tp ON tu.fk_persona = tp.id_persona WHERE id_usuario = ?");    
            $consulta->execute($_POST['id_usuario']);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();  
            echo json_encode($resultado);
        }

        static function actualizar_inf_usuario($conexion){
                $persona = self::actualizar_inf_persona($conexion,$_POST['fk_persona']);
                $update = $conexion->prepare("UPDATE t_usuario SET correo_usuario = ? WHERE id_usuario = ?");

                if($update->execute([$_POST['correo_electronico'],$_POST['id_usuario']])){
                    if($persona == 2){
                        echo "2"; 
                                     
                   }else{
                         echo "1";
                   }     
                }else{
                    echo "1";
                }
                    
            
            
            Conector::cerrar_conexion();            
        }

        static function actualizar_inf_persona($conexion,$fk_persona){  
            $update = $conexion->prepare("UPDATE t_persona SET nombre_persona = ?, apellido_paterno = ?, apellido_materno = ?, telefono = ? WHERE id_persona = ?");
            
            if($update->execute([$_POST['nombre_usuario'],$_POST['apellido_paterno'],$_POST['apellido_materno'],$_POST['telefono'],$fk_persona])){
                 $id = 2; 
                              
            }else{
                $id = "";
            }         

            return $id;
        
        
                
        }
    
                    
    }



?>