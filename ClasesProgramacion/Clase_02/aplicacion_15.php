

<?php

/*
Aplicación Nº 15 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow ).
*/


function MostrarPotencia($x)
{
    for ($i=1; $i<5; $i++)
    {

        $potencia = math.pow($i, $i);
        echo $potencia;

    }
}


MostrarPotencia(3);

?>