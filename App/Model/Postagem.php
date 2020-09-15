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
}