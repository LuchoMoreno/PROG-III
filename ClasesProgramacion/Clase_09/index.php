<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// VERIFICADORA.
// DETERMINAR VERBO. 

require_once './clases/verificadora.php';
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
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$app->group('/credenciales', function () 
{
    $this->post('/', function (Request $request, Response $response) {    
        $response->getBody()->write("   DESDE API => GRUPO - POST");


        return $response;

    });

    $this->get('/', function (Request $request, Response $response) {    
    $response->getBody()->write("   DESDE API => GRUPO - GET");
    return $response;

    });


})->add(function ($request, $response, $next) {

    if ($request->isGet())
    {
        $response->getBody()->write("DESDE MIDDLEWARE - GET // "); 
        $response = $next($request, $response); 

    }

    if ($request->isPost())
    {
        $response->getBody()->write("DESDE MIDDLEWARE - POST // ");
        
        $array = $request->getParsedBody();
        var_dump($request->getParsedBody());
        $JSONRecibido = json_decode($array['json']);
        $JSONRecibido->nombre;

        if ($JSONRecibido->tipo == "Administrador")
        {
            $response->getBody()->write("..... USTED ES ADMINISTRADOR." . "  SU NOMBRE ES: " . $JSONRecibido->nombre);
            $response = $next($request, $response);  
        }

        else
        {
            $response->getBody()->write("...... USTED NO ES ADMINISTRADOR. ");
        }

        
    }

    return $response;
});


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$app->group('/credenciales/POO', function () 
{
    $this->post('/', function (Request $request, Response $response) {    
        $response->getBody()->write("   DESDE API => GRUPO - POST");

        return $response;

    });

    $this->get('/', function (Request $request, Response $response) {    
    $response->getBody()->write("   DESDE API => GRUPO - GET");
    return $response;

    });

})->add(\Verificadora :: class . ':Verificar');


$app->run();