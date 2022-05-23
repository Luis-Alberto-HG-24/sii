<?php
    require_once '../../conector.model.php';
    require_once '../../sesion/sesion.model.php';
    require_once '../../token/token.model.php';
    
    Conector::abrir_conexion();
    call_user_func('Horarios::'.$_POST['funcion'] ,Conector::obtener_conexion());
    
    class Horarios {
        static function consultar_carrera($conexion){
            echo '<option value="">Seleccionar carrera</option>';
            foreach ($conexion->query("SELECT id_cat_carrera, nombre_carrera FROM t_cat_carrera") as $carrera){
                echo '<option value="' . $carrera['id_cat_carrera'] .'">' . $carrera['nombre_carrera'] . '</option>';
            }
            Conector::cerrar_conexion();
        }

        static function consultar_materia($conexion){
            $carrera = $_POST['carrera'];
            echo '<option value="">Seleccionar materia</option>';
            foreach ($conexion->query("SELECT id_cat_materia, nombre FROM t_cat_materias WHERE id_cat_carrera = '$carrera'") as $materia){
                echo '<option value="' . $materia['id_cat_materia'] .'">' . $materia['nombre'] . '</option>';
            }
            Conector::cerrar_conexion();
        }

        static function obtener_datos_materia($conexion){
            $consulta = $conexion->prepare("SELECT clave, creditos_totales, exclusivo_carrera FROM t_cat_materias WHERE id_cat_materia = ?");
            $consulta -> execute([$_POST['materia']]);
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
            Conector::cerrar_conexion();
        }

        static function consultar_aula($conexion){
            echo '<option value="">Aula</option>';
            foreach ($conexion->query("SELECT id_cat_aulas, aula FROM t_cat_aulas WHERE  estatus_aula = 'ACTIVA'") as $materia){
                echo '<option value="' . $materia['id_cat_aulas'] .'">' . $materia['aula'] . '</option>';
            }
            Conector::cerrar_conexion();
        }

        static function obtener_disponibilidad($conexion){
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $consulta = $conexion->prepare("SELECT * FROM t_horario th INNER JOIN t_grupo tg ON th.id_grupo = tg.id_grupo WHERE th.dia = ? AND th.id_cat_aula = ?  AND tg.id_periodo = ?");
            $consulta -> execute([$_POST['dia'], $_POST['aula'], $_POST['periodo']]);
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            if($resultado){
                $respuesta = 1;
                $hora_ini = 0;
                $hora_fn = 0;
                foreach($resultado as $key => $hora){
                    if($key == "hora_inicio"){
                        $hora_ini = intval($hora);
                        if(intval($hora) == intval($hora_inicio)){
                            $respuesta ++;      
                        }
                    } else if($key == "hora_fin"){
                        $hora_fn =  intval($hora);
                        if((intval($hora) > intval($hora_inicio)) && ($hora_ini < intval($hora_inicio))){
                            $respuesta ++;      
                        }
                    }else{
                        continue;
                    }
                    if(($hora_fn >= intval($hora_fin)) && (intval($hora_fin) > $hora_ini)){
                        $respuesta ++;
                    }
                }
                echo json_encode($respuesta);
            }else{
                echo json_encode("1");
            }
        }

        static function consultar_semestre($conexion){
            $consulta = $conexion->prepare("SELECT id_semestre, semestre FROM t_semestre WHERE estado = '1'");
            $consulta -> execute();
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            echo $resultado['semestre'];
            Conector::cerrar_conexion();
        }

        static function insercion_horario($conexion){
            $dias_semana = array('lunes','martes','miercoles','jueves','viernes','sabado');
            if(Token::comprobar_token_frm("frm_horario_grupo",$_POST['tk_frm'])){
                $respuesta = 1; 
                $grupo = self::insercion_grupo($conexion);
                $insercion = $conexion->prepare("INSERT INTO t_horario (dia, hora_inicio, hora_fin, id_cat_aula, id_grupo) VALUES (?,?,?,?,?)");
                for($i = 1; $i < 7; $i++){
                    if($_POST['hora_inicio' . $i] != "" && $_POST['hora_fin' . $i] != ""){
                        $hora_clase = $_POST['hora_inicio' . $i] < 10 ? '0'. $_POST['hora_inicio' . $i] . ':00' : '' . $_POST['hora_inicio' . $i] . ':00';                        
                        if($insercion -> execute([$dias_semana[$i], $hora_clase, $_POST['hora_fin' . $i], $_POST['aula' . $i], $grupo])){
                            $respuesta = $respuesta;
                        }else{
                            $respuesta ++; 
                        }
                    }
                }                
                echo json_encode([$respuesta, $respuesta =! 1 ? "Se ha producido un error al crear el nuevo horario!": "Se ha creado el nuevo horario y grupo con exito!"]);
            }else{
                echo json_encode(["2","Solicitud no valida!"]);
            }
            Conector::cerrar_conexion();
        }

        static function insercion_grupo($conexion){
            $insercion = $conexion->prepare("INSERT INTO t_grupo (id_cat_carrera, id_cat_materia, id_periodo, semestre, nombre_grupo, capacidad) VALUES (?,?,?,?,?,?)");
            $insercion -> execute([$_POST['carrera'], $_POST['materia'], $_POST['periodo_id'], $_POST['semestre'], $_POST['nombre_grupo'], $_POST['capacidad']]);
            return $conexion->lastInsertId();
        }

        static function consulta_tatal_horarios($conexion){
            foreach ($conexion->query("SELECT tss.semestre, tca.aula, tca.capacidad, tca.ubicacion, tca.observaciones, tcm.nombre, tcm.clave, tcm.creditos_totales, tcm.exclusivo_carrera, tcc.nombre_carrera, tcc.carrera, th.semestre, th.dia, th.hora_inicio, th.hora_fin FROM t_horario th INNER JOIN t_cat_aulas tca ON th.id_cat_aulas = tca.id_cat_aulas INNER JOIN t_cat_materias tcm ON th.id_cat_materia = tcm.id_cat_materia INNER JOIN t_cat_carrera tcc ON th.id_cat_carrera = tcc.id_cat_carrera INNER JOIN t_semestre tss ON th.periodo = tss.id_semestre")as $horario){
                echo '
                <tr>
                    <td></td>
                    <td></td>
                </tr>';
            }            
            Conector::cerrar_conexion();
        }
    }
?>