<?php

class Archivo
{
    function Subir() : bool
    {
        $uploadOk = FALSE;

        $destino = "archivos/" . $_FILES["archivo"]["name"];

        if ($_FILES["archivo"]["size"] > 5000000) {
            echo "El archivo es demasiado grande.";
            $uploadOk = FALSE;
        }

        if (file_exists($destino)) {
            echo "El archivo ya existe.";
            $uploadOk = FALSE;
        }
        
        if ($uploadOk === FALSE) {
        echo "<br/>NO SE PUDO SUBIR EL ARCHIVO.";
        } 
        else {
          move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
          $uploadOk = TRUE;
        }


    return $uploadOk;
    }


}


?>
