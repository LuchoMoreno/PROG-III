<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/usuario.php';

header('content-type:application/pdf');


$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal



$mpdf->SetHeader('{DATE j-m-Y}||{PAGENO}{nbpg}');
//alineado izquierda | centro | alineado derecha
$mpdf->setFooter('{DATE Y}|Programacón III|{PAGENO}');


$ArrayUsuarios = usuario::TraerTodosLosUsuarios();

$grilla = '<table class="table" border="1" align="center">
            <thead>
                <tr>
                    <th>  ID </th>
                    <th>  NOMBRE     </th>
                    <th>  APELLIDO       </th>
                    <th>  CORREO       </th>
                    <th>  CLAVE       </th>
                    <th>  PERFIL       </th>
                    <th>  ESTADO       </th>
                    <th>  FOTO       </th>
                </tr> 
            </thead>';   	


var_dump($ArrayUsuarios);


$grilla .= '</table>';



?>
