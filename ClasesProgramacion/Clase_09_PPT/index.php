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

// 1) --- Hacer un middleware de aplicacion que tome usuario y contraseña y verifique en BD.

// 2) --- Hacer middleware de grupo, solo para post, que permita agregar un nuevo usuario, si el perfil es -- admin.

// 3) --- Hacer middleware de grupo, solo para delete, que permita borrar un usuario, si el perfil es -- super_admin.

// 4) --- Hacer middleware de ruta, solo para put y get, que tome el tiempo de demora entre que entra y sale la peticion.

///////////////////////////////////////////////////////////////////////////////////////



// PARA PROBAR ESTE EJERCICIO, ESCRIBIR EN POSTMAN:
// url: http://localhost/Clase_09_PPT/ejercicios/Uno
// key: usuario         value: {"nombre":"Luciano","correo":"lucho.moreno@live.com","clave":"7319","perfil":"1"}
// body -> x-www-form-urlencoded.

$app->post('/ejercicios/Uno', function (Request $request, Response $response) {    
    $response->getBody()->write("<br> POST => SlimFramework - Felicidades. Entraste al SLIM pasando por el middleware!!");
    return $response;

})->add(\Ejercicios :: class . ':VerificarBaseDeDatos');





$app->group('/grupoEjercicios', function () 
{


    // url: http://localhost/Clase_09_PPT/grupoEjercicios/dos
    // key: usuario         value: {"nombre":"Nuevo","apellido":"Usuario","correo":"prueba@live.com","clave":"1234","perfil":"1","estado":"1", "foto":"NULL"}
    // body -> x-www-form-urlencoded.

    $this->post('/dos', function (Request $request, Response $response) {    
        $response->getBody()->write("<br> POST => SlimFramework - Felicidades. Entraste al SLIM pasando por el middleware!!");

        return $response;

    })->add(\Ejercicios :: class . ':AgregarUnUsuario');




    // url: http://localhost/Clase_09_PPT/grupoEjercicios/tres
    // key: usuario         value: {"nombre":"Nuevo","apellido":"Usuario","correo":"prueba@live.com","clave":"1234","perfil":"2","estado":"1", "foto":"NULL"}
    // body -> x-www-form-urlencoded.

    $this->post('/tres', function (Request $request, Response $response) {    
        $response->getBody()->write("<br> POST => SlimFramework - Felicidades. Entraste al SLIM pasando por el middleware!!");

        return $response;

    })->add(\Ejercicios :: class . ':EliminarUnUsuario');





});




$app->run();