<?php
    require_once '../../conector.model.php';
    require_once '../../sesion/sesion.model.php';
    require_once '../../token/token.model.php';

    Conector::abrir_conexion();
    
    call_user_func('Agregar_aula::'.$_POST['funcion'],Conector::obtener_conexion());
    
    
    class Agregar_aula{

        static function agregar_aula($conexion){
            if(isset($_POST['btn_inactivo'])){
                $activo = "ACTIVA";
            }else{
                $activo = "INACTIVO";
            }
            if(!($_POST['observaciones'] == false)){
                $observaciones = $_POST['observaciones'];
            }else{
                $observaciones = "Sin observaciones";
            }
            $insert = $conexion->prepare("INSERT INTO t_cat_aulas (aula,capacidad,ubicacion,estatus_aula,observaciones) VALUES (?,?,?,?,?)");

            if($insert->execute([ $_POST['nombre_aula'],$_POST['capacidad'],$_POST['ubicacion'],$activo,$observaciones])){
                 echo 1;             
            }else{
                echo "";
            }       
            Conector::cerrar_conexion();  
        }

        static function eliminar_aula($conexion){
            $consulta = $conexion->prepare("DELETE FROM t_cat_aulas WHERE id_cat_aulas = ?");    
            if($consulta->execute($_POST['id_cat_aula'])){
                echo 1;
            }
            Conector::cerrar_conexion();  
        }
        
        static function precargar_aula($conexion){
            $consulta = $conexion->prepare("SELECT id_cat_aulas, aula, capacidad, ubicacion, estatus_aula, observaciones FROM t_cat_aulas WHERE id_cat_aulas = ?");    
            $consulta->execute($_POST['id_cat_aulas']);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
            Conector::cerrar_conexion();  
        }

        static function actualizar_aula($conexion){
            if(isset($_POST['actualizar_btn_inactivo'])){
                $actualizar_activo = "ACTIVA";
            }else{
                $actualizar_activo = "INACTIVO";
            }
            if(!($_POST['actualizar_observaciones'] == false)){
                $actualizar_observaciones = $_POST['actualizar_observaciones'];
            }else{
                $actualizar_observaciones = "Sin observaciones";
            }
            $update = $conexion->prepare("UPDATE t_cat_aulas SET aula = ?, capacidad = ?, ubicacion = ?, estatus_aula = ?, observaciones = ? WHERE id_cat_aulas = ?");  
            if($update->execute([$_POST['actualizar_nombre_aula'],$_POST['actualizar_capacidad'],$_POST['actualizar_ubicacion'],$actualizar_activo,$actualizar_observaciones,$_POST['id_cat_aula']])){
                echo "1";
            }else{
                echo "";
            }
            
            Conector::cerrar_conexion();            
        }            
    }
?>