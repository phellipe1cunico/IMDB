<?php
require_once __DIR__ . '/../models/Series.php';

class SeriesController {

    public static function index() {
        $series = Serie::buscarSeries();
        require __DIR__ . '/../views/catalogo_series.php';
    }

    public static function novo() {
        require __DIR__ . '/../views/adicionar_serie.php';
    }

    public static function adicionarSeries() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? null;
            $diretor = $_POST['diretor'] ?? null;
            $ano = $_POST['ano'] ?? null;
            $sinopse = $_POST['sinopse'] ?? null;
            $imagem = $_POST['imagem_serie'] ?? null;

            if ($titulo && $diretor && $ano && $sinopse && $imagem) {
                Serie::adicionarSerie($titulo, $diretor, $ano, $sinopse, $imagem);
            }
        }
        header("Location: /vitor/IMDB/series");
        exit();
    }

    public static function editar($id) {
        $serie = Serie::buscarId($id);
        require __DIR__ . '/../views/adicionar_serie.php';
    }

    public static function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $titulo = $_POST['titulo'] ?? null;
            $diretor = $_POST['diretor'] ?? null;
            $ano = $_POST['ano'] ?? null;
            $sinopse = $_POST['sinopse'] ?? null;
            $imagem = $_POST['imagem_serie'] ?? null;

            if ($id && $titulo && $diretor && $ano && $sinopse && $imagem) {
                Serie::editarSerie($id, $titulo, $diretor, $ano, $sinopse, $imagem);
            }
        }
        header("Location: /vitor/IMDB/series");
        exit();
    }

    public static function apagarSeries($idSerie) {
        Serie::apagarSerie($idSerie);
        header('Location: /vitor/IMDB/series');
        exit();
    }

    public static function detalhe($id) {
        $serie = Serie::buscarId($id); 
        if ($serie) {
            require __DIR__ . '/../views/detalhe_serie.php'; 
        } else {
            
            header("Location: /vitor/IMDB/series");
            exit();
        }
    }
}