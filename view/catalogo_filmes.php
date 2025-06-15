<?php
require_once '../models/Filmes.php';
$filmes = Filme::buscarFilmes();

?>
<h1>Catálogo de Filmes</h1>
<?php foreach ($filmes as $filme): ?>
    <div>
        <h2><?php echo htmlspecialchars($filme->titulo); ?></h2>
        <p><strong>Diretor: </strong><?php echo htmlspecialchars($filme->diretor); ?></p>
        <p><strong>Ano: </strong><?php echo htmlspecialchars($filme->ano); ?></p>
        <p><strong>Sinopse: </strong><?php echo htmlspecialchars($filme->sinopse); ?></p>
    </div>
<?php endforeach; ?>

<h2>Adicionar Filmes</h2>

<a href="adicionar_filme.php" class="btn btn-primary">Adicionar</a>
<br><br>