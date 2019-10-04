<?php
//Guardar en una variable sesion 
class Producto
{
    public $id;
    public $nombre;
    public $codigo_barra;
    public $path_foto;

    public function MostrarDatos()
    {
        return $this->id . " - " . $this->nombre. " - ". $this->codigo_barra . " - " . $this->path_foto;
    }

    public static function TraerTodosLosProductos()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM productos WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new Producto);                                                

        return $consulta; 
    }


}

?>
