<?php

// Mini gerenciador de rotas
$url = $_GET['url'] ?? 'inicio'; // Se a URL estiver vazia, vai para 'inicio'
$url = explode('/', $url);

$pagina = $url[0];

if (isset($url[1])) {
    $pagina = "{$url[0]}/{$url[1]}";
}

/// ---------------------------------------------------------------

//if (!isset($_SESSION)) {
   // session_start();
//}

// Inclui todos os controllers necessários
require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/FilmesController.php';
require __DIR__ . '/controllers/SeriesController.php';

// Roteador 'match' atualizado
match ($pagina) {
    // Rotas do Menu de Navegação
    'inicio' => HomeController::index(),
    'filmes' => FilmesController::index(),
    'series' => SeriesController::index(), // Corrigido para chamar o SeriesController

    // Rotas de Ações de Filmes
    'filmes/novo' => FilmesController::novo(),
    'adicionar' => FilmesController::adicionarFilmes(),
    'filmes/apagar' => FilmesController::apagarFilmes($url[2]),

    // Rota Padrão
    default => HomeController::index(),
};

exit;