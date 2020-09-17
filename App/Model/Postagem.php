<?php

class Postagem
{
    public static function selecionaTodos()
    {
        $conn = Connection::getConn();
        
        $sql = "SELECT * FROM postagem ORDER BY id DESC";
        $sql = $conn->prepare($sql);

        $sql->execute();

        $result = array();

        while ($row = $sql->fetchObject('Postagem')) {
            $result[] = $row;
        }

        if (!$result) {
            throw new Exception("Não foi encontrado nenhum  registro no banco!");
        }

        return $result;
    }

    public static function selecionaPorId($idPost)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        
        $sql->execute();

        $result = $sql->fetchObject('Postagem');

        if (!$result) {
            throw new Exception("Não foi encontrado nenhum  registro no banco!");
        } else {
            $result->comentarios = Comentario::selecionarComentarios($result->id); // Cria um outro array no array result e lista os comentarios
        }

        return $result;
    }

    public static function insert($data) // Metodo que recebe os parametros do $_POST e faz a inserção de dados
    {
        if (empty($data['titulo']) || empty($data['conteudo'])) { // Verifica se os parametros titulo e conteudo estão vazios
            throw new Exception("Preencha todos os campos!"); // Caso sim lança um throw

            return false; // E retorna false
        }

        $conn = Connection::getConn();

        $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':titulo', $data['titulo']);
        $sql->bindValue(':conteudo', $data['conteudo']);

        $res = $sql->execute(); // Armazena a execução do insert em uma variavel

        if (!$res) { // Verifica se a inserção retornou false
            throw new Exception("Falha ao inserir dados!"); // Caso sim lança um throw

            return false; // E retorna false
        }

        return true; // Caso tudo ocorra bem, retorna true.
    }

    public static function update($data)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':tit', $data['titulo']);
        $sql->bindValue(':cont', $data['conteudo']);
        $sql->bindValue(':id', $data['id']);

        $res = $sql->execute();

        if (!$res) {
            throw new Exception("Não foi possível atualizar a postagem");

            return false;
        }

        return true;
    }

    public static function delete($id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM postagem WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $id);

        $res = $sql->execute();

        if (!$res) {
            throw new Exception("Não foi possível excluir a publicação!");
            
            return false;
        }

        return true;
    }
}