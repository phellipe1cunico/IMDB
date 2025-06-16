<?php
require_once __DIR__ . '/../models/Filmes.php';
require_once __DIR__ . '/../models/Usuario.php';
$filmes = Filme::buscarFilmes();
?>
<?php include 'header.php'; ?>

<h1>Catálogo de Filmes</h1>

<?php if (Usuario::estaLogado()): ?>
    <a href="filmes/novo" class="btn btn-primary">Adicionar Novo Filme</a>
<?php endif; ?>

<hr>

<?php foreach ($filmes as $filme): ?>
    <div>
        <h2><?php echo htmlspecialchars($filme->titulo); ?></h2>
        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($filme->diretor); ?></p>
        <p><strong>Ano:</strong> <?php echo htmlspecialchars($filme->ano); ?></p>
        <p><strong>Sinopse:</strong> <?php echo htmlspecialchars($filme->sinopse); ?></p>

        <?php if (Usuario::estaLogado()): ?>
            <a href="filmes/editar/<?php echo $filme->id; ?>" class="btn btn-warning">Editar</a>
            <a href="filmes/apagar/<?php echo $filme->id; ?>" 
               class="btn btn-danger"
               onclick="return confirm('Tem certeza que deseja excluir este filme?');">
               Excluir
            </a>
        <?php endif; ?>
        <hr>
    </div>
<?php endforeach; ?>
