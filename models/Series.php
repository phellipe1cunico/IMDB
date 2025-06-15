<?php
require_once __DIR__ . '/../config/banco.php';

class Serie {

    public static function buscarSeries() {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM series");

        $series = [];
        while ($t = $res->fetch_object()) {
            $series[] = $t;
        }
        return $series;
    }

    public static function buscarId($id) {
        $banco = Banco::getConn();
        $id = intval($id);
        $res = $banco->query("SELECT * FROM series WHERE id=$id");

        return $res->num_rows > 0 ? $res->fetch_object() : null;
    }

    public static function adicionarSerie($titulo, $diretor, $ano, $sinopse, $imagem) {
        $banco = Banco::getConn();
        $stmt = $banco->prepare("INSERT INTO series (titulo, diretor, ano, sinopse, imagem_serie) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $titulo, $diretor, $ano, $sinopse, $imagem);
        return $stmt->execute();
    }

    public static function editarSerie($id, $titulo, $diretor, $ano, $sinopse, $imagem) {
        $banco = Banco::getConn();
        $stmt = $banco->prepare("UPDATE series SET titulo=?, diretor=?, ano=?, sinopse=?, imagem_serie=? WHERE id=?");
        $stmt->bind_param("ssissi", $titulo, $diretor, $ano, $sinopse, $imagem, $id);
        return $stmt->execute();
    }

    public static function apagarSerie($id) {
        $banco = Banco::getConn();
        $stmt = $banco->prepare("DELETE FROM series WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
