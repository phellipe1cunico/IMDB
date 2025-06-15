<?php
require_once '../models/Filmes.php';
$filmes = Filme::buscarFilmes();
include 'header.php';
?>
<h1>Catálogo de Filmes</h1>
<?php foreach ($filmes as $filme): ?>
    <div>
        <h2><?php echo htmlspecialchars($filme->titulo); ?></h2>
        <p><?php echo htmlspecialchars($filme->sinopse); ?></p>
    </div>
<?php endforeach; ?>
