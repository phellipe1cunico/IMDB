<?php
require_once __DIR__ . '/../models/Filmes.php';
require_once __DIR__ . '/../models/Usuarios.php'; // Incluir para verificar se está logado

// A variável $filmes já deve vir do controller, mas para garantir se acessado diretamente:
if (!isset($filmes)) {
    $filmes = Filme::buscarFilmes();
}
?>

<?php include 'header.php'; ?>

<h1 class="mb-4">Catálogo de Filmes</h1>

<?php if (Usuario::estaLogado()): ?>
    <a href="/vitor/IMDB/filmes/novo" class="btn btn-primary mb-4">
        <i class="fas fa-plus-circle"></i> Adicionar Novo Filme
    </a>
<?php else: ?>
    <div class="alert alert-info" role="alert">
        Faça <a href="/vitor/IMDB/login" class="alert-link">login</a> para adicionar ou editar filmes.
    </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php if (empty($filmes)): ?>
        <div class="col-12">
            <p class="text-center">Nenhum filme cadastrado ainda.</p>
        </div>
    <?php else: ?>
        <?php foreach ($filmes as $filme): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo htmlspecialchars($filme->imagem_filme); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($filme->titulo); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($filme->titulo); ?></h5>
                        <p class="card-text mb-1"><small class="text-muted"><strong>Diretor:</strong> <?php echo htmlspecialchars($filme->diretor); ?></small></p>
                        <p class="card-text mb-1"><small class="text-muted"><strong>Ano:</strong> <?php echo htmlspecialchars($filme->ano); ?></small></p>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($filme->sinopse); ?></p>
                        
                        <?php if (Usuario::estaLogado()): ?>
                            <div class="btn-action-group mt-auto">
                                <a href="/vitor/IMDB/filmes/editar/<?php echo $filme->id; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/vitor/IMDB/filmes/apagar/<?php echo $filme->id; ?>"
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