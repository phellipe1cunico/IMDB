<?php
require_once __DIR__ . '/../models/Filmes.php';

class FilmesController {


    public static function index() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        $filmes = Filmes::buscarFilmes();

        require __DIR__ . '/../views/filmes.php';
    }

    
    public static function novo() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        require __DIR__ . '/../views/filmes-criar.php';
    }


    public static function adicionarFilmes() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $titulo_f = $_POST['titulo'] ?? null;
            $diretor_f = $_POST['diretor'] ?? null;
            $ano_f = $_POST['ano'] ?? null;
            $sinopse_f = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            if(!is_null($titulo_f) && !is_null($diretor_f) && !is_null($ano_f) && !is_null($sinopse_f) && !is_null($imagem_filme)) {
                Filmes::adicionarFilmes($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme);
            }
            
        } 


        header("Location: ../catalogo_filmes");
    }

    
    public static function apagarFilmes($idFilme) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }

        Filmes::apagar($idFilme);

        header('Location: ../../filmes');
    }

}
