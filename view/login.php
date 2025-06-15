<?php include 'header.php'; ?>

<h2>Login</h2>

<?php if (isset($error)): ?>
    <p class="text-danger">
        <?php echo $error; ?>
    </p>
<?php endif; ?>

<form action="" method="post">
    <label>Usuário</label>
    <input type="text" name="username" required>

    <label>Senha</label>
    <input type="password" name="password" required>
    
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<p>Usuario: admin - Senha: admin123</p>
<p>Usuario: usuario1 - Senha: usuario123</p>