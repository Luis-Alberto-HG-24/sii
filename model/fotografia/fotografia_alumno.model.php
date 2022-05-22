<?php
    class Imagen{
        static function cargar_img($id_persona, $img){
            if($img["name"]){        
                if($img["size"] <= 2000*1024){                        
                    $ruta = '../../public/img/'.$id_persona.'/';
                    $archivo = $ruta.$img["name"];        
                    $validarTipo= strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

                    if ($validarTipo=='jpg' || $validarTipo=='jpeg') {
                        $archivo = $ruta.'fotografia.webp';
                        if(!file_exists($ruta)){
                            mkdir($ruta);
                        }				
        
                        $resultado = @move_uploaded_file($img["tmp_name"], $archivo);
        
                        if ($resultado) {
                            //echo 2;
                            if(!empty($_POST['medidas_recorte'])){
                                self::recortar_imagen($archivo);
                            }
                            
                        }        
                    }else{
                        echo "El formato de imagen no es valido. Solo es permitido JPG y PNG";
                    }
                    
                }else{
                    echo "La imagen subida es demasiado pesada el peso maximo es de 2MB!";
                }	
            }else {
                echo "No hay un archivo";
            }	
        }

        static function recortar_imagen($ruta_img){
            $targ_w = 500;
            $targ_h = 500;
            $jpeg_quality = 100;

            $image = imagecreatefromjpeg($ruta_img);  

            imagewebp($image, $ruta_img, 100);

            $medida = explode("m", $_POST['medidas_recorte']);

            $img_r = imagecreatefromwebp($ruta_img);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r,$img_r,0,0, $medida[1], $medida[2],$targ_w,$targ_h, $medida[3], $medida[4]);

            if(!imagewebp($dst_r, $ruta_img, $jpeg_quality)){
                return "Error";
            }
            //echo 'x='. $medida[1] . 'y=' . $medida[2] . 'w=' .$medida[3] . 'h='. $medida[4];
        }

        static function eliminar_archivo($archivo){
            //$file=$_POST['archivo_dir'];
            $file= $archivo;	
            if(is_file($file)){
                if(!unlink($file)){
                    //echo "2";
                }
            }
        }
    }

?>