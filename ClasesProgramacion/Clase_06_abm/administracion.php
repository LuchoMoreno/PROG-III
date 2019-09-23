<?php


$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "productos";
$base2 = "mercado";

switch ($queHago) {

    case "TraerTodos_Usuarios":

        $con = @mysqli_connect($host, $user, $pass, $base2);

        $sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios`";

        $rs = $con->query($sql);


        while ($row = $rs->fetch_object()) {
            $user_arr[] = $row;
        }

        //INICIO TABLA
        $table =    "<table border='1'>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Perfil</td>
            <td>Estado</td>
        </tr>";
        //INICIO TABLA


        //DATOS 
        if (mysqli_affected_rows($con) > 0) {
            for ($i = 0; $i < mysqli_affected_rows($con); $i++) {
                $table .=   "<tr>
                                <td>" . $user_arr[$i]->id . "</td>
                                <td>" . $user_arr[$i]->nombre . "</td>
                                <td>" . $user_arr[$i]->apellido . "</td>
                                <td>" . $user_arr[$i]->perfil . "</td>
                                <td>" . $user_arr[$i]->estado . "</td>
                            </tr>";
            }
        } else {
            $table .= "<tr>
                        <td align='center' colspan='5'>NO EXISTEN USUARIOS</td>
                    </tr>";
        }
        //DATOS

        //CIERRO TABLA
        $table .= "</table>";
        //CIERRO TABLA

        //MUESTRO LA TABLA POR ECHO
        echo "<pre>";
        echo ($table);
        echo "</pre>";


        //CIERRO CONEXION
        mysqli_close($con);

        break;

    case "TraerTodos_PorID":

        $conStr = 'mysql:host=localhost;dbname=cdcol;charset=utf8'; 
        $pdo = new PDO($conStr, $user, $pass);
        $id = $_POST["id"];

        $sentencia = $pdo->prepare("SELECT id, nombre, apellido, clave, perfil, estado FROM usuarios WHERE id =:id");
        $sentencia->bindParam(":id", $id);

        $sentencia->execute();

        $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            while($fila = $sentencia->fetch()){
                $tabla .= "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila['anio']}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;
        
        break;

    case "TraerTodos_PorEstado":

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $estado = $_POST["estado"];
        $sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios` WHERE `estado` =" . $estado;

        $rs = $con->query($sql);
        $user_arr = NULL;

        while ($row = $rs->fetch_object()) {
            $user_arr[] = $row;
        }


        $table =    "<table border='1'>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Perfil</td>
            <td>Estado</td>
        </tr>";

        if (mysqli_affected_rows($con) > 0) {
            for ($i = 0; $i < mysqli_affected_rows($con); $i++) {
                $table .=   "<tr>
                        <td>" . $user_arr[$i]->id . "</td>
                        <td>" . $user_arr[$i]->nombre . "</td>
                        <td>" . $user_arr[$i]->apellido . "</td>
                        <td>" . $user_arr[$i]->perfil . "</td>
                        <td>" . $user_arr[$i]->estado . "</td>
                    </tr>";
            }
        } else {
            $table .= "<tr>
                <td align='center' colspan='5'>NO EXISTEN USUARIOS</td>
            </tr>";
        }

        $table .= "</table>";


        echo "<pre>";
        echo ($table);
        echo "</pre>";

        mysqli_close($con);


        break;

        case "CargarNuevoUsuario":
        $cargado = $_POST["cargar"];

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $sql = $cargado;

        $rs = $con->query($sql);

        echo "Codigo generado: " + $cargado;

        mysqli_close($con);


        break;

        
        case "EliminarUsuario":
        $idEliminada = $_POST["idEliminar"];

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $sql = "DELETE FROM `usuarios` WHERE `id` =" . $idEliminada;

        $rs = $con->query($sql);

        mysqli_close($con);

       break;


       case "ModificarUsuario":
        $usuarioModificado = $_POST["cargarModificacion"];

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $sql = $usuarioModificado;

        $rs = $con->query($sql);

        echo "Codigo generado: " + $usuarioModificado;

        mysqli_close($con);

       break;


    default:
        echo ":(";
}
