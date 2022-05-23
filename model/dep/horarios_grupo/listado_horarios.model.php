<?php
    require_once '../../conector.model.php';
    require_once '../../sesion/sesion.model.php';
    require_once '../../token/token.model.php';
    
    Conector::abrir_conexion();
    call_user_func('Listado_horarios::'.$_POST['funcion'] ,Conector::obtener_conexion());
    
    class Listado_horarios {
        static function consultar_horarios($conexion){
            $semestre = self::consultar_semestre($conexion);
            $i = 0;
            foreach ($conexion->query("SELECT id_horario, dia, hora_inicio, hora_fin, nombre_grupo, aula, tcm.nombre, creditos_totales  FROM t_horario th INNER JOIN t_grupo tg ON th.id_grupo = tg.id_grupo INNER JOIN t_cat_materias tcm ON  tg.id_cat_materia = tcm.id_cat_materia INNER JOIN t_cat_aulas tca ON th.id_cat_aula = tca.id_cat_aulas  WHERE tg.id_periodo = '$semestre'") as $aux){
                if(isset($horario)){
                    if($horario[($i-1)]['nombre'] == $aux['nombre'] && $horario[($i-1)]['nombre_grupo'] == $aux['nombre_grupo']){
                        switch($aux['dia']){
                            case 'lunes': {
                                $horario[($i-1)]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'martes': {
                                $horario[($i-1)]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'miercoles': {
                                $horario[($i-1)]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'jueves': {
                                $horario[($i-1)]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'viernes': {
                                $horario[($i-1)]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'sabado': {
                                $horario[($i-1)]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                        }
                    }else {
                        $horario[$i]['id_horario'] = $aux['id_horario'];
                        $horario[$i]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['nombre_grupo'] = $aux['nombre_grupo'];
                        $horario[$i]['nombre'] = $aux['nombre'];
                        $horario[$i]['creditos_totales'] = $aux['creditos_totales'];
                        $i++;
                    }
                }else {
                    $horario[$i]['id_horario'] = $aux['id_horario'];
                    $horario[$i]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['nombre_grupo'] = $aux['nombre_grupo'];
                    $horario[$i]['nombre'] = $aux['nombre'];
                    $horario[$i]['creditos_totales'] = $aux['creditos_totales'];
                    $i++;
                }
            }
            echo json_encode($horario);
            Conector::cerrar_conexion();           
        }

        static function determinar_dia ($dia, $dia_tabla, $hora_inicio, $hora_fin, $aula, $id) {
            return $dia == $dia_tabla ? '<a class="horario" href="#">'.$hora_inicio .'-'. $hora_fin .'<br><p class="aula">/'. $aula .'</p></a>' : ''; 
        }

        static function consulta_filtrada($conexion){
            $semestre = self::consultar_semestre($conexion);
            $carrera = $_POST['filtro'];
            $i = 0;
            foreach ($conexion->query("SELECT id_horario, dia, hora_inicio, hora_fin, nombre_grupo, aula, tcm.nombre, creditos_totales  FROM t_horario th INNER JOIN t_grupo tg ON th.id_grupo = tg.id_grupo INNER JOIN t_cat_materias tcm ON  tg.id_cat_materia = tcm.id_cat_materia INNER JOIN t_cat_aulas tca ON th.id_cat_aula = tca.id_cat_aulas  WHERE tg.id_periodo = '$semestre' AND tg.id_cat_carrera ='$carrera'") as $aux){
                if(isset($horario)){
                    if($horario[($i-1)]['nombre'] == $aux['nombre'] && $horario[($i-1)]['nombre_grupo'] == $aux['nombre_grupo']){
                        switch($aux['dia']){
                            case 'lunes': {
                                $horario[($i-1)]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'martes': {
                                $horario[($i-1)]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'miercoles': {
                                $horario[($i-1)]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'jueves': {
                                $horario[($i-1)]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'viernes': {
                                $horario[($i-1)]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                            case 'sabado': {
                                $horario[($i-1)]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                                break;
                            }
                        }
                    }else {
                        $horario[$i]['id_horario'] = $aux['id_horario'];
                        $horario[$i]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                        $horario[$i]['nombre_grupo'] = $aux['nombre_grupo'];
                        $horario[$i]['nombre'] = $aux['nombre'];
                        $horario[$i]['creditos_totales'] = $aux['creditos_totales'];
                        $i++;
                    }
                }else {
                    $horario[$i]['id_horario'] = $aux['id_horario'];
                    $horario[$i]['lunes'] = self::determinar_dia($aux['dia'], 'lunes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['martes'] = self::determinar_dia($aux['dia'], 'martes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['miercoles'] = self::determinar_dia($aux['dia'], 'miercoles', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['jueves'] = self::determinar_dia($aux['dia'], 'jueves', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['viernes'] = self::determinar_dia($aux['dia'], 'viernes', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['sabado'] = self::determinar_dia($aux['dia'], 'sabado', $aux['hora_inicio'], $aux['hora_fin'], $aux['aula'], $aux['id_horario']);
                    $horario[$i]['nombre_grupo'] = $aux['nombre_grupo'];
                    $horario[$i]['nombre'] = $aux['nombre'];
                    $horario[$i]['creditos_totales'] = $aux['creditos_totales'];
                    $i++;
                }
            }
            echo json_encode($horario);
            Conector::cerrar_conexion();           
        }

        static function consultar_semestre($conexion){
            $consulta = $conexion->prepare("SELECT id_semestre  FROM t_semestre  WHERE estado = 1");
            $consulta -> execute();
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();   
            return $resultado['id_semestre'];        
        }   
        
        static function consultar_horario($conexion){
            $consulta = $conexion->prepare("SELECT * FROM t_horario th INNER JOIN t_cat_aulas tca ON  th.id_cat_aula = tca.id_cat_aulas WHERE id_horario = ?");
            $consulta -> execute([$_POST['id_horario']]);
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            Conector::cerrar_conexion();
            echo json_encode($resultado);
        } 
    }
?>