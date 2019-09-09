<?php

class Producto
{
private $nombre;
private $cod_barra;  


public function __construct($nombreParametro = NULL, $cod_barraParametro = NULL)
{
    $this->nombre = $nombreParametro;
    $this->cod_barra = $cod_barraParametro;
}


public function ToString() : strings
{
    return $this->nombre + "--" + $this->cod_barra;
}


public static function Guardar (Producto $obj) : bool
{
    $retorno;
    $abrir = fopen("producto.txt", "w+");
    $escribir = fwrite($abrir, $obj->ToString());
    
    if ($escribir > 0)
    {
        echo "Se pudo escribir";
        $retorno = true;
    }
    else
    {
        echo "Male sal";
        $retorno = false;
    }

    return $retorno;
}





}

?>
