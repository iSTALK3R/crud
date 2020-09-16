<?php

class Core
{
    public function start($get) // Recebendo a pagina via query string
    {
        if (isset($get['metodo'])) {
            $method = $get['metodo'];
        } else {
            $method = 'index'; // Método a ser chamado pelo call
        }
        
        if (isset($get["pagina"])) {
            $controller = ucfirst($get["pagina"].'Controller'); // identificando qual controller e armazenando a pagina em uma variavel
        } else {
            $controller = "HomeController";
        }

        if (!class_exists($controller)) { // Verificando se a pagina existe, caso não o controller é o erro
            $controller = 'ErrorController';
        }

        if (isset($get['id']) && $get['id'] != null) { // Verifica se existe um parametro id na url, caso não seu valor é null
            $id = $get['id'];
        } else {
            $id = null;
        }

        call_user_func_array(array(new $controller, $method), array('id' => $id)); // Instanciando o Controller e chamando um metodo e passando os parametros para o metodo
    }
}