<?php

require_once 'vendor/autoload.php';

require_once 'lib/Database/Connection.php';

require_once 'App/Core/Core.php';

require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/ErrorController.php';
require_once 'App/Controller/PostController.php';
require_once 'App/Controller/SobreController.php';
require_once 'App/controller/AdminController.php';

require_once 'App/Model/Postagem.php';
require_once 'App/Model/Comentario.php';


$template = file_get_contents("App/Template/estrutura.html");

ob_start(); // Ativa o buffer de saida
    $core = new Core();
    $core->start($_GET); // Passando os atributos da url para o Core
    $saida = ob_get_contents(); // Grava o conteudo do buffer
ob_end_clean(); // Encerra o buffer de saida

$tpl = str_replace("{{area_dinamica}}", $saida, $template); // Substitui o local da string dentro das chaves pelo conteudo da $saida dentro do template

echo $tpl;
