<?php

    require_once '../../conector.model.php';
    require_once '../../sesion/sesion.model.php';
    require_once '../../token/token.model.php';
    require_once '../../fotografia/fotografia_alumno.model.php';
    
    Conector::abrir_conexion();

    call_user_func('Creacion_alumno::'.$_POST['funcion'] ,Conector::obtener_conexion());

    class Creacion_alumno {
    
        static function mostrar_num_control($conexion){
            $i = 0;
            foreach($conexion->query("SELECT id_numero_control, numero_control FROM t_numero_control WHERE estatus = 'disponible'") as $control){
                //echo '<option value="' . $control['id_numero_control'] . '">' . $control['numero_control'] . '</option>';
                $arreglo [] = $control;
                $i++;
            }
            Conector::cerrar_conexion();   
            if(isset($arreglo)){
                echo json_encode($arreglo);
            }else{
                $control['numero_control'] = 'N/D';
                $control['id_numero_control'] = "";
                $arreglo [] = $control;
                echo json_encode($arreglo);
            }
                     
        }

        static function crear_alumno($conexion){
            if(Token::comprobar_token_frm("frm_creacion_alumno",$_POST['tk_frm'])){
                $direccion = self::crear_direccion($conexion);
                $persona = self::crear_persona($conexion, $direccion);
                $semestre = 1;
                $periodo_inreso = self::obtener_periodo();
                $periodos_revalidados = empty($_POST['periodos_revalidados']) ? 0 : $_POST['periodos_revalidados'];
                
                $insert = $conexion->prepare("INSERT INTO t_alumno (fk_numero_control, fk_persona,id_cat_especialidad,id_cat_estatus,id_cat_carrera,id_cat_plan_estudio,id_cat_tipo_ingreso,lugar_nacimiento,semestre,periodo_ingreso,periodos_revalidados) VALUES (:fk_numero_control, :fk_persona,:id_cat_especialidad,:id_cat_estatus,:id_cat_carrera,:id_cat_plan_estudio,:id_cat_tipo_ingreso,:lugar_nacimiento,:semestre,:periodo_ingreso,:periodos_revalidados)");
                $insert -> bindParam(':fk_numero_control',$_POST['numero_control']);
                $insert -> bindParam(':fk_persona', $persona);
                $insert -> bindParam(':id_cat_especialidad',$_POST['especialidad']);
                $insert -> bindParam(':id_cat_estatus',$_POST['estatus_alumno']);
                $insert -> bindParam(':id_cat_carrera',$_POST['carrera_reticula']);
                $insert -> bindParam(':id_cat_plan_estudio',$_POST['plan_est']);
                $insert -> bindParam(':id_cat_tipo_ingreso',$_POST['tipo_ingresos']);
                $insert -> bindParam(':lugar_nacimiento',$_POST['lugar_nacimiento']);
                $insert -> bindParam(':semestre', $semestre);
                $insert -> bindParam(':periodo_ingreso', $periodo_inreso);
                $insert -> bindParam(':periodos_revalidados', $periodos_revalidados);            
                
                if($insert->execute()){
                    if(self::actualizar_estado_control($conexion)){
                        $nuevo_usuario = self::creacion_usuario ($conexion,$persona);
                        Imagen::cargar_img($nuevo_usuario, $_FILES["img_alumno"]);
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

        static function creacion_usuario ($conexion,$persona){
            $rol = 8;
            $desconectado = 0;
            $correo = self::generarCorreoInstitucional($conexion,);
            $password = self::generarPassword();
            $insert = $conexion->prepare("INSERT INTO t_usuario (fk_persona, id_cat_rol, estado, correo_usuario, password) VALUES (:fk_persona, :id_cat_rol, :estado, :correo_usuario, :password)");
            $insert -> bindParam(':fk_persona',$persona);
            $insert -> bindParam(':id_cat_rol',$rol);
            $insert -> bindParam(':estado', $desconectado);
            $insert -> bindParam(':correo_usuario',$correo);
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $insert -> bindParam(':password',$pass);

            if($insert->execute()){
                
                $id= $conexion->lastInsertId();
                
                
            }else{
                $id="";
            }
            return $id;            
        }

        static function crear_persona($conexion,$direccion){
            $na = "Mexicana";
            $insert = $conexion->prepare("INSERT INTO t_persona (id_cat_sexo,id_cat_estado_civil,id_cat_escolaridad,fk_direccion,nombre_persona,apellido_paterno,apellido_materno,curp,telefono,correo,fecha_nacimiento,nacionalidad) VALUES (:id_cat_sexo,:id_cat_estado_civil,:id_cat_escolaridad,:fk_direccion,:nombre_persona,:apellido_paterno,:apellido_materno,:curp,:telefono,:correo,:fecha_nacimiento, :nacionalidad)");
            $insert -> bindParam(':id_cat_sexo',$_POST['selector_sexo']);
            $insert -> bindParam(':id_cat_estado_civil',$_POST['selector_edo_civil']);
            $insert -> bindParam(':id_cat_escolaridad',$_POST['nivel_escolar']);
            $insert -> bindParam(':fk_direccion', $direccion);
            $insert -> bindParam(':nombre_persona',$_POST['nombres']);
            $insert -> bindParam(':apellido_paterno',$_POST['apellido_paterno']);
            $insert -> bindParam(':apellido_materno',$_POST['apellido_materno']);
            $insert -> bindParam(':curp',$_POST['curp']);
            $insert -> bindParam(':telefono',$_POST['telefono']);
            $insert -> bindParam(':correo',$_POST['correo_electronico']);
            $insert -> bindParam(':fecha_nacimiento',$_POST['fecha_nacimiento']);
            $insert -> bindParam(':nacionalidad',$na);
            
            if($insert->execute()){
                $id= $conexion->lastInsertId();
            }else{
                $id="";
            }
            return $id;            
        }

        static function crear_direccion($conexion){
            $no_interior = empty($_POST['no_interior']) ? "s/n" : $_POST['no_interior'];
            $no_exterior = empty($_POST['no_exterior']) ? "s/n" : $_POST['no_exterior'];
            if(isset($_POST['escritura'])){
                self::insertar_direccion_cat($conexion);
            }
            $insert = $conexion->prepare("INSERT INTO t_direccion (codigo_postal,estado,alcaldia,colonia,calle,numero_interior,numero_exterior
            ) VALUES (:codigo_postal,:estado,:alcaldia,:colonia,:calle,:numero_interior,:numero_exterior)");
            $insert -> bindParam(':codigo_postal',$_POST['codigo_postal']);
            $insert -> bindParam(':estado',$_POST['estado']);
            $insert -> bindParam(':alcaldia',$_POST['alcaldia']);
            $insert -> bindParam(':colonia',$_POST['colonia']);
            $insert -> bindParam(':calle',$_POST['calle']);
            $insert -> bindParam(':numero_interior',$no_interior);
            $insert -> bindParam(':numero_exterior',$no_exterior);
            if($insert->execute()){
                $id= $conexion->lastInsertId();
            }else{
                $id="";
            }
            return $id;            
        }

        static function insertar_direccion_cat($conexion){
            $insert = $conexion->prepare("INSERT INTO t_cat_data_dir (codigo_postal, colonia, alcaldia, estado) VALUES (:codigo_postal, :colonia, :alcaldia, :estado)");
            $insert -> bindParam(':codigo_postal',$_POST['codigo_postal']);
            $insert -> bindParam(':colonia',$_POST['colonia']);
            $insert -> bindParam(':alcaldia',$_POST['alcaldia']);
            $insert -> bindParam(':estado',$_POST['estado']);
            $insert->execute();
        }

        static function actualizar_estado_control($conexion){
            if(Token::comprobar_token_frm("frm_creacion_alumno",$_POST['tk_frm'])){
                $estado = "asignado";
                $sql = $conexion -> prepare("UPDATE t_numero_control SET estatus= :estatus WHERE id_numero_control = :id_numero_control");
                $sql -> bindParam(':estatus', $estado);
                $sql -> bindParam(':id_numero_control',$_POST['numero_control']);
                return $sql -> execute();
            }else{
                echo "Solicitud no valida";
            }
            
        }

        static function obtener_periodo(){
            date_default_timezone_set('America/Mexico_City');
            $fecha_footer = date("Y-m-d");
            $mes_actual = date("m");
            $year_actual = date("Y");
            return $mes_actual <= 6 ? "" . $year_actual . "1" : "" . $year_actual . "3";
        }

        static function generarCorreoInstitucional($conexion){
            
            $select = $conexion -> prepare("SELECT numero_control FROM t_numero_control WHERE id_numero_control = :id_numero_control");
            $select -> bindParam(':id_numero_control',$_POST['numero_control']);
            $select -> execute();
            $numero_control = $select -> fetch(PDO::FETCH_ASSOC);
            $correo_institucional = 'l' . $numero_control['numero_control'] . '@milpaalta2.tecnm.mx';
            Conector::cerrar_conexion();   
            return $correo_institucional;
            
        }
    
        static function generarPassword() { 
            return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8); 
        }  

        static function mandar_info_correo($conexion,$correo,$pass_descrip){
            $correo = $_POST['correo'];
            $correo_electronico = new PHPMailer();
            $correo_electronico -> isSMTP();
            $correo_electronico -> SMTPAuth = true;
            $correo_electronico -> SMTPSecure = 'tls';
            $correo_electronico -> Host ='smtp.live.com';
            $correo_electronico -> Port = '587';
            $correo_electronico -> Username = 'amaterasu.system.itma@gmail.com';
            $correo_electronico -> Password = 'proyectoAmaterasu04';
            $correo_electronico -> setFrom('amaterasu.system.itma@gmail.com', 'Instituto Tecnologico de Milpa Alta II');
            $correo_electronico -> addAddress($correo, 'Informacion de tu cuenta');
            $correo_electronico -> Subject = 'Felicidades ha sido inscrito exitosamente en el Instituto Tecnologico de Milpa Alta II';
            $correo_electronico -> Body = ' 
                                            <img src="http://itmilpaalta2.net/img/itma2.png" style="width: 200px; height: auto;">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Logo-TecNM-2017.png" style="width: 300px; height: auto; margin-left: 100px">
                                            <h2>Instituto Tecnologico de Milpa Alta II</h2><br>
                                            <h4>Sistema Integral de Informacion:</h4>
                                            <br>
                                            <p>A continuacion encontraras tus nuevos datos de inicio de sesion:</p>
                                            <p style="color:#142d54;"><b>Correo Institucional:  '.$correo.'</b></p>
                                            <p style="color:#142d54;"><b>Password:  '.$pass_descrip.'</b></p>
                                            <br>
                                            <p>Por cuestiones de seguridad se recomienda cambiar el password despues de iniciar sesion</p>
                                        ';
    
            $correo_electronico -> isHTML(true);
            if($correo_electronico -> send()){
    
                $id= $conexion->lastInsertId();
                
            }else{
    
                $id="";
    
            }
            return $id;
        }

        static function pre_recorte_img(){
            Imagen::eliminar_archivo("../../public/img/se/fotografia.webp");
            Imagen::cargar_img("se", $_FILES["img_alumno"]);            
        }
    }
?>