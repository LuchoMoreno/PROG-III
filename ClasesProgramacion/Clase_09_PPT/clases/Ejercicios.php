<?php

require_once './clases/Usuario.php';

class Ejercicios{

// EJERCICIO 1.

        public function VerificarBaseDeDatos($request, $response, $next) 
        {

            // METODO POST.
            if ($request->isPost())
            {
                $response->getBody()->write("DESDE MIDDLEWARE - POST // "); 
                $array = $request->getParsedBody();
                $JSONRecibido = json_decode($array['usuario']);

                $usuario = new Usuario();

                $clase = new stdClass();

                $clase = $usuario->ExisteEnBD($JSONRecibido->correo,$JSONRecibido->clave);


                // ESTA LINEA SE GENERA SI EL USUARIO EXISTE EN LA BASE DE DATOS.
                if($clase->existe == true)
                {

                    if ($JSONRecibido->perfil == 0) // SI EXISTE, Y ES USUARIO COMUN.
                        {
                            $response->getBody()->write("..... USTED ES USUARIO COMUN." . "  SU NOMBRE ES: " . $JSONRecibido->nombre);
                            $response = $next($request, $response); 
                        }

                    if ($JSONRecibido->perfil == 1) // SI EXISTE, Y ES USUARIO ADMINISTRADOR.
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
            
            return $response;
        }



// EJERCICIO 2.

        public function AgregarUnUsuario($request, $response, $next) 
        {

            if ($request->isPost())
            {
               

            }
            return $response;
        }




}



?>