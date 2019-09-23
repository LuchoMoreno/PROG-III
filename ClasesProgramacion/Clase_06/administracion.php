<?php


$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";


switch ($queHago) {

    case "Establecer_Conexion":

        try{
            $conStr = 'mysql:host=localhost;dbname=cdcol;charset=utf8';
            $pdo = new PDO($conStr, $user, $pass);


            $resultado = $objPDO->query("SELECT * FROM cds");
            $arrayOBJ = $resultado->fechAll();


            foreach($arrayOBJ as $arrayResultados)
            {
                echo $arrayResultados;
            }

        }

        catch (PDOException $e)
        {
            echo "ERROR! " . $e->getmessage() . "<br/>";
        }
    break;

    case "traerCDS":

 
    break;

    default:
        echo ":(";
}
