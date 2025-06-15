<?php
require_once 'config.php';

$filmes = array_filter(getFilmes(), fn($item) => isset($item['tipo']) && $item['tipo'] === 'serie');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Séries</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Catálogo de Séries</h1>

        <?php if (empty($series)): ?>
            <p>Nenhuma série cadastrada.</p>
        <?php else: ?>
            <div class="movie-list">
                <?php foreach ($series as $serie): ?>
                    <div class="movie-card">
                        <?php if (!empty($serie['imagem_nome']) && file_exists(UPLOADS_DIR . $serie['imagem_nome'])): ?>
                            <img src="<?php echo 'uploads/' . htmlspecialchars($serie['imagem_nome']); ?>" alt="Imagem">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/200x300?text=Sem+Imagem" alt="Imagem padrão">
                        <?php endif; ?>

                        <h3><?php echo htmlspecialchars($serie['titulo']); ?></h3>
                        <p><strong>Criador:</strong> <?php echo htmlspecialchars($serie['diretor']); ?></p>
                        <p><strong>Ano:</strong> <?php echo htmlspecialchars($serie['ano']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($serie['sinopse'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
