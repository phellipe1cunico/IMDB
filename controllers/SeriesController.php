<?php
require_once __DIR__ . '/../models/Series.php';

class SeriesController {
    public static function index() {
        // Busca os dados das séries no modelo
        $series = Serie::buscarSeries();

        // Carrega a view do catálogo de séries, passando os dados
        require __DIR__ . '/../views/catalogo_series.php';
    }

    // Futuramente você pode adicionar aqui os métodos novo(), adicionarSerie(), etc.
}