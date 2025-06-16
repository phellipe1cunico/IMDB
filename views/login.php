<?php require_once 'header.php'; ?>

<h2>Login</h2>

<?php if (isset($error)): ?>
    <p class="text-danger"><?php echo $error; ?></p>
<?php endif; ?>

<form action="/vitor/IMDB/auth" method="post">
    <label>Usuário</label>
    <input type="text" name="usuario" required>

    <label>Senha</label>
    <input type="password" name="senha" required>
    
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>