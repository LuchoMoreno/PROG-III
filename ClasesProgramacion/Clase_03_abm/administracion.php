<?php

require 'clases\producto.php';

$opcion = "ALTA";

switch($opcion)
{
    case "ALTA":

    $producto = new Producto("Lalala", "1234");

    if(Producto::Guardar($producto))
    {
        echo "Exitoso";
    }

    else
    {
        echo "Error";
    }

    case 2:




}


?>