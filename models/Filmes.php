<?php

require_once __DIR__ . '/../config/banco.php';

require_once __DIR__ . '/Usuarios.php';

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
        
        if (!Usuario::estaLogado()) {
            error_log("Tentativa de adicionar filme por usuário não logado. Título: $titulo_f");
            return false;
        }

        $banco = Banco::getConn();
        
        $titulo_f = $banco->real_escape_string($titulo_f);
        $diretor_f = $banco->real_escape_string($diretor_f);
        $ano_f = intval($ano_f); 
        $sinopse_f = $banco->real_escape_string($sinopse_f);
        $imagem_filme = $banco->real_escape_string($imagem_filme);

        $sql = "INSERT INTO filmes (titulo, diretor, ano, sinopse, imagem_filme) VALUES ('$titulo_f', '$diretor_f', '$ano_f', '$sinopse_f', '$imagem_filme')";
        return $banco->query($sql);
    }


    public static function editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem_filme) {
        
        if (!Usuario::estaLogado()) {
            error_log("Tentativa de edição de filme por usuário não logado. ID do filme: $id");
            return false; 
        }

        $banco = Banco::getConn();
        
        $id = intval($id);
        $titulo = $banco->real_escape_string($titulo);
        $diretor = $banco->real_escape_string($diretor);
        $ano = intval($ano);
        $sinopse = $banco->real_escape_string($sinopse);
        $imagem_filme = $banco->real_escape_string($imagem_filme);

        $sql = "UPDATE filmes SET titulo='$titulo', diretor='$diretor', ano='$ano', sinopse='$sinopse', imagem_filme='$imagem_filme' WHERE id=$id";
        return $banco->query($sql);
    }

    public static function apagarFilme($id) {
        
        if (!Usuario::estaLogado()) {
            error_log("Tentativa de exclusão de filme por usuário não logado. ID do filme: $id");
            return false; 
        }

        $banco = Banco::getConn();
        $id = intval($id);
        $sql = "DELETE FROM filmes WHERE id = $id";
        return $banco->query($sql);
    }
}
?>