<?php
require_once __DIR__ . '/../config/banco.php';

class Fornecedor {

    public static function buscarFilmes()  {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM filmes");
                
        $fornecedores = [];
        while ($t = $res->fetch_object()) {
            $filmes[] = $t;
        }

        return $filmes;
    }

    public static function buscarId($id) {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM filmes WHERE id=$id");

        if ($res->num_rows > 0) {
            return $res->fetch_object();
        } else {
            return null;
        }
    }
    
    public static function adicionarFilmes($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_f) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO filmes (titulo, diretor, ano, sinopse, imagem_filme) 
                VALUES ('$titulo_f','$diretor_f','$ano_f','$sinopse_f', '$imagem_f')";
        return $banco->query($sql);
    }

    public static function editarFilmes($idfilme, $titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_f) {
        $banco = Banco::getConn();
        $sql = "UPDATE filmes
                SET titulo='$titulo_f', diretor='$diretor_f', ano='$ano_f', sinopse='$sinopse_f', imagem_filme='$imagem_f' 
                WHERE id='$idFilme'";
        return $banco->query($sql);
    }

    public static function apagarFilmes($idFilme) {
        $banco = Banco::getConn();
        return $banco->query("DELETE FROM filmes WHERE id='$idFilme'");
    }
    
}
