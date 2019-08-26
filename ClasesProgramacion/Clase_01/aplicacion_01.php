// Dato un numero X, lo que devuelva sea la
// tabla de multiplicar de dicho numero;

<?php

function MostrarTabla($x)
{
    for ($i=0; $i<10; $i++)
    {
        $resultado = $x * $i;
        echo"<br>";
        printf("%d x %d = %d ", $x, $i, $resultado);
    }
}


MostrarTabla(3);

?>