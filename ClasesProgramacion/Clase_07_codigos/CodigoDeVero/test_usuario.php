<?php 
//'existe_bd'  ->   "usuario_login"      JSON(Correo y clave)
//Esta pagina me devuelve otro objeto json(existe(bool))
//Setear la variable de sesion
session_start();
include_once ("usuario.php");
include_once ("AccesoDatos.php");
$logeo = isset($_POST["usuario"]) ? $_POST["usuario"] : NULL;

$objeto = json_decode($logeo);
$usuario = new Usuario();
$clase = new stdClass();
$clase = $usuario->ExisteEnBD($objeto->correo,$objeto->clave);

if($clase->existe == true)
{
    $_SESSION["perfilUsuario"] =$clase->usuario->perfil;
}

echo json_encode($clase);



?>