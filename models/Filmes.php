<?php
require_once __DIR__ . '/../config/banco.php';

class Filme {

    public static function buscarFilmes() {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM filmes");

        $filmes = [];
        while ($t = $res->fetch_object()) {
            $filmes[] = $t;
        }
        return $filmes;
    }

    public static function buscarId($id) {
        $banco = Banco::getConn();
        $id = intval($id);
        $res = $banco->query("SELECT * FROM filmes WHERE id=$id");

        return $res->num_rows > 0 ? $res->fetch_object() : null;
    }

    public static function adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO filmes (titulo, diretor, ano, sinopse, imagem_filme) VALUES ('$titulo_f', '$diretor_f', '$ano_f', '$sinopse_f', '$imagem_filme')";
        return $banco->query($sql);
    }


    public static function editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem_filme) {
        $banco = Banco::getConn();
        $sql = "UPDATE filmes SET titulo='$titulo', diretor='$diretor', ano='$ano', sinopse='$sinopse', imagem_filme='$imagem_filme' WHERE id=$id";
        return $banco->query($sql);
    }

     public static function apagarFilme($id) {
        $banco = Banco::getConn();
        $id = intval($id);
        $sql = "DELETE FROM filmes WHERE id = $id";
        return $banco->query($sql);
    }
}

?>
