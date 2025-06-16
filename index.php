<?php

// Não mudar nada aqui, tudo deve funcinar normalmente
/// ---------------------------------------------------------------

// Mini gerenciador de rotas usando match
// Captura a rota amigável (ex.: 'login', 'Filmeses/edit/5')
$url = $_GET['url'] ?? null;
$url = explode("/", $url);
// print_r($url);
// echo "<hr>";

$pagina =  $url[0];

if (isset($url[1])) {
    $pagina = "{$url[0]}/$url[1]";
}

/// ---------------------------------------------------------------

if(!isset($_SESSION)) {
    session_start();
}

// Inclui controllers
require __DIR__ . '/controllers/FilmesController.php';


match ($pagina) {
    
    //'logout'                    => HomeController::logout(),
        
    'filmes'                      => FilmesController::index(),
    'filmes/novo'                 => FilmesController::novo(),
    'filmes/apagar'               => FilmesController::apagarFilmes($url[2]),
    'adicionar'            => FilmesController::adicionarFilmes(),

    //'servicos/ver'              => ServicoController::verServicos($url[2]),
    //'servicos/editar'           => ServicoController::editarServico($url[2]),
    //'servicos/atualizar'        => ServicoController::atualizarServico(),
    //'servicos/apagar'           => ServicoController::apagarServico($url[2]),

    default                     => FilmesController::index(),
};

exit;
