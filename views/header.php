<?php require_once __DIR__ . '/../models/Usuario.php'; ?>

<nav>
    <a href="index.php">Início</a>
    <a href="catalogo_filmes.php">Filmes</a>
    <a href="catalogo_series.php">Séries</a>

    <?php if (Usuario::estaLogado()): ?>
        <a href="logout.php">Sair (<?php echo htmlspecialchars(Usuario::usuarioLogado()); ?>)</a>
    <?php else: ?>
        <a href="login_usuario.php">Login</a>
        <a href="cadastro.php">Cadastro</a>
    <?php endif; ?>
</nav>
