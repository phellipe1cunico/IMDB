<?php include 'header.php'; ?>

<div class="container mt-5">
    <?php if (isset($serie) && $serie): ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($serie->imagem_serie); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($serie->titulo); ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo htmlspecialchars($serie->titulo); ?> (<?php echo htmlspecialchars($serie->ano); ?>)</h1>
                        <p class="card-text"><strong>Diretor:</strong> <?php echo htmlspecialchars($serie->diretor); ?></p>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($serie->sinopse)); ?></p>
                        <a href="/vitor/IMDB/series" class="btn btn-secondary mt-3">Voltar ao Catálogo de Séries</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Série não encontrada.
        </div>
        <a href="/vitor/IMDB/series" class="btn btn-primary">Voltar ao Catálogo de Séries</a>
    <?php endif; ?>
</div>
