<?php


require_once __DIR__ . '/../models/Filmes.php';

require_once __DIR__ . '/../models/Usuarios.php';

class FilmesController {

    public static function index() {
        $filmes = Filme::buscarFilmes();
        require __DIR__ . '/../views/catalogo_filmes.php';
    }

    public static function novo() {
        
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login'); 
            exit(); 
        }
        require __DIR__ . '/../views/adicionar_filme.php';
    }

    public static function adicionarFilmes() {
       
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login'); 
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $titulo_f = $_POST['titulo'] ?? null;
            $diretor_f = $_POST['diretor'] ?? null;
            $ano_f = $_POST['ano'] ?? null;
            $sinopse_f = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            
            if ($titulo_f && $diretor_f && $ano_f && $sinopse_f && $imagem_filme) {
                
                if (!Filme::adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme)) {
                    
                }
            } else {
                
            }
        }

        header("Location: /vitor/IMDB/filmes");
        exit();
    }

    public static function editar($id) {
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login');
            exit();
        }
        
        $filme = Filme::buscarId($id);
        if (!$filme) {
            
            header('Location: /vitor/IMDB/filmes');
            exit();
        }
        require __DIR__ . '/../views/adicionar_filme.php'; 
    }
    
    public static function atualizar() {
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $titulo = $_POST['titulo'] ?? null;
            $diretor = $_POST['diretor'] ?? null;
            $ano = $_POST['ano'] ?? null;
            $sinopse = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            
            if ($id && $titulo && $diretor && $ano && $sinopse && $imagem_filme) {
                
                if (!Filme::editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem_filme)) {
                    
                }
            } else {
                
            }
        }
    
        header("Location: /vitor/IMDB/filmes");
        exit();
    }
    

    public static function apagarFilmes($idFilme) {
        
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login');
            exit();
        }

        
        if (!Filme::apagarFilme($idFilme)) {
            
        }

        header('Location: /vitor/IMDB/filmes');
        exit();
    }
}