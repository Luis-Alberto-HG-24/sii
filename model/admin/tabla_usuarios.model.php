<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';

    Conector::abrir_conexion();
    
    call_user_func('Usuarios::mostrar_tabla_usuario',Conector::obtener_conexion());

    class Usuarios {

      static function mostrar_tabla_usuario($conexion){ 

        $consulta = $conexion->prepare("SELECT id_usuario, correo_usuario, nombre_persona, apellido_paterno, apellido_materno, telefono FROM t_usuario tu INNER JOIN t_persona tp ON tu.fk_persona = tp.id_persona INNER JOIN t_cat_rol tr ON tu.id_cat_rol = tr.id_cat_rol WHERE tr.rol != 'ALUMNO'");

        $restultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        
        Conector::cerrar_conexion();
        echo json_encode($restultado);
      }    
      
    }
    

?>