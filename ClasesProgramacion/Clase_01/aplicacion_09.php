<?php

/* 
Aplicación Nº 9 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand ). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

*/

$acumulador = 0;


for ($i=0; $i<5; $i++)
{

    $vector[$i] = rand(1, 100);

    $valor = $vector[$i];
    $acumulador = $acumulador + $valor;
    
}

var_dump($vector);

echo "<br>";
echo "La suma es: ", $acumulador;

$promedio = $acumulador / 6;

if ($promedio == 6)
{
    echo "El promedio es igual a 6";
}
else if ($promedio < 6)
{
    echo "El promedio es menor a 6";
}
else
{
    "El promedio es mayor a 6";
}



?>