<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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
    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->post('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("POST => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->put('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("PUT => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->delete('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("DELETE => Bienvenido!!! a SlimFramework");
    return $response;

});

// Los parametros van entre { }
// El nombre: Obligatorio - Se pone con {} por ser un parametro.
// El apellido: Oopcional - Se pone con [] por opcional, con {} por ser un parametro.
$app->get('/parametros/{nombre}[/{apellido}]', function (Request $request, Response $response, $args) { 
    $nombrePam = $args['nombre'];
    $apellidoPam = $args['apellido'];
    $response->getBody()->write("El nombre obligatorio: " . $nombrePam . " y el apellido opcional: " . $apellidoPam);
    return $response;

});


// Grupo 1 - La primer funcion POST muestra los parametros enviados.
//          - La segunda funcion GET recibe parametros y crea un JSON.
$app->group('/json', function () 
{
    $this->post('/', function (Request $request, Response $response) {    
    var_dump($request->getParsedBody());

    $fotoArray = $request->getUploadedFiles();
    $destino="./fotos/";

    $nombreAnterior=$fotoArray['foto']->getClientFilename();
    $extension= explode(".", $nombreAnterior)  ;
    $extension=array_reverse($extension);
    $fotoArray['foto']->moveTo($destino.$titulo.".".$extension[0]);

    });


    $this->get('/', function (Request $request, Response $response) {    
        $std = new stdClass();
        $std->nombre = 'Lucho';
        $std->apellido = 'Moreno';
        $nuevaRta = $response->withJson($std, 200);
        return $nuevaRta;
    });


    // EN POSTMAN HAY QUE PONER:
    // "KEY: json" // "VALUE: {"nombre":"Luciano","apellido":"Moreno"}"
    // y en x-www-form...."
    
    $this->put('/', function (Request $request, Response $response) {   
        $array = $request->getParsedBody();
        $JSONRecibido = json_decode($array['json']);
       
        $std = new stdClass();
        $std->nombre = $JSONRecibido->apellido;
        $std->apellido = $JSONRecibido->nombre;

        $nuevaRta = $response->withJson($std, 200);

        return $nuevaRta;

    });

});



/*
COMPLETAR POST, PUT Y DELETE
*/

$app->run();