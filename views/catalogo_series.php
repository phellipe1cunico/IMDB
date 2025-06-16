<?php
require_once __DIR__ . '/../models/Series.php';
$series = Serie::buscarSeries();

?>

<?php include 'header.php'; ?>

<h1>Catálogo de Séries</h1>
<?php foreach ($series as $serie): ?>
    <div>
        <h2><?php echo htmlspecialchars($serie->titulo); ?></h2>
        <p><strong>Diretor: </strong><?php echo htmlspecialchars($serie->diretor); ?></p>
        <p><strong>Ano: </strong><?php echo htmlspecialchars($serie->ano); ?></p>
        <p><strong>Sinopse: </strong><?php echo htmlspecialchars($serie->sinopse); ?></p>
    </div>
<?php endforeach; ?>

<h2>Adicionar Series</h2>

<a href="adicionar_serie.php" class="btn btn-primary">Adicionar</a>
<br><br>
