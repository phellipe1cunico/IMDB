<?php
require_once 'config.php';
?>
<nav>
    <a href="index.php">Início</a>
    <a href="catalago_filmes.php">Filmes</a>
    <a href="catalago_series.php">Séries</a>
    <?php if (estaLogado()): ?>
        <a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['user_email']); ?>)</a>
        <?php if (getUserType() === 'master'): ?>
            <a href="adicionar_filme.php">Adicionar</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="login_usuario.php">Login Usuário</a>
        <a href="login_admin.php">Login Admin</a>
        <a href="cadastro.php">Cadastro</a>
    <?php endif; ?>
</nav>
