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
    
        $titulo_escaped = $banco->real_escape_string($titulo);
        $diretor_escaped = $banco->real_escape_string($diretor);
        $sinopse_escaped = $banco->real_escape_string($sinopse);
        $imagem_escaped = $banco->real_escape_string($imagem);
    
        $sql = "INSERT INTO series (titulo, diretor, ano, sinopse, imagem_serie) VALUES ('$titulo_escaped', '$diretor_escaped', '$ano', '$sinopse_escaped', '$imagem_escaped')";
        return $banco->query($sql);
    }

    public static function editarSerie($id, $titulo, $diretor, $ano, $sinopse, $imagem) {
        $banco = Banco::getConn();

        $titulo_escaped = $banco->real_escape_string($titulo);
        $diretor_escaped = $banco->real_escape_string($diretor);
        $sinopse_escaped = $banco->real_escape_string($sinopse);
        $imagem_escaped = $banco->real_escape_string($imagem);
    
        $sql = "UPDATE series SET titulo='$titulo_escaped', diretor='$diretor_escaped', ano='$ano', sinopse='$sinopse_escaped', imagem_serie='$imagem_escaped' WHERE id=$id";
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