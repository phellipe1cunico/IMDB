<?php
require_once __DIR__ . '/../models/Series.php';
require_once __DIR__ . '/../models/Usuario.php';
$series = Serie::buscarSeries();
?>
<?php include 'header.php'; ?>

<h1>Catálogo de Filmes</h1>

<?php if (Usuario::estaLogado()): ?>
    <a href="filmes/novo" class="btn btn-primary">Adicionar Nova Serie</a>
<?php endif; ?>

<hr>

<?php foreach ($series as $serie): ?>
    <div>
        <h2><?php echo htmlspecialchars($serie->titulo); ?></h2>
        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($serie->diretor); ?></p>
        <p><strong>Ano:</strong> <?php echo htmlspecialchars($serie->ano); ?></p>
        <p><strong>Sinopse:</strong> <?php echo htmlspecialchars($serie->sinopse); ?></p>

        <?php if (Usuario::estaLogado()): ?>
            <a href="filmes/editar/<?php echo $serie->id; ?>" class="btn btn-warning">Editar</a>
            <a href="filmes/apagar/<?php echo $serie->id; ?>" 
               class="btn btn-danger"
               onclick="return confirm('Tem certeza que deseja excluir esta serie?');">
               Excluir
            </a>
        <?php endif; ?>
        <hr>
    </div>
<?php endforeach; ?>
