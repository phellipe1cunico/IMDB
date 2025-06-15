<?php
// login.php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $usuarios = getUsuarios();
    $loggedIn = false;

    foreach ($usuarios as $usuario) {
        if ($usuario['email'] === $email && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_email'] = $usuario['email'];
            $_SESSION['user_type'] = $usuario['tipo'];
            $loggedIn = true;
            header('Location: index.php'); // Redireciona para a página inicial após o login
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
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="cadastro.php">Cadastro</a>
    </nav>

    <div class="container">
        <h1>Login</h1>
        <?php echo $message; ?>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>