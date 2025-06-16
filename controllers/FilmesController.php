<?php

require_once __DIR__ . '/../models/Filmes.php';

class FilmesController {

    public static function index() {
        $filmes = Filme::buscarFilmes();
        require __DIR__ . '/../views/catalogo_filmes.php';
    }

    public static function novo() {
        
        require __DIR__ . '/../views/adicionar_filme.php';
    }

    public static function adicionarFilmes() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $titulo_f = $_POST['titulo'] ?? null;
            $diretor_f = $_POST['diretor'] ?? null;
            $ano_f = $_POST['ano'] ?? null;
            $sinopse_f = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            if ($titulo_f && $diretor_f && $ano_f && $sinopse_f && $imagem_filme) {
                
                Filme::adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme);
            }
        }

        header("Location: filmes");
    
    }

    public static function editar($id) {
        
        $filme = Filme::buscarId($id);
        require __DIR__ . '/../views/adicionar_filme.php';
    }
    
    public static function atualizar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $titulo = $_POST['titulo'] ?? null;
            $diretor = $_POST['diretor'] ?? null;
            $ano = $_POST['ano'] ?? null;
            $sinopse = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            if ($id && $titulo && $diretor && $ano && $sinopse && $imagem_filme) {
            Filme::editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem_filme);
            }
        }
    
        header("Location: /vitor/IMDB/filmes");
    
    }
    

    public static function apagarFilmes($idFilme) {

        Filme::apagarFilme($idFilme);

        header('Location: /vitor/IMDB/filmes');
        
    }
}