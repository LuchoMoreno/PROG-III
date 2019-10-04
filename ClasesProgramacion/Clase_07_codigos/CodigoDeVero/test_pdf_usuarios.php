<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/usuario.php';
require_once __DIR__ . '/AccesoDatos.php';

//header('content-type:application/pdf');
if($_SESSION["perfilUsuario"]== 1)
{
    
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
'pagenumPrefix' => 'Página nro. ',
'pagenumSuffix' => ' - ',
'nbpgPrefix' => ' de ',
'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal



$mpdf->SetHeader('{DATE j-m-Y}||{PAGENO}{nbpg}');
//alineado izquierda | centro | alineado derecha
$mpdf->setFooter('{DATE Y}|Programacón III|{PAGENO}');


$ArrayDeProductos = Usuario::TraerTodosLosUsuarios();

$grilla = '<table class="table" border="1" align="center">
<thead>
<tr>
<th>  ID </th>
<th>  NOMBRE </th>
<th>  APELLIDO     </th>
<th>  CORREO       </th>
<th>  ESTADO </th>
<th>  PERFIL     </th>
<th>  FOTO       </th>
</tr> 
</thead>';   	

foreach ($ArrayDeProductos as $prod){

$grilla .= "<tr>
<td>".$prod->id."</td>
<td>".$prod->nombre."</td>
<td>".$prod->apellido."</td>
<td>".$prod->estado."</td>
<td>".$prod->correo."</td>
<td>".$prod->perfil."</td>
<td><img src='".$prod->foto."' width='100px' height='100px'/></td>
</tr>";
}

$grilla .= '</table>';

$mpdf->WriteHTML("<h3>Listado de usuarios</h3>");
$mpdf->WriteHTML("<br>");

$mpdf->WriteHTML($grilla);


$mpdf->Output('mi_pdf.pdf', 'I');

}
else
{
    header("Location:principal.php");
}

?>