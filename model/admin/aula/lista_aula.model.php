<?php 
    require_once '../../model_conector.php';
    require_once '../../model_sesion.php';

    Conector::abrir_conexion();
    
    call_user_func('Aula::mostrar_tabla_aula',Conector::obtener_conexion());

    class Aula {

      static function mostrar_tabla_aula($conexion){ 

        $consulta = $conexion->prepare("SELECT id_cat_aulas, aula, capacidad, ubicacion, estatus_aula, observaciones FROM t_cat_aulas");

        $consulta -> execute();
        $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);

        Conector::cerrar_conexion();
        echo json_encode($resultado);
      }

    }
    

?>