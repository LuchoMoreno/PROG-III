<?php


$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "productos";
$base2 = "mercado";

switch($queHago){

    case "TraerTodos_Usuarios":

        $con = @mysqli_connect($host, $user, $pass, $base2);
        
        $sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios`";

        $rs = $con->query($sql);

        
        echo "<pre>";
        var_dump($rs);
        echo "</pre>";


        while ($row = $rs->fetch_object())
        { 
            $user_arr[] = $row;
        }  
        echo "<pre>";
        var_dump($user_arr); 
        echo "</pre>";


        echo "<pre>
        
        Cantidad de filas: " . mysqli_num_rows($rs) . "<br>mysqli_num_rows(rs)</pre>";  
        mysqli_close($con);
        
        echo "<pre>mysqli_close(con);</pre>";
        
    break;

    case "TraerTodos_PorID":

    $con = @mysqli_connect($host, $user, $pass, $base2);
    $id = $_POST["id"];
    $sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios` WHERE `id` =" . $id;

    $rs = $con->query($sql);

    

    echo "<pre>";
    var_dump($rs);
    echo "</pre>";


    $row = $rs->fetch_object();
    
    echo "<pre>";
    var_dump($row); 
    echo "</pre>";


    echo "<pre>
    
    Cantidad de filas: " . mysqli_num_rows($rs) . "<br>mysqli_num_rows(rs)</pre>";  
    mysqli_close($con);
    
    echo "<pre>mysqli_close(con);</pre>";
  
break;

case "TraerTodos_PorEstado":

$con = @mysqli_connect($host, $user, $pass, $base2);

$sql = "SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado` FROM `usuarios`";

$rs = $con->query($sql);

echo "<pre>
    con = mysqli_connect(host, user, pass, base); 
    sql = 'SELECT * FROM usuarios';
    rs = con->query(sql);
</pre>";

echo "<pre>";

var_dump($rs);

echo "</pre>";

echo "<pre>Cantidad de filas: " . mysqli_num_rows($rs) . "<br>mysqli_num_rows(rs)</pre>";  

mysqli_close($con);

echo "<pre>mysqli_close(con);</pre>";

break;


    default:
        echo ":(";

}