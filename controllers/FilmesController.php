<?php
require_once __DIR__ . '/../models/Filmes.php';

class FilmesController {

    public static function index() {
        $filmes = Filme::buscarFilmes();
        require __DIR__ . '/../views/catalogo_filmes.php';
    }

    // Função 'novo' corrigida. A definição da função está ativa,
    // mas a lógica de sessão continua comentada.
    public static function novo() {
        //session_start();
        //if (!isset($_SESSION['user_id'])) {
        //    header('Location: login');
        //}

        // Este 'require' agora está dentro de uma função, o que é sintaticamente correto.
        require __DIR__ . '/../views/adicionar_filme.php';
    }

    public static function adicionarFilmes() {
        //if (!isset($_SESSION['user_id'])) {
        //    header('Location: adicionar');
        //}

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $titulo_f = $_POST['titulo'] ?? null;
            $diretor_f = $_POST['diretor'] ?? null;
            $ano_f = $_POST['ano'] ?? null;
            $sinopse_f = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            if ($titulo_f && $diretor_f && $ano_f && $sinopse_f && $imagem_filme) {
                // CORREÇÃO BÔNUS: O nome do método no Model é 'adicionarFilme' (singular).
                // Já corrigi aqui para evitar seu próximo erro.
                Filme::adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme);
            }
        }

        // ATENÇÃO: Esta linha redireciona para um arquivo, não para uma rota.
        // O correto seria usar o sistema de rotas.
        header("Location: filmes");
        exit(); // É uma boa prática adicionar exit() após um redirecionamento.
    }

    public static function apagarFilmes($idFilme) {
        //if (!isset($_SESSION['user_id'])) {
        //    header('Location: login');
        //}

        Filme::apagarFilme($idFilme); // Corrigido para o nome correto do método

        header('Location: /vitor/IMDB/filmes');
        exit();
    }
}