<?php
    require_once '../conector.model.php';
    require_once '../sesion/sesion.model.php';
    require_once '../token/token.model.php';
    require_once '../fotografia/fotografia_alumno.model.php';


    Conector::abrir_conexion();
    
    call_user_func('Actualizar_alumno::'.$_POST['funcion'],Conector::obtener_conexion());

    class Actualizar_alumno{

        static function precargar_alumno($conexion){
            $consulta = $conexion->prepare("SELECT apellido_paterno, apellido_materno, nombre_persona, lugar_nacimiento, fecha_nacimiento, id_cat_sexo, id_cat_estado_civil, telefono, curp, correo,codigo_postal, colonia, calle, numero_interior, numero_exterior, ta.id_cat_carrera, id_cat_especialidad, periodo_ingreso, periodos_revalidados, id_cat_tipo_ingreso, id_cat_escolaridad, id_cat_estatus, numero_control, id_usuario, id_direccion, id_alumno, id_persona FROM t_alumno ta INNER JOIN t_persona tp ON ta.fk_persona = tp.id_persona INNER JOIN t_numero_control tnc ON ta.fk_numero_control = tnc.id_numero_control INNER JOIN t_cat_carrera tcc ON ta.id_cat_carrera = tcc.id_cat_carrera INNER JOIN t_direccion td ON tp.fk_direccion = td.id_direccion INNER JOIN t_usuario tu ON tp.id_persona = tu.fk_persona WHERE id_alumno = :id_alumno");    
            $consulta -> bindParam(':id_alumno', $_POST['id_alumno']);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $resultado['periodo_ingreso'] = self::obtener_periodo($resultado['periodo_ingreso']);
            
            echo json_encode($resultado);
            Conector::cerrar_conexion();  
        }

        static function obtener_periodo($periodo){
            return $periodo[4] == "1" ? "ENE-JUN 20" . $periodo[2] . $periodo[3] : "AGO-DIC 20" . $periodo[2] . $periodo[3];
        }

        static function actualizar_inf_alumno($conexion){
            if(Token::comprobar_token_frm("frm_creacion_alumno",$_POST['tk_frm'])){
                $direccion = self::actualizar_direccion($conexion,$_POST['id_direccion']);
                $persona = self::actualizar_persona($conexion,$_POST['id_persona']);
                $id_usuario = $_POST['id_usuario'];
                $semestre = 1;
                $periodos_revalidados = empty($_POST['periodos_revalidados']) ? 0 : $_POST['periodos_revalidados'];
                
                $update = $conexion->prepare("UPDATE t_alumno SET id_cat_especialidad = :id_cat_especialidad,id_cat_estatus = :id_cat_estatus,id_cat_carrera = :id_cat_carrera,id_cat_plan_estudio = :id_cat_plan_estudio,id_cat_tipo_ingreso = :id_cat_tipo_ingreso,lugar_nacimiento = :lugar_nacimiento,semestre = :semestre,periodos_revalidados = :periodos_revalidados WHERE id_alumno = :id_alumno");
                $update -> bindParam(':id_cat_especialidad',$_POST['especialidad']);
                $update -> bindParam(':id_cat_estatus',$_POST['estatus_alumno']);
                $update -> bindParam(':id_cat_carrera',$_POST['carrera_reticula']);
                $update -> bindParam(':id_cat_plan_estudio',$_POST['plan_est']);
                $update -> bindParam(':id_cat_tipo_ingreso',$_POST['tipo_ingresos']);
                $update -> bindParam(':lugar_nacimiento',$_POST['lugar_nacimiento']);
                $update -> bindParam(':semestre', $semestre);
                $update -> bindParam(':periodos_revalidados', $periodos_revalidados); 
                $update -> bindParam(':id_alumno', $_POST['id_alumno']);            
                
                if($update->execute()){
                    if($_FILES["img_alumno"]["name"]){
                        Imagen::cargar_img($id_usuario, $_FILES["img_alumno"]);
                    }
                    if($direccion == 2 && $persona == 2){
                        echo "2";  
                    }else{
                        echo "1";
                    }              
                }else{
                    echo "1";
                }         
            }else{
                echo "Solicitud no valida";
            }
            
            Conector::cerrar_conexion();            
        }


        static function actualizar_persona($conexion,$id_persona){
            $update = $conexion->prepare("UPDATE t_persona SET id_cat_sexo = :id_cat_sexo,id_cat_estado_civil = :id_cat_estado_civil,id_cat_escolaridad = :id_cat_escolaridad,nombre_persona = :nombre_persona,apellido_paterno = :apellido_paterno,apellido_materno = :apellido_materno,curp = :curp,telefono = :telefono,correo = :correo,fecha_nacimiento = :fecha_nacimiento WHERE id_persona = :id_persona");
            $update -> bindParam(':id_cat_sexo',$_POST['selector_sexo']);
            $update -> bindParam(':id_cat_estado_civil',$_POST['selector_edo_civil']);
            $update -> bindParam(':id_cat_escolaridad',$_POST['nivel_escolar']);
            $update -> bindParam(':nombre_persona',$_POST['nombres']);
            $update -> bindParam(':apellido_paterno',$_POST['apellido_paterno']);
            $update -> bindParam(':apellido_materno',$_POST['apellido_materno']);
            $update -> bindParam(':curp',$_POST['curp']);
            $update -> bindParam(':telefono',$_POST['telefono']);
            $update -> bindParam(':correo',$_POST['correo_electronico']);
            $update -> bindParam(':fecha_nacimiento',$_POST['fecha_nacimiento']);
            $update -> bindParam(':id_persona',$id_persona);
            
            if($update->execute()){
                $id= 2;
            }else{
                $id="";
            }
            return $id;            
        }

        static function actualizar_direccion($conexion,$id_direccion){
            $no_interior = empty($_POST['no_interior']) ? "s/n" : $_POST['no_interior'];
            $no_exterior = empty($_POST['no_exterior']) ? "s/n" : $_POST['no_exterior'];
            $update = $conexion->prepare("UPDATE t_direccion SET codigo_postal = :codigo_postal,estado = :estado,alcaldia = :alcaldia,colonia = :colonia,calle = :calle,numero_interior = :numero_interior,numero_exterior = :numero_exterior WHERE id_direccion = :id_direccion");
            $update -> bindParam(':codigo_postal',$_POST['codigo_postal']);
            $update -> bindParam(':estado',$_POST['estado']);
            $update -> bindParam(':alcaldia',$_POST['alcaldia']);
            $update -> bindParam(':colonia',$_POST['colonia']);
            $update -> bindParam(':calle',$_POST['calle']);
            $update -> bindParam(':numero_interior',$no_interior);
            $update -> bindParam(':numero_exterior',$no_exterior);
            $update -> bindParam(':id_direccion',$id_direccion);
            if($update->execute()){
                $id= 2;
            }else{
                $id="";
            }
            return $id;            
        }
    }

?>