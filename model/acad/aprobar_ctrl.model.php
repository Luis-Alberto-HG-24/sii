<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';
    require_once '../token/token.model.php';
    
    Conector::abrir_conexion();

    call_user_func('Solicitud::'.$_POST['funcion'] ,Conector::obtener_conexion());
    
    class Solicitud {

        static function consultar_solicitud($conexion){ //funcion para consultar la solicitud de numeros de control desde la bd
            $consulta = $conexion->prepare("SELECT id_solicitud, solicitud FROM t_solicitud WHERE estado_solicitud=0 ORDER BY t_solicitud.fecha_realizo_solicitud DESC LIMIT 1");    
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();
            echo json_encode($resultado);
            
        }

        static function consultar_numero_ctrl($conexion){ //funcion para consultar el ultimo numero de control en la bd
            $consulta = $conexion->prepare("SELECT numero_control FROM t_numero_control ORDER BY t_numero_control.id_numero_control DESC LIMIT 1");    
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $numCtrl = "".$resultado['numero_control'];
            date_default_timezone_set('America/Mexico_City');
            $anio = date("y"); 
            if(empty($resultado)){
                $numCtrl = $anio."1190001";
                echo $numCtrl;
            } else {
                echo $numCtrl;
            }
            
            Conector::cerrar_conexion();
        }

        static function generar_num_ctrl($conexion){
            if(Token::comprobar_token_frm("frm_aprobar_ctrl",$_POST['tk_frm'])){
                $solicitud = $_POST['num_matriculas'];
                $idSolicitud = $_POST['id_solicitud'];
                $consulta = $conexion->prepare("SELECT numero_control FROM t_numero_control ORDER BY t_numero_control.id_numero_control DESC LIMIT 1");    
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $numCtrl = "".$resultado['numero_control'];
                date_default_timezone_set('America/Mexico_City');
                $anio = date("y");

                if(date("n") > 7){
                    $periodo = date("Y")."3";
                } else {
                    $periodo = date("Y")."1";
                }
                if(empty($resultado) || substr($numCtrl, 0, 2) != $anio){
                    
                    $numCtrl = $anio."1190001";
                    for($i = 0; $i < $solicitud; $i++){ //este for inserta los numeros de control en la bd si se cumple el if de arriba
                            $insert = $conexion->prepare("INSERT INTO t_numero_control (periodo, numero_control, autorizar, estatus, fecha_autorizacion) VALUES (?,?,'autorizado', 'disponible', NOW())");
                            $insert->execute([$periodo,$numCtrl]);
                            $numCtrl++;
                    }
                } else {
                    $numCtrl++;
                    for($i = 0; $i < $solicitud; $i++){ //este for inserta los numeros de control en la bd si se cumple el if de arriba
                        $insert = $conexion->prepare("INSERT INTO t_numero_control (periodo, numero_control, autorizar, estatus, fecha_autorizacion) VALUES (?,?, 'autorizado', 'disponible', NOW())");
                        $insert->execute([$periodo,$numCtrl]);
                        $numCtrl++;
                    }
                }
                $sesion = Sesion::datos_sesion('id_usuario'); //aqui se obtienen los datos de la sesion y luego se usan para actualizar el estado de la sesion en la siguiente línea
                $update = $conexion->prepare("UPDATE t_solicitud SET estado_solicitud= 1, id_usuario_recibio_solicitud= '$sesion', fecha_atencion_solicitud= NOW() WHERE id_solicitud = ?");
                $update -> bindParam(':id_solicitud',);

                if($update->execute($idSolicitud) ==1){
                    echo "1";
                } else {
                    echo "2";
                }
            } else {
                echo 'Solicitud no válida';
            }
            
            
            Conector::cerrar_conexion();
        }

        static function rechazar_solicitud($conexion){ //esta funcion sirve para cambiar el estado de la solicitud a "rechazada"
            if(Token::comprobar_token_frm("frm_aprobar_ctrl",$_POST['tk_frm'])){
                $sesion = Sesion::datos_sesion('id_usuario');
                $idSolicitud = $_POST['id_solicitud'];
                $rechazar = $conexion->prepare("UPDATE t_solicitud SET estado_solicitud= 2, id_usuario_recibio_solicitud= '$sesion', fecha_atencion_solicitud= NOW() WHERE id_solicitud = '$idSolicitud'");
                if($rechazar-> execute() == 1){
                    echo "1";
                } else {
                    echo "2";
                }
            } else {
                echo 'Solicitud no válida';
            }
            
            Conector::cerrar_conexion();
        }

        static function mostrarDatos($conexion){//funcion para consultar y retornar las solicitudes de numeros de ctrl en la bd
           
            $consulta = $conexion -> prepare("SELECT solicitud,descripcion_solicitud,estado_solicitud,fecha_realizo_solicitud,fecha_atencion_solicitud
                                              FROM t_solicitud WHERE id_usuario_envio_solicitud = 4");
            $consulta -> execute();
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();
            echo json_encode($resultado);
        }
    }
?>
