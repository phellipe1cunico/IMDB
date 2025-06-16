<?php require_once __DIR__ . '/../models/Usuarios.php'; ?>

<nav>
    <a href="/vitor/IMDB/inicio">Início</a>

    <a href="/vitor/IMDB/filmes">Filmes</a>

    <a href="/vitor/IMDB/series">Séries</a>

    <?php if (Usuario::estaLogado()): ?>
        <a href="/vitor/IMDB/logout">Sair (<?php echo htmlspecialchars(Usuario::usuarioLogado()); ?>)</a>
    <?php else: ?>
        <a href="/vitor/IMDB/login">Login</a>
        <a href="/vitor/IMDB/cadastro">Cadastro</a>
    <?php endif; ?>
</nav>