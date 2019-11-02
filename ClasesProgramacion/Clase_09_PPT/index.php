<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// VERIFICADORA.
// DETERMINAR VERBO. 

require_once './clases/Ejercicios.php';
require_once './vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => SlimFramework");
    return $response;

});

$app->post('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("POST => SlimFramework");
    return $response;

});

$app->put('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("PUT => SlimFramework");
    return $response;

});

$app->delete('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("DELETE => SlimFramework");
    return $response;

});



///////////////////////////////////////////////////////////////////////////////////////
//////////                  EJERCICIOS QUE ESTAN EN EL .TXT                  //////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// PARA PROBAR ESTE EJERCICIO, ESCRIBIR EN POSTMAN:
// key: usuario         value: {"nombre":"Luciano","correo":"lucho.moreno@live.com","clave":"7319","perfil":"1"}
// body -> x-www-form-urlencoded.

$app->post('/ejercicios/Uno', function (Request $request, Response $response) {    
    $response->getBody()->write("<br> GET => SlimFramework ->> Felicidades. Entraste al SLIM pasando por el middleware!!");
    return $response;

})->add(\Ejercicios :: class . ':VerificarBaseDeDatos');





$app->run();