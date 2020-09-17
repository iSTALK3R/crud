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

    public function change($param) 
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View/');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selecionaPorId($param);

        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;

        $conteudo = $template->render($parametros);

        echo $conteudo;
    }

    public function update()
    {
        try { // Tratamento de erro com o try
            Postagem::update($_POST);

            echo '<script>alert("Publicação atualizada com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) { // Caso caia no throw new
            echo '<script>alert("'.$e->getMessage.'")</script>';
            echo '<script>location.href="?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
        }
    }

    public function delete($param)
    {
        try {
            Postagem::delete($param);

            echo '<script>alert("Publicação excluída com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage.'")</script>';
            echo '<script>location.href="?pagina=admin&metodo=update"</script>';
        }
    }
}