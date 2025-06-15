<?php
// index.php
require_once 'config.php';

$filmes = getFilmes();

// Exibir mensagem temporária da sessão, se houver
$message = '';
if (isset($_SESSION['temp_message'])) {
    $message = $_SESSION['temp_message'];
    unset($_SESSION['temp_message']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site de Filmes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <?php if (estaLogado()): ?>
            <a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['user_email']); ?>)</a>
            <?php if (getUserType() === 'master'): ?>
                <a href="adicionar_filme.php">Adicionar Filme</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login_usuario.php">Login Usuário</a>
            <a href="login_admin.php">Login Admin</a>
            <a href="cadastro.php">Cadastro</a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <h1>Bem-vindo ao Meu Site de Filmes!</h1>
        <?php echo $message; ?>
        <p>Explore os filmes disponíveis ou adicione novos filmes se for um administrador.</p>

        <h2>Filmes em Cartaz</h2>
        <?php if (empty($filmes)): ?>
            <p>Nenhum filme adicionado ainda.</p>
        <?php else: ?>
            <div class="movie-list">
                <?php foreach ($filmes as $filme): ?>
                    <div class="movie-card">
                        <?php if (!empty($filme['imagem_nome']) && file_exists(UPLOADS_DIR . $filme['imagem_nome'])): ?>
                            <img src="<?php echo 'uploads/' . htmlspecialchars($filme['imagem_nome']); ?>" alt="Poster do Filme: <?php echo htmlspecialchars($filme['titulo']); ?>">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/200x300?text=Sem+Imagem" alt="Imagem Padrão">
                        <?php endif; ?>
                        
                        <h3><?php echo htmlspecialchars($filme['titulo']); ?></h3>
                        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($filme['diretor']); ?></p>
                        <p><strong>Ano:</strong> <?php echo htmlspecialchars($filme['ano']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($filme['sinopse'])); ?></p>

                        <?php 
                            $mediaAvaliacoes = getMediaAvaliacoes($filme['id']);
                        ?>
                        <div class="movie-rating">
                            Nota Média: **<?php echo $mediaAvaliacoes['media']; ?>/10** <small>(<?php echo $mediaAvaliacoes['total']; ?> avaliações)</small>
                        </div>

                        <?php if (estaLogado() && getUserType() === 'user'): ?>
                            <div class="rating-form">
                                <form action="avaliar_filme.php" method="POST">
                                    <input type="hidden" name="filme_id" value="<?php echo htmlspecialchars($filme['id']); ?>">
                                    <label for="nota_<?php echo $filme['id']; ?>">Sua Avaliação:</label>
                                    <select name="nota" id="nota_<?php echo $filme['id']; ?>" required>
                                        <option value="">Selecione</option>
                                        <?php for ($i = 0; $i <= 10; $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <button type="submit">Avaliar</button>
                                </form>
                            </div>
                        <?php elseif (estaLogado() && getUserType() === 'master'): ?>
                            <p>Usuários Master não avaliam filmes.</p>
                        <?php else: ?>
                            <p>Faça <a href="login_usuario.php">login</a> para avaliar este filme.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>