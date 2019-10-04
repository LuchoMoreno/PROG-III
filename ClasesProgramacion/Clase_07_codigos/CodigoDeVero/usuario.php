<?php

//Agregar una busqueda mas que sera el login, donde estara el nombre apellido, (agregar un corre y clave) acceder al sql para modificarlo

class Usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave; //Valores que no se pueden repetir en nuestra tabla
    public $estado; 
    public $perfil;
    public $correo;//Valores que no se pueden repetir en nuestra tabla, hay que realizar una busqueda, si esta o no esta el valor con esa clave ( un booleano)
    public $foto;

    public function MostrarDatos()
    {
        return $this->id . " - " . $this->nombre. " - ". $this->apellido . " - " . $this->clave . " - " . $this->estado. " - ".$this->perfil. " - ".$this->correo;
    }

    public static function TraerTodosLosUsuarios()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new Usuario);                                                

        return $consulta; 
    }

    public function InsertarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
       $destino = "./fotos/" . date("Ymd_His") . ".jpg";
        
        move_uploaded_file($_FILES["foto"]["tmp_name"], $destino) ;

        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(id, nombre, apellido, clave,perfil,estado,correo,foto)"
                                                    . "VALUES(:id, :nombre, :apellido,:clave,:perfil,:estado,:correo,:foto)");
        
        $consulta->bindValue(':id', $this->id);
        $consulta->bindValue(':nombre', $this->nombre);
        $consulta->bindValue(':apellido', $this->apellido);
        $consulta->bindValue(':correo', $this->correo);
        $consulta->bindValue(':clave', $this->clave);
        $consulta->bindValue(':perfil', $this->perfil);
        $consulta->bindValue(':estado', $this->estado);
        $consulta->bindValue(':foto',$destino);

        $consulta->execute();   

    }
    
    public static function ModificarUsuario($id, $nombre, $apellido, $corre,$clave, $estado, $perfil)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET nombre = :nombre, apellido = :cantante,jahr = :anio WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':titulo', $titulo, PDO::PARAM_INT);
        $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarCD($cd)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");
        
        $consulta->bindValue(':id', $cd->id, PDO::PARAM_INT);

        return $consulta->execute();

    }

    public function ExisteEnBD($correo,$clave)
    {
        $json = new stdClass(); 

        $json->existe = false;

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo=:correo && clave=:clave");        

        $consulta->bindValue(":correo",$correo);

        $consulta->bindValue(":clave",$clave);

        $consulta->execute(); 
        
        if($consulta->rowCount() == 1) //Tengo que verificar que se modificaron las columnas
        {
            $json->existe = true;
            $json->usuario = $consulta->fetchObject();
        }

        return $json;
         //En el swtich tengo que crear un objeto de tipo JSON 
        //Me tiene que devolver si existe en base de datos
        //Hace un select en usuario donde correo sea clave como parametro
    }

}

?>