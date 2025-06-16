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

require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/FilmesController.php';
require __DIR__ . '/controllers/SeriesController.php';

match ($pagina) {
    // Rotas Principais
    'inicio' => HomeController::index(),
    'filmes' => FilmesController::index(),
    'series' => SeriesController::index(),

    // Rotas de Ações de Filmes
    'filmes/novo' => FilmesController::novo(),
    'adicionar' => FilmesController::adicionarFilmes(),
    'filmes/editar' => FilmesController::editar($url[2]),
    'filmes/atualizar' => FilmesController::atualizar(),
    'filmes/apagar' => FilmesController::apagarFilmes($url[2]),

    // Rotas de Ações de Séries
    'series/novo' => SeriesController::novo(),
    'adicionar_serie' => SeriesController::adicionarSeries(),
    'series/editar' => SeriesController::editar($url[2]),
    'series/atualizar' => SeriesController::atualizar(),
    'series/apagar' => SeriesController::apagarSeries($url[2]),

    // Rota Padrão
    default => HomeController::index(),
};