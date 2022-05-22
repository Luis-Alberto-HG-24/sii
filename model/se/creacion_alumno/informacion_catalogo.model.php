<?php
    require_once '../../conector.model.php';
    require_once '../../sesion/sesion.model.php';
    
    Conector::abrir_conexion();

    call_user_func('Datos::'.$_POST['funcion'] ,Conector::obtener_conexion());
    class Datos {

        static function consultar_estado($conexion){
            $consulta = $conexion->prepare("SELECT estado,alcaldia FROM t_cat_data_dir  WHERE codigo_postal = ? LIMIT 1");
            $consulta->execute([$_POST['codigo_postal']]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $resultado['colonia'] = self::consultar_colonia($conexion,$_POST['codigo_postal']);
	        echo json_encode($resultado);
            Conector::cerrar_conexion();
        }


        static function consultar_colonia($conexion,$codigo_postal){
            $arreglo = array();
            foreach ($conexion->query("SELECT colonia FROM t_cat_data_dir  WHERE codigo_postal = '$codigo_postal'") as $colonia){
                array_push($arreglo,$colonia['colonia']);
            }
            return $arreglo;
        }

        static function consultar_carrera($conexion){
            echo '<option value="">Seleccionar carrera</option>';
            foreach ($conexion->query("SELECT id_cat_carrera, nombre_carrera FROM t_cat_carrera") as $carrera){
                echo '<option value="' . $carrera['id_cat_carrera'] .'">' . $carrera['nombre_carrera'] . '</option>';
            }
            Conector::cerrar_conexion();
        }
        
        static function consultar_especialidad($conexion){
            $id = $_POST['carrera_reticula'];
            foreach ($conexion->query("SELECT * FROM t_cat_especialidad WHERE id_cat_carrera = '$id' ORDER BY id_cat_especialidad DESC") as $especialidad){
                echo '<option value="' . $especialidad['id_cat_especialidad'] . '">' . $especialidad['especialidad'] . '</option>';
            }           
            Conector::cerrar_conexion();
        }

        static function consultar_ingreso($conexion){
            foreach ($conexion->query("SELECT * FROM t_cat_tipo_ingreso") as $ingreso){
                echo '<option value="' . $ingreso['id_cat_tipo_ingreso'] .'">' . $ingreso['tipo_ingreso'] . '</option>';
            }
            Conector::cerrar_conexion();
        }

        static function consultar_plan_estudios($conexion){
            $consulta = $conexion->prepare("SELECT plan_estudio FROM t_cat_plan_estudio  WHERE id_cat_carrera = ?");    
            $consulta->execute([$_POST['carrera']]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
	        echo $resultado['plan_estudio'];
            Conector::cerrar_conexion();
        }
        
        static function consulta_nivel_estudios($conexion){
            foreach ($conexion->query("SELECT * FROM t_cat_escolaridad") as $escolaridad){
                echo '<option value="' . $escolaridad['id_cat_escolaridad'] .'">' . $escolaridad['escolaridad'] . '</option>';
            }
            Conector::cerrar_conexion();
        }

        static function consulta_estatus_alumno($conexion){
            foreach ($conexion->query("SELECT * FROM t_cat_estatus") as $estaus){
                echo '<option value="' . $estaus['id_cat_estatus'] .'">' . $estaus['estatus'] . ' (' . $estaus['descripcion_estatus'] . ')</option>';
            }
            Conector::cerrar_conexion();
        }
    }
?>