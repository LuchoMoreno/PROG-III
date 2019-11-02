<?php

class Verificadora
{

    // SI FUERA CON ARRAY. SERIA:
    // $array = $request->getParsedBody();
    // $nombreArray = $array['nombre'];


    // SI ES UN JSON SERIA: 
    // $array = $request->getParsedBody();
    // $JSONRecibido = json_decode($array['json']);


    // EN POSTMAN:
    // key: json            // value : {"nombre":"Lucho","tipo":"Administrador","clave":"123"}


    // FUNCION QUE VERIFICA QUE EL USUARIO EXISTA - SI ES ADMINISTRADOR.
    public function Verificar($request, $response, $next) 
    {

        // METODO POST.
        if ($request->isPost())
        {
            $response->getBody()->write("DESDE MIDDLEWARE - POST // "); 
            $array = $request->getParsedBody();
            $JSONRecibido = json_decode($array['json']);


            // CREO UNA NUEVA STDCLASS, PARA ASIGNAR LO RECIBIDO DEL JSON.
            $std = new stdClass;
            $std->nombre = $JSONRecibido->nombre;
            $std->clave = $JSONRecibido->clave;


            // ESTO VERIFICA QUE EL USUARIO EXISTA.
            if (Verificadora :: ExisteUsuario($std))
            {

                // ESTO VERIFICA QUE EL USUARIO SEA ADMINISTRADOR.
                if ($JSONRecibido->tipo == "Administrador")
                {
                    $response->getBody()->write("..... USTED ES ADMINISTRADOR." . "  SU NOMBRE ES: " . $JSONRecibido->nombre);
                    $response = $next($request, $response); 
                }

            }

            // ESTA LINEA SE GENERA EN CASO QUE EL USUARIO NO EXISTA.
            else
            {
                $response->getBody()->write("El usuario no existe!");
            }

        }
        
        // METODO GET.
        if ($request->isGet())
        {
            $response->getBody()->write("DESDE MIDDLEWARE - GET // "); 
            $response = $next($request, $response); 
        }

        return $response;
    }


    // FUNCION QUE VERIFIA QUE EL USUARIO EXISTA EN UN BLOC DE NOTAS.
    private static function ExisteUsuario($obj) 
    {
        $bandera = false;

        // ABRE EL ARCHIVO
        $archivo = fopen ("./usuarios.txt", "r");

        // LEE TODO EL ARCHIVO.
        while(!feof($archivo))
        {
            // OBTIENE LINEA A LINEA, SIN INCLUIR EL /n
            $linea = trim(fgets($archivo));

            // DIVIDE CADA LINEA EN UN ARRAY. EN CADA POSICION HAY UN ELEMENTO.
            $extension = explode("-", $linea);

            // RETORNA TRUE SI EL USUARIO EXISTE. VERIFICA NOMBRE Y CLAVE.
            if ($extension[0] == $obj->nombre && $extension[2] == $obj->clave)
            {
                $bandera = true;
                break;
            }
            
        }

        // CIERRA EL ARCHIVO.
        fclose($archivo);

        return $bandera;
    }

}



?>