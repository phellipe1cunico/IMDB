<?php
// login_usuario.php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $usuarios = getUsuarios(); // Pega apenas usuários comuns
    $loggedIn = false;

    foreach ($usuarios as $usuario) {
        if ($usuario['email'] === $email && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_email'] = $usuario['email'];
            $_SESSION['user_type'] = $usuario['tipo']; // Deve ser 'user'
            $loggedIn = true;
            header('Location: index.php'); // Redireciona para a página inicial
            exit;
        }
    }

    if (!$loggedIn) {
        $message = '<div class="message error">Email ou senha incorretos.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="login_admin.php">Login de Admin</a>
        <a href="cadastro.php">Cadastro</a>
    </nav>

    <div class="container">
        <h1>Login de Usuário</h1>
        <?php echo $message; ?>
        <form action="login_usuario.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 20px;">Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
    </div>
</body>
</html>