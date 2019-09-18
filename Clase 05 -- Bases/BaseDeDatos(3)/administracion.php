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

        echo "<pre>";
        var_dump($user_arr);
        echo "</pre>";

        //CIERRO CONEXION
        mysqli_close($conection);

        break;

    case "TraerTodos_PorID":

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $id = $_POST["id"];
        $sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios` WHERE `id` =" . $id;

        $rs = $con->query($sql);

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

        echo "<pre>";
        var_dump($user_arr);
        echo "</pre>";

    
        mysqli_close($con);

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


        echo "<pre>";
        var_dump($user_arr);
        echo "</pre>";


        mysqli_close($con);


        break;

        case "CargarNuevoUsuario":
        $cargado = $_POST["cargar"];

        $con = @mysqli_connect($host, $user, $pass, $base2);
        $sql = $cargado;

        $rs = $con->query($sql);

        mysqli_close($con);

        echo $cargado;

        break;

    default:
        echo ":(";
}
