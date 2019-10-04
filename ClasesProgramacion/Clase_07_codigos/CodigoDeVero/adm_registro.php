<?php
include_once ("usuario.php");
include_once ("AccesoDatos.php");

$logeo = isset($_POST["user"]) ? $_POST["user"] : NULL;

$objeto = json_decode($logeo);

$usuario = new Usuario();

$usuario->nombre = $objeto->nombre;
$usuario->apellido = $objeto->apellido;
$usuario->clave = $objeto->clave;
$usuario->correo = $objeto->correo;
$usuario->perfil = $objeto->perfil;
$usuario->estado = $objeto->estado;

echo $usuario->InsertarUsuario();



?>