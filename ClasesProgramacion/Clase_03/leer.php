<?php

$archivo = fopen ("saludo.txt", "r");


while(!feof($archivo))
{
    echo fgets($archivo); // fgets: devuelve una linea
}

fclose($archivo);


?>