<?php

echo "Hola ";

echo "mundo";

echo "<br>";


$nombre = "luCIAno";
$apellido = "moReNO";


$nombreModificado = strtolower($nombre);
$nombreModificado2 = ucfirst($nombreModificado);

$apellidoModificado = strtolower($apellido);
$apellidoModificado2 = ucfirst($apellidoModificado);



echo $nombreModificado2 . $apellidoModificado2;




?>