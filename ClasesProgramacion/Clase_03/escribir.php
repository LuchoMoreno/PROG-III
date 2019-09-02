<?php

$abrir = fopen("saludo.txt", "w+");
$escribir = fwrite($abrir, "Hola mundo!");

if ($escribir > 0)
{
    echo "Se pudo escribir";
}
else
{
    echo "Male sal";
}


fwrite($abrir, "<br>");
fwrite($abrir, "Luciano");
fwrite($abrir, "<br>");
fwrite($abrir, "Moreno");

fclose($abrir);


?>