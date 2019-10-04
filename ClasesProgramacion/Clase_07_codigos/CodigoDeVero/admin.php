
PHP FormatterHomeFeaturesContactAbout
Bookmark and Share


 			
Welcome to the new PHP Formatter!
We've given PHP Formatter a new design as well as a new engine! The new engine features:
Blazingly fast, on the fly formatting of all scripts!
PHP 4 and PHP 5 support
Handy syntax check function
Ability to create your own coding styles, or to use builtin styles
Proper handling of doc comments, and alternative control structures


InputStyleFormat
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
96
97
98
99
100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
<?php

//Traer todos usuarios
//Declaramos el post de que hago para poder controlar el switch
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

//Declaramos las variables para poder conectarnos en sql
/*$host = "localhost";
$user = "root";
$pass = "";
$base = "mercado";
*/
//Recuperamos valores por POST
//Hay que setear los nombres como el $queHago y el null vendria a ser un else
///********USUARIOS******** */
$nombre   = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : NULL;
$perfil   = isset($_POST["perfil"]) ? $_POST["perfil"] : NULL;
$estado   = isset($_POST["estado"]) ? $_POST["estado"] : NULL;
$clave    = isset($_POST["clave"]) ? $_POST["clave"] : NULL;

//Primero conectamos a la base de datos
//$con = @mysqli_connect($host, $user, $pass,$base);

//Comprobamos que haya tenido exito la conexion
/*if(!$con)
{
echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
echo "error: " . mysqli_connect_error() . PHP_EOL . "</pre>";
return;
}*/
$conexion = "mysql:host=localhost;dbname=mercado;charset=utf8";
$user     = "root";
$pass     = "";

try {
    $pdo = new PDO($conexion, $user, $pass);
    
    echo "ESTOY ADENTRO DEL TRY";
    var_dump($queHago);
    switch ($queHago) {
        case "traerTodos_usuarios":
            
            $sql = "SELECT * FROM usuarios";
            
            $rs = $pdo->prepare($sql);
            $rs->execute();
            
            ///Crear una fila por cada usuario que tenga
            $tabla = "
                <table border='1'>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Perfil</td>
                        <td>Estado</td>
                    </tr>
    ";
            
            while ($elementos = $rs->fetch()) {
                $tabla .= "<tr>\t
        <td>" . $elementos[0] . "</td>\t
        <td>" . $elementos[1] . "</td>\t
        <td>" . $elementos[2] . "</td>\t
        <td>" . $elementos[3] . "</td>\t
        <td>" . $elementos[4] . "</td>\t
        </tr>";
            }
            $tabla .= "</table>";
            echo $tabla;
            break;
        case "traerPorId_usuarios":
            $id  = isset($_POST['id']) ? $_POST['id'] : NULL;
            $sql = "SELECT * FROM usuarios WHERE id=:id";
            
            $rs = $pdo->prepare($sql);
            
            $rs->execute(array(
                'id' => $id
            ));
            
            $tabla = "
    <table border='1'>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Perfil</td>
            <td>Estado</td>
        </tr>
";
            
            while ($elementos = $rs->fetch()) {
                $tabla .= "<tr>\t
<td>" . $elementos[0] . "</td>\t
<td>" . $elementos[1] . "</td>\t
<td>" . $elementos[2] . "</td>\t
<td>" . $elementos[3] . "</td>\t
<td>" . $elementos[4] . "</td>\t
</tr>";
                var_dump($elementos);
            }
            $tabla .= "</table>";
            echo $tabla;
            
            break;
        
        case "traerPorEstado_usuarios":
            
            $sql = "SELECT * FROM `usuarios` WHERE estado=6";
            $rs  = $con->query($sql);
            while ($row = $rs->fetch_object()) { //fetch_all / fetch_assoc / fetch_array([MYSQLI_NUM | MYSQLI_ASSOC | MYSQLI_BOTH])
                $user_arr[] = $row;
            }
            var_dump($user_arr);
            mysqli_close($con);
            break;
        
        case "agregar_usuarios":
            
            $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `perfil`, `estado`) 
            VALUES (:nombre,:apellido,:perfil,:clave,:estado)";
            $rs  = $pdo->prepare($sql);
            $rs->bindParam(':nombre', $nombre);
            $rs->bindParam(':apellido', $apellido);
            $rs->bindParam(':perfil', $perfil);
            $rs->bindParam(':clave', $clave);
            $rs->bindParam(':estado', $estado); //ME TIRA ERROR ACA ARREGLAR
            $rs->execute();
            
            echo ("Fueron afectadas: " . $rs->rowCount());
            
            break;
        
        case "modificar_usuarios":
            
            $sql = "UPDATE `usuarios` SET `nombre`='$nombre',`apellido`='$apellido',`clave`='$clave',`perfil`='$perfil',`estado`='$estado' WHERE id='4'";
            
            $rs = $con->query($sql);
            echo "<pre>Filas afectadas: " . mysqli_affected_rows($con) . "<br>mysqli_affected_rows(con)</pre>";
            echo "Usuario modificado con exito!";
            
            break;
        
        case "borrar_usuarios":
            
            $sql = "DELETE FROM `usuarios` WHERE id='$id'";
            $rs  = $con->query($sql);
            echo "<pre>Filas afectadas: " . mysqli_affected_rows($con) . "<br>mysqli_affected_rows(con)</pre>";
            echo "Usuario borrado con exito!";
            
            break;
        
        default:
            echo "Error";
            
            
    }
    
}
catch (PDOEXCEPTION $e) {
    echo "Se produjo un error en la conexion!";
}


?>
