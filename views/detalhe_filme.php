<?php include 'header.php'; ?>

<div class="container mt-5">
    <?php if (isset($filme) && $filme): ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($filme->imagem_filme); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($filme->titulo); ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo htmlspecialchars($filme->titulo); ?> (<?php echo htmlspecialchars($filme->ano); ?>)</h1>
                        <p class="card-text"><strong>Diretor:</strong> <?php echo htmlspecialchars($filme->diretor); ?></p>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($filme->sinopse)); ?></p>
                        <a href="/vitor/IMDB/filmes" class="btn btn-secondary mt-3">Voltar ao Catálogo de Filmes</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Filme não encontrado.
        </div>
        <a href="/vitor/IMDB/filmes" class="btn btn-primary">Voltar ao Catálogo de Filmes</a>
    <?php endif; ?>
</div>
