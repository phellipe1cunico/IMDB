<?php
// login_admin.php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Verifica as credenciais fixas do admin
    if ($email === ADMIN_EMAIL && $senha === ADMIN_SENHA) {
        $_SESSION['user_id'] = ADMIN_ID; // Define o ID fixo do admin
        $_SESSION['user_email'] = ADMIN_EMAIL;
        $_SESSION['user_type'] = 'master'; // Define o tipo de usuário como master
        header('Location: adicionar_filme.php'); // Redireciona para a página de adicionar filme
        exit;
    } else {
        $message = '<div class="message error">Email ou senha do administrador incorretos.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="login_usuario.php">Login de Usuário</a>
    </nav>

    <div class="container">
        <h1>Login do Administrador</h1>
        <?php echo $message; ?>
        <form action="login_admin.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar como Admin</button>
        </form>
        <p style="text-align: center; margin-top: 20px;">Credenciais de Admin: Email: **<?php echo ADMIN_EMAIL; ?>**, Senha: **<?php echo ADMIN_SENHA; ?>**</p>
    </div>
</body>
</html>