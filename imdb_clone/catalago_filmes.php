<?php
require_once 'config.php';

$filmes = array_filter(getFilmes(), fn($item) => isset($item['tipo']) && $item['tipo'] === 'filme');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>


    <div class="container">
        <h1>Catálogo de Filmes</h1>

        <?php if (empty($filmes)): ?>
            <p>Nenhum filme cadastrado.</p>
        <?php else: ?>
            <div class="movie-list">
                <?php foreach ($filmes as $filme): ?>
                    <div class="movie-card">
                        <?php if (!empty($filme['imagem_nome']) && file_exists(UPLOADS_DIR . $filme['imagem_nome'])): ?>
                            <img src="<?php echo 'uploads/' . htmlspecialchars($filme['imagem_nome']); ?>" alt="Imagem">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/200x300?text=Sem+Imagem" alt="Imagem padrão">
                        <?php endif; ?>

                        <h3><?php echo htmlspecialchars($filme['titulo']); ?></h3>
                        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($filme['diretor']); ?></p>
                        <p><strong>Ano:</strong> <?php echo htmlspecialchars($filme['ano']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($filme['sinopse'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
