<?php 
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';

    Conector::abrir_conexion();
    
    call_user_func('Alumno::mostrar_tabla_alumno',Conector::obtener_conexion());

    class Alumno {

      static function mostrar_tabla_alumno($conexion){ 

        foreach($conexion->query("SELECT id_alumno, numero_control, nombre_persona, apellido_paterno, apellido_materno, carrera, semestre FROM t_alumno ta INNER JOIN t_persona tp ON ta.fk_persona = tp.id_persona INNER JOIN t_numero_control tnc ON ta.fk_numero_control = tnc.id_numero_control INNER JOIN t_cat_carrera tcc ON ta.id_cat_carrera = tcc.id_cat_carrera") as $aux){
          $aux['btnEditar']= '<button type="button" class="btn btn-outline-success rounded-3 mb-2"  onclick="precargar_alumno('.$aux['id_alumno'].')" id="btn_ver"><i class="far fa-edit"></i></button>';
          //$aux['btnEliminar'] = '<button type="button" class="btn btn-outline-danger rounded-3 mb-2" onclick="eliminar_alumno('.$aux['id_alumno'].')" id="btn_borrar"><i class="far fa-trash-alt"></i></button>';
          $arreglo ['data'][] = $aux;
        }

        if(isset($arreglo)){
          echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        }else{
          $arreglo['data']['id_alumno'] = '';
          $arreglo['data']['numero_control'] ='';
          $arreglo['data']['nombre_persona'] ='';
          $arreglo['data']['apellido_paterno'] ='';
          $arreglo['data']['apellido_materno'] ='';
          $arreglo['data']['carrera'] ='';
          $arreglo['data']['semestre'] ='';
          $arreglo['data']['btnEditar'] ='';
          //$arreglo['data']['btnEliminar'] ='';
          echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        }  
        Conector::cerrar_conexion();
      }      
    }
    

?>