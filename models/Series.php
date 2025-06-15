<?php
require_once __DIR__ . '/../config/banco.php';

class Series {

    public static function buscarSeries()  {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM series");
                
        $series = [];
        while ($t = $res->fetch_object()) {
            $series[] = $t;
        }

        return $series;
    }
    
    public static function buscarIdSeries($id) {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT * FROM series WHERE id=$id");

        if ($res->num_rows > 0) {
            return $res->fetch_object();
        } else {
            return null;
        }
    }

    public static function adicionarSeries($titulo_s, $diretor_s, $ano_s, $sinopse_s, $imagem_s) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO series (titulo, diretor, ano, sinopse, imagem_serie) 
                VALUES ('$titulo_s','$diretor_s','$ano_s','$sinopse_s', '$imagem_s')";
        return $banco->query($sql);
    }

    public static function editarSeries($idSerie, $titulo_s, $diretor_s, $ano_s, $sinopse_s, $imagem_s) {
        $banco = Banco::getConn();
        $sql = "UPDATE series 
                SET titulo='$titulo_s', diretor='$diretor_s', ano='$ano_s', sinopse='$sinopse_s', imagem_serie='$imagem_serie' 
                WHERE id='$idSerie'";
        return $banco->query($sql);
    }
    
    public static function apagarSeries($idSerie) {
        $banco = Banco::getConn();
        return $banco->query("DELETE FROM series WHERE id='$idSerie'");
    }
    
}
