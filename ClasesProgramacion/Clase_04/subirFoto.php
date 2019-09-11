<?php


require 'clases/archivo.php';


if (Archivo :: Subir())
{
    echo "Se pudo subir la imagen.";
    echo "<br>";
    Archivo :: MostrarArrayArchivo();
}




?>