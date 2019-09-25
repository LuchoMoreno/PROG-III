<?php


$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "productos";
$base2 = "mercado";

switch ($queHago) {

    case "TraerTodos_Usuarios":


            $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);

            $sql = $objetoPDO->prepare("SELECT id, nombre, apellido, clave, perfil,estado FROM usuarios");
            
            $sql->execute();


            $tabla .= "</table>";
                
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";

            while($fila = $sql->fetch()){

                $table .=   "<tr>
                                    <td>{$fila[0]}</td>
                                    <td>{$fila[1]}</td>
                                    <td>{$fila[2]}</td>
                                    <td>{$fila[3]}</td>
                                    <td>{$fila[4]}</td>
                                </tr>";
            }


            $table .= "</table>";


            echo "<pre>";
            echo ($table);
            echo "</pre>";

        break;

    case "TraerTodos_PorID":

            // $con = @mysqli_connect($host, $user, $pass, $base2);
            $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);
            
             $id = $_POST["id"];
             
             //$sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios` WHERE `id` =" . $id;
             $sql = $objetoPDO->prepare("SELECT id, nombre, apellido, clave, perfil,estado FROM usuarios WHERE id= :id");
             
             $sql->bindParam(':id',$id);
            
             $sql->execute();
            
             //$rs = $con->query($sql);
             //var_dump($sentencia->fetch());


            $tabla .= "</table>";
                
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";

            while($fila = $sql->fetch()){

                $table .=   "<tr>
                                    <td>{$fila[0]}</td>
                                    <td>{$fila[1]}</td>
                                    <td>{$fila[2]}</td>
                                    <td>{$fila[3]}</td>
                                    <td>{$fila[4]}</td>
                                </tr>";
            }


            $table .= "</table>";

            echo "<pre>";
            echo ($table);
            echo "</pre>";
               
        break;

    case "TraerTodos_PorEstado":


            $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);
                
            $estado = $_POST["estado"];
            
            $sql = $objetoPDO->prepare("SELECT id, nombre, apellido, clave, perfil,estado FROM usuarios WHERE estado= :estado");
            
            $sql->bindParam(':estado',$estado);
        
            $sql->execute();
        
            $tabla .= "</table>";
                
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";

            while($fila = $sql->fetch()){

                $table .=   "<tr>
                                    <td>{$fila[0]}</td>
                                    <td>{$fila[1]}</td>
                                    <td>{$fila[2]}</td>
                                    <td>{$fila[3]}</td>
                                    <td>{$fila[4]}</td>
                                </tr>";
            }


            $table .= "</table>";

            echo "<pre>";
            echo ($table);
            echo "</pre>";


        break;

        case "CargarNuevoUsuario":
        $cargado = $_POST["cargar"];

        $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);
       
        $sql = $objetoPDO->prepare($cargado);

        $sql->execute();


        break;

        
        case "EliminarUsuario":
        $idEliminada = $_POST["idEliminar"];

        $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);
        
        $ejecutar = "DELETE FROM `usuarios` WHERE `id` =" . $idEliminada;

        $sql = $objetoPDO->prepare($ejecutar);

        $sql->execute();

       break;


       case "ModificarUsuario":
        $usuarioModificado = $_POST["cargarModificacion"];

        $objetoPDO = new PDO('mysql:host=localhost;dbname=mercado;charset=utf8', $user, $pass);

        $sql = $objetoPDO->prepare($usuarioModificado);

        $sql->execute();

       break;


    default:
        echo ":(";
}
