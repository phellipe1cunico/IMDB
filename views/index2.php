<?php
require_once __DIR__ . '/../models/Filmes.php';
$filmes = Filme::buscarFilmes();

require_once __DIR__ . '/../models/Series.php';
$series = Serie::buscarSeries();
?>

<?php include 'header.php'; ?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-5 fw-bold">Bem-vindo ao IMDB Clone!</h1>
        <p class="col-md-8 fs-4 mx-auto">Explore nosso catálogo de filmes e séries, ou contribua adicionando seus favoritos.</p>
        <a href="/vitor/IMDB/filmes" class="btn btn-primary btn-lg mt-3 me-2">Ver Filmes</a>
        <a href="/vitor/IMDB/series" class="btn btn-outline-secondary btn-lg mt-3">Ver Séries</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h2 class="mb-4">Filmes em Destaque</h2>
        <?php if (empty($filmes)): ?>
            <p>Nenhum filme disponível no momento.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php $count = 0; ?>
                <?php foreach ($filmes as $filme): ?>
                    <?php if ($count < 2): // Exibe apenas os 2 primeiros filmes ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($filme->imagem_filme); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($filme->titulo); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($filme->titulo); ?></h5>
                                    <p class="card-text"><small class="text-muted">Diretor: <?php echo htmlspecialchars($filme->diretor); ?> (<?php echo htmlspecialchars($filme->ano); ?>)</small></p>
                                    <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($filme->sinopse, 0, 100, "...")); ?></p>
                                    <a href="/vitor/IMDB/filmes" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                                </div>
                            </div>
                        </div>
                        <?php $count++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a href="/vitor/IMDB/filmes" class="btn btn-link">Ver todos os filmes &raquo;</a>
        </div>
    </div>

    <div class="col-md-6">
        <h2 class="mb-4">Séries em Destaque</h2>
        <?php if (empty($series)): ?>
            <p>Nenhuma série disponível no momento.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php $count = 0; ?>
                <?php foreach ($series as $serie): ?>
                    <?php if ($count < 2): // Exibe apenas as 2 primeiras séries ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($serie->imagem_serie); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($serie->titulo); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($serie->titulo); ?></h5>
                                    <p class="card-text"><small class="text-muted">Diretor: <?php echo htmlspecialchars($serie->diretor); ?> (<?php echo htmlspecialchars($serie->ano); ?>)</small></p>
                                    <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($serie->sinopse, 0, 100, "...")); ?></p>
                                    <a href="/vitor/IMDB/series" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                                </div>
                            </div>
                        </div>
                        <?php $count++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a href="/vitor/IMDB/series" class="btn btn-link">Ver todas as séries &raquo;</a>
        </div>
    </div>
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