<?php
require_once '../models/Series.php';
$series = Serie::buscarSeries();
include 'header.php';
?>
<h1>Catálogo de Séries</h1>
<?php foreach ($series as $serie): ?>
    <div>
        <h2><?php echo htmlspecialchars($serie->titulo); ?></h2>
        <p><?php echo htmlspecialchars($serie->sinopse); ?></p>
    </div>
<?php endforeach; ?>
