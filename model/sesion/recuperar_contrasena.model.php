<?php
    require_once '../app/lib/php_mailer/PHPMailerAutoload.php';
    
     require_once '../conector.model.php';
    
    Conector::abrir_conexion();
    
    call_user_func('CambioContrasena::' . $_POST['funcion'], Conector::obtener_conexion());
    
    class CambioContrasena{
        
         static function seleccionar_email($conexion){
            $correo = $_POST['correo'];
            $select = $conexion->prepare('SELECT correo_usuario FROM t_usuario tu INNER JOIN t_persona tp ON tu.fk_persona = tp.id_persona WHERE tu.correo_usuario = :correo_usuario AND tp.correo = :correo');
            $select->bindParam(':correo_usuario', $correo);
            $select->bindParam(':correo', $_POST['correo_personal']);
            $select->execute();
            $contenido = $select->fetch(PDO::FETCH_ASSOC);
            if(!empty($contenido['correo_usuario'])){
                Self::update_password($conexion);
            
            }else{
                echo 0;
            }

            
        }
        
        static function update_password($conexion){
            $password = self::generarPassword();
            $update = $conexion->prepare("UPDATE t_usuario SET password = :password WHERE correo_usuario = :correo_usuario");
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $pass_descrip = $password;
            $update->bindParam(':password', $pass);
            $update->bindParam(':correo_usuario', $_POST['correo']);
            if($update->execute()){
                
                Self::mandar_correo($pass_descrip);
                Conector::cerrar_conexion(); 
            }else{
                echo 1;
            }
        }
        
        static function mandar_correo($pass_descrip){
            $correo = $_POST['correo'];
            $correo_electronico = new PHPMailer();
            $correo_electronico -> isSMTP();
            $correo_electronico -> SMTPAuth = true;
            $correo_electronico -> SMTPSecure = 'tls';
            $correo_electronico -> Host ='smtp.live.com';
            $correo_electronico -> Port = '587';
            $correo_electronico -> Username = 'tecnologico_milpaalta2@outlook.com';
            $correo_electronico -> Password = 'proyectomilpaalta2';
            $correo_electronico -> setFrom('tecnologico_milpaalta2@outlook.com', 'Instituto Tecnologico de Milpa Alta II');
            $correo_electronico -> addAddress($correo, 'Recuperacion de cuenta');
            $correo_electronico -> Subject = 'Tu proceso de recuperacion de cuenta ha iniciado.';
            $correo_electronico -> Body = ' 
                                            <img src="http://itmilpaalta2.net/img/itma2.png" style="width: 200px; height: auto;">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Logo-TecNM-2017.png" style="width: 300px; height: auto; margin-left: 100px">
                                            <h2>Instituto Tecnologico de Milpa Alta II</h2><br>
                                            <h4>Sistema Integral de Informacion:</h4>
                                            <br>
                                            <p>Has solicitado un cambio de password a continuacion se mostraran tus nuevos datos:</p>
                                            <p style="color:#142d54;"><b>Correo Institucional:  '.$correo.'</b></p>
                                            <p style="color:#142d54;"><b>Password:  '.$pass_descrip.'</b></p>
                                            <br>
                                            <p>Por cuestiones de seguridad se recomienda cambiar el password despues de iniciar sesion</p>
                                        ';
    
            $correo_electronico -> isHTML(true);
        
            if($correo_electronico -> send()){
    
                echo 3;
                
            }else{
    
                echo 2;
    
            }
        }


        static function generarPassword() { 
            return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8); 
        }  



    } 

    


?>