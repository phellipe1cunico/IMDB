<?php
// Garanta que o session_start() seja a PRIMEIRA LINHA do seu arquivo de entrada (index.php ou router principal)
// Ex: no SEU index.php ou arquivo de roteamento:
// <?php
// session_start();
// ... resto do seu código de roteamento ...

require_once __DIR__ . '/../models/Filmes.php';
// NOVO: Incluir a classe Usuario para usar seus métodos de autenticação
require_once __DIR__ . '/../models/Usuarios.php';

class FilmesController {

    public static function index() {
        $filmes = Filme::buscarFilmes();
        require __DIR__ . '/../views/catalogo_filmes.php';
    }

    public static function novo() {
        // NOVO: Protege o acesso à página do formulário de adição de filme
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login'); // Redireciona para a página de login
            exit(); // Encerra a execução do script
        }
        require __DIR__ . '/../views/adicionar_filme.php';
    }

    public static function adicionarFilmes() {
        // NOVO: Protege a ação de adicionar filme
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login'); // Redireciona para a página de login ou erro
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $titulo_f = $_POST['titulo'] ?? null;
            $diretor_f = $_POST['diretor'] ?? null;
            $ano_f = $_POST['ano'] ?? null;
            $sinopse_f = $_POST['sinopse'] ?? null;
            $imagem_filme = $_POST['imagem_filme'] ?? null;

            // NOVO: Verificar se todos os dados necessários foram recebidos
            if ($titulo_f && $diretor_f && $ano_f && $sinopse_f && $imagem_filme) {
                // Se Filme::adicionarFilme retornar false (usuário não logado, ou erro no BD), você pode lidar com isso
                if (!Filme::adicionarFilme($titulo_f, $diretor_f, $ano_f, $sinopse_f, $imagem_filme)) {
                    // Opcional: Redirecionar para uma página de erro ou exibir mensagem
                    // header('Location: /vitor/IMDB/erro?msg=Falha ao adicionar filme');
                    // exit();
                }
            } else {
                // Opcional: Lidar com dados incompletos
                // header('Location: /vitor/IMDB/adicionar?msg=Campos incompletos');
                // exit();
            }
        }

        header("Location: /vitor/IMDB/filmes");
        exit();
    }

    public static function editar($id) {
        // NOVO: Protege o acesso à página do formulário de edição de filme
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login');
            exit();
        }
        
        $filme = Filme::buscarId($id);
        if (!$filme) {
            // Se o filme não for encontrado, redireciona para a lista
            header('Location: /vitor/IMDB/filmes');
            exit();
        }
        require __DIR__ . '/../views/adicionar_filme.php'; // Pode ser uma view genérica para adicionar/editar
    }
    
    public static function atualizar() {
        // NOVO: Protege a ação de atualizar filme
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

            // NOVO: Verificar se todos os dados necessários foram recebidos
            if ($id && $titulo && $diretor && $ano && $sinopse && $imagem_filme) {
                // Se Filme::editarFilme retornar false, você pode lidar com isso
                if (!Filme::editarFilme($id, $titulo, $diretor, $ano, $sinopse, $imagem_filme)) {
                    // Opcional: Redirecionar para uma página de erro ou exibir mensagem
                    // header('Location: /vitor/IMDB/erro?msg=Falha ao editar filme');
                    // exit();
                }
            } else {
                // Opcional: Lidar com dados incompletos
                // header('Location: /vitor/IMDB/editar/' . $id . '?msg=Campos incompletos');
                // exit();
            }
        }
    
        header("Location: /vitor/IMDB/filmes");
        exit();
    }
    

    public static function apagarFilmes($idFilme) {
        // NOVO: Protege a ação de apagar filme
        if (!Usuario::estaLogado()) {
            header('Location: /vitor/IMDB/login');
            exit();
        }

        // Se Filme::apagarFilme retornar false, você pode lidar com isso
        if (!Filme::apagarFilme($idFilme)) {
            // Opcional: Redirecionar para uma página de erro ou exibir mensagem
            // header('Location: /vitor/IMDB/erro?msg=Falha ao apagar filme ou filme inexistente');
            // exit();
        }

        header('Location: /vitor/IMDB/filmes');
        exit();
    }
}