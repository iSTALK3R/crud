<?php

class AdminController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        $objPostagens = Postagem::selecionaTodos();
        
        $parametros = array();
        $parametros['postagens'] = $objPostagens;

        $conteudo = $template->render($parametros);

        echo $conteudo;
    }

    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);

        echo $conteudo;
    }

    public function insert()
    {
        try { // Tratamento de erro com o try
            Postagem::insert($_POST);

            echo '<script>alert("Publicação inserida com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) { // Caso caia no throw new
            echo '<script>alert("'.$e->getMessage.'")</script>';
            echo '<script>location.href="?pagina=admin&metodo=create"</script>';
        }
    }
}