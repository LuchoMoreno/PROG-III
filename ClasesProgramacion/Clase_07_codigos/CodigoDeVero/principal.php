<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina principal</title>
</head>
<body>
    <table align="center">
    <caption><h1>Bienvenido!</h1></caption>
    <?php
    session_start();
    if($_SESSION["perfilUsuario"] == 1)
    {?>
        <tr>
        <td>Listado de usuarios <a href="test_pdf_usuarios.php">ingrese aqui</a></td>
        </tr>
    <?php
    }
    ?>
    <tr>
    <td>Listado de productos <a href="test_pdf_productos.php">ingrese aqui</a></td>
    </tr>
    <tr>
    <td> <a href="cerrar_sesion.php">Cerrar sesion</a></td>
    </tr>
    </table>   
</body>
</html>