<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';

    Conector::abrir_conexion();
    
    call_user_func('Mostrar::mostrarDatos',Conector::obtener_conexion());

    class Mostrar {

      static function mostrarDatos($conexion){ //funcion para consultar y retornar las solicitudes de numeros de ctrl en la bd
        $sesion = Sesion::datos_sesion('id_usuario');
        foreach($conexion->query("SELECT solicitud,
                descripcion_solicitud,
                estado_solicitud,
                fecha_realizo_solicitud,
                fecha_atencion_solicitud
                FROM t_solicitud WHERE id_usuario_envio_solicitud= '$sesion'") as $aux){
                  $arreglo ['data'][] = $aux;
                }

        if(isset($arreglo)){
          echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        }else{
          $arreglo['data']['solicitud'] = '';
          $arreglo['data']['descripcion_solicitud'] ='';
          $arreglo['data']['estado_solicitud'] ='';
          $arreglo['data']['fecha_realizo_solicitud'] ='';
          $arreglo['data']['fecha_atencion_solicitud'] ='';
          echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        }                
        //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        Conector::cerrar_conexion();
      }
    }

?>