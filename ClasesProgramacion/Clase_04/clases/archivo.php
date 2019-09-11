<?php
    class Archivo{
        public static function Subir() : bool {
            // recuperar toda la info del archivo y aplicar una validación del archivo que se intenta subir
            // si la validación es correcta va a validar el archivo y lo guarda
            
            $uploadOk = TRUE;
           
            $destino="./archivos/".$_FILES["archivo"]["name"];
            
            
            $esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
            $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
           
            
            if($esImagen === FALSE) {//NO ES UNA IMAGEN

                //SOLO PERMITO CIERTAS EXTENSIONES
                if($tipoArchivo != "doc" && $tipoArchivo != "txt" && $tipoArchivo != "rar") 
                {
                    echo "Solo son permitidos archivos con extension DOC, TXT o RAR.";
                    $uploadOk = FALSE;
                }
            }
            else {// ES UNA IMAGEN
            
                //SOLO PERMITO CIERTAS EXTENSIONES
                if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif" && $tipoArchivo != "png")
                {
                    echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
                    $uploadOk = FALSE;
                }
            }

                move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);
                $uploadOk = TRUE;
                return $uploadOk;
            }



            public static function MostrarArrayArchivo()
            {
                echo "<br/>";
                var_dump($_FILES);
                echo "<br/>";
            }

        }

        
?>