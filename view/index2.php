<?php
require_once '../models/Filmes.php';
$filmes = Filme::buscarFilmes();

require_once '../models/Series.php';
$series = Serie::buscarSeries();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Bem-vindo ao Meu Site de Filmes!</h1>
        <p>Explore os filmes disponíveis ou adicione novos filmes</p>

        <h2>Filmes em Cartaz</h2>
</body>
</html>