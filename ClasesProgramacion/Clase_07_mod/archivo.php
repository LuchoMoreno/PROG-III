<?php
//Establecemos la conexion y definimos variables
$conexion = "mysql:host=localhost;dbname=cdcol;charset=utf8";
$user ="root";
$pass = "";
try
{
    //Definimos un objeto de tipo PDO 
    $pdo = new PDO($conexion,$user,$pass);
    echo "Exito en la conexion!<br>";

    //Devolver una tabla con todos los cds que tengamos
    //Generar un Select*
    //Creamos la consulta que deseamos ejecutar
    $consulta = "SELECT * FROM cds";
    //Ejecutamos la consulta
    $consultaGeneral = $pdo->query($consulta);
    //Obtenemos los datos luego de la consulta, el fecthAll nos devuelve un array asociativo e indexado
    $resultado = $consultaGeneral->fetchall();
    //Mostramos lo que contiene el string
    //var_dump($resultado);

    //Recorremos el resutaldo para mostrarlo
    //Lo tengo que poner ne una hermosa tabla <3
    $tabla = "<table border='1'>\t
                <tr>\t
                <td>titel</td>\t
                <td>interpret</td>\t
                <td>jahr</td>\t
                <td>id</td>\t
                </tr>";

    foreach($resultado as $cosas)
    {
        $tabla .="<tr>\t
            <td>. $cosas[0] .</td>\t
            <td>. $cosas[1] .</td>\t
            <td>. $cosas[2] .</td>\t
            </tr>";
    }

    $tabla .="</table>";
    echo $tabla;

}
catch(PDOEXCEPTION $e) //Para comprobar que se establecio la conexion, comprobamos con un catch
{
    echo "Se produjo un error en la conexion!";
}



?>