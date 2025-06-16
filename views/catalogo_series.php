<?php
require_once __DIR__ . '/../models/Series.php';
require_once __DIR__ . '/../models/Usuarios.php'; // Incluir para verificar se está logado

// A variável $series já deve vir do controller, mas para garantir se acessado diretamente:
if (!isset($series)) {
    $series = Filme::buscarSeries();
}
?>

<?php include 'header.php'; ?>

<h1 class="mb-4">Catálogo de Series</h1>

<?php if (Usuario::estaLogado()): ?>
    <a href="/vitor/IMDB/series/novo" class="btn btn-primary mb-4">
        <i class="fas fa-plus-circle"></i> Adicionar Nova Serie
    </a>
<?php else: ?>
    <div class="alert alert-info" role="alert">
        Faça <a href="/vitor/IMDB/login" class="alert-link">login</a> para adicionar ou editar series.
    </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php if (empty($series)): ?>
        <div class="col-12">
            <p class="text-center">Nenhuma serie cadastrada ainda.</p>
        </div>
    <?php else: ?>
        <?php foreach ($series as $serie): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo htmlspecialchars($serie->imagem_serie); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($serie->titulo); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($serie->titulo); ?></h5>
                        <p class="card-text mb-1"><small class="text-muted"><strong>Diretor:</strong> <?php echo htmlspecialchars($serie->diretor); ?></small></p>
                        <p class="card-text mb-1"><small class="text-muted"><strong>Ano:</strong> <?php echo htmlspecialchars($serie->ano); ?></small></p>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($serie->sinopse); ?></p>
                        
                        <?php if (Usuario::estaLogado()): ?>
                            <div class="btn-action-group mt-auto">
                                <a href="/vitor/IMDB/series/editar/<?php echo $serie->id; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/vitor/IMDB/series/apagar/<?php echo $serie->id; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Tem certeza que deseja excluir este filme?');">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> IMDB Clone. Todos os direitos reservados.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>