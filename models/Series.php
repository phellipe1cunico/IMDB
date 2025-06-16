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
        // A query SQL é construída diretamente com as variáveis
        $sql = "INSERT INTO series (titulo, diretor, ano, sinopse, imagem_serie) VALUES ('$titulo', '$diretor', '$ano', '$sinopse', '$imagem')";
        return $banco->query($sql);
    }

    public static function editarSerie($id, $titulo, $diretor, $ano, $sinopse, $imagem) {
        $banco = Banco::getConn();
        $sql = "UPDATE series SET titulo='$titulo', diretor='$diretor', ano='$ano', sinopse='$sinopse', imagem_serie='$imagem' WHERE id=$id";
        return $banco->query($sql);
    }

    public static function apagarSerie($id) {
        $banco = Banco::getConn();
        $id = intval($id);
        $sql = "DELETE FROM series WHERE id = $id";
        return $banco->query($sql);
    }
}
?>