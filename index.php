<?php
session_start();

$url = $_GET['url'] ?? 'inicio';
$url = explode('/', $url);

$pagina = $url[0];

if (isset($url[1])) {
    $pagina = "{$url[0]}/{$url[1]}";
}


require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/FilmesController.php';
require __DIR__ . '/controllers/SeriesController.php';
require __DIR__ . '/controllers/UsuarioController.php';

// Roteador 'match'
match ($pagina) {
    
    'inicio' => HomeController::index(),
    'filmes' => FilmesController::index(),
    'series' => SeriesController::index(),

    // Rotas de Usuário
    'cadastro' => UsuarioController::novo(), 
    'registrar' => UsuarioController::criar(),
    'login' => UsuarioController::login(),       
    'auth' => UsuarioController::auth(),         
    'logout' => UsuarioController::logout(),
    
    // Rotas de Filmes
    'filmes/novo' => FilmesController::novo(),
    'adicionar' => FilmesController::adicionarFilmes(),
    'filmes/editar' => FilmesController::editar($url[2]),
    'filmes/atualizar' => FilmesController::atualizar(),
    'filmes/apagar' => FilmesController::apagarFilmes($url[2]),
    'filmes/detalhe' => FilmesController::detalhe($url[2]),

    // Rotas de Séries
    'series/novo' => SeriesController::novo(),
    'adicionar_serie' => SeriesController::adicionarSeries(),
    'series/editar' => SeriesController::editar($url[2]),
    'series/atualizar' => SeriesController::atualizar(),
    'series/apagar' => SeriesController::apagarSeries($url[2]),
    'series/detalhe' => SeriesController::detalhe($url[2]),
    
    default => HomeController::index(),
};