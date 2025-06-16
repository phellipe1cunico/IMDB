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

    public static function adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO filmes (titulo, diretor, ano, sinopse, imagem_filme) VALUES ('$titulo_f', '$diretor_f', '$ano_f', '$sinopse_f', '$imagem_filme')";
        return $banco->query($sql);
    }

    public static function editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem) {
        $banco = Banco::getConn();
        $stmt = $banco->prepare("UPDATE filmes SET titulo=?, diretor=?, ano=?, sinopse=?, imagem_filme=? WHERE id=?");
        $stmt->bind_param("ssissi", $titulo, $diretor, $ano, $sinopse, $imagem, $id);
        return $stmt->execute();
    }

    public static function apagarFilme($id) {
        $banco = Banco::getConn();
        $stmt = $banco->prepare("DELETE FROM filmes WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
