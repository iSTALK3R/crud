<?php

class PostController
{
    public function index($params)
    {
        try {
            $post = Postagem::selecionaPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('App/View/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            $parametros['titulo'] = $post->titulo;
            $parametros['conteudo'] = $post->conteudo;
            $parametros['comentarios'] = $post->comentarios;

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}