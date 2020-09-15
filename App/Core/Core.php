<?php

class Core
{
    public function start($get) // Recebendo a pagina via query string
    {
        $method = 'index';
        
        if (isset($get["pagina"])) {
            $controller = ucfirst($get["pagina"].'Controller'); // identificando qual controller e armazenando a pagina em uma variavel
        } else {
            $controller = "HomeController";
        }

        if (!class_exists($controller)) { // Verificando se a pagina existe
            $controller = 'ErrorController';
        }

        call_user_func_array(array(new $controller, $method), array()); // Instanciando o Controller e chamando um metodo
    }
}