<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';
    require_once '../token/token.model.php';
    
    Conector::abrir_conexion();
    call_user_func('Solicitud::'.$_POST['funcion'] ,Conector::obtener_conexion());
    class Solicitud {

        static function consultar_estado_solicitud($conexion){ //funcion para consultar el estado de la solicitud desde la bd
            $consulta = $conexion->prepare("SELECT id_solicitud, estado_solicitud FROM t_solicitud ORDER BY t_solicitud.fecha_realizo_solicitud DESC LIMIT 1");    
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();
            echo json_encode($resultado);
        }

        static function enviar_solicitud($conexion){ //funcion para enviar la solicitud a la bd
            if(Token::comprobar_token_frm("frm_num_ctrl",$_POST['tk_frm'])){
                $sesion = Sesion::datos_sesion('id_usuario');
                $solicitud = $_POST['num_matriculas'];
                $descripcion = "Generación de números de control";
                $insert = $conexion->prepare("INSERT INTO t_solicitud (solicitud, descripcion_solicitud, id_usuario_envio_solicitud, id_usuario_recibio_solicitud) VALUES (?, ?, ?, ?)");
                if($insert -> execute([$solicitud, $descripcion, $sesion, 3])){
                    echo json_encode(["1","La solicitud se ha enviado, por favor espera que sea aceptada"]);
                } else {
                    echo json_encode(["0","No se pudo procesar la solicitud, por favor contacta al administrador"]);
                }
            }else{
                echo json_encode(["0","Solicitud no valida"]);
            }
            Conector::cerrar_conexion();
        }

        static function cancelar_solicitud($conexion){ //funcion para cancelar la solicitud y eliminarla de la bd
            if(Token::comprobar_token_frm("frm_num_ctrl",$_POST['tk_frm'])){
                $delete = $conexion->prepare("DELETE FROM t_solicitud ORDER BY t_solicitud.id_solicitud DESC LIMIT 1");
                if($delete-> execute()){
                    echo json_encode(["1","La solicitud ha sido cancelada!"]);
                } else {
                    echo json_encode(["1","Error al cancelar la solicitud!"]);
                }
            }else{
                echo json_encode(["0","Solicitud no valida"]);
            }
            Conector::cerrar_conexion();
        }

        static function mostrar_num_control($conexion){ //funcion para consultar los numeros de control en la bd y enviarlos a la vista de creacion de alumnos       
            $select = $conexion->prepare("SELECT numero_control FROM t_numero_control WHERE estatus = 'disponible'");
            $select->execute();
            $seleccion = $select->fetch(PDO::FETCH_ASSOC);
            $datosJson = json_encode($seleccion);
            echo $datosJson;
            Conector::cerrar_conexion();            
        }        
    }
?>