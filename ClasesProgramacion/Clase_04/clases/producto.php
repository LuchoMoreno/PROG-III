<?php

require "archivo.php";

class Producto
{
private $nombre;
private $cod_barra;  
private $_path;


public function __construct($nombre=null,$codbarra=null,$file=null){
    if($nombre!=null && $codbarra!=null && $file!=null){
       $this->_nombre=$nombre;
       $this->_codbarra=$codbarra;
       //$this->_path="./archivo/".$_FILES["archivo"]["name"];
       $this->_path="./archivo/".$file;
    }
}


public function toString(){

    return $this->_codbarra ." -- ". $this->_nombre." -- " .$this->_path. "\r\n";
}



public static function Guardar($producto){
    
    $path= "./archivos/productos.txt";
    Archivo::Subir();

    $archivo=fopen($path,"a");

    //$producto->file;

    if(fwrite($archivo,$producto->toString()))
    {
        fclose($archivo);
        return true;
    }
    else
    {
        return false;
    }
}

public static function TraerTodoslosProductos(){
    $productos= array();
    //$producs= array();
    $path= "archivos/productos.txt";
    $archivo=fopen($path,"r");
    while(!feof($archivo)){
        $a=explode("-",fgets($archivo));
        if(isset($a[1])){
            array_push($productos,new Producto($a[0],$a[1],$a[2]));
        }
    }
    fclose($archivo);
   /* for ($i=0; $i <count($productos) ; $i++) { 
        if(isset($productos[1])){
            $prod= new Producto($productos[0],$productos[1],$productos[2]);
            array_push($producs,$prod);
        }else{
            break;
        }
    }*/
 return $productos;
}


}

?>
