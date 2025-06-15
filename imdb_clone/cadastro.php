<?php
// cadastro.php
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirm_senha = $_POST['confirm_senha'] ?? '';

    if (empty($email) || empty($senha) || empty($confirm_senha)) {
        $message = '<div class="message error">Todos os campos são obrigatórios.</div>';
    } elseif ($senha !== $confirm_senha) {
        $message = '<div class="message error">As senhas não coincidem.</div>';
    } else {
        $usuarios = getUsuarios();
        $emailExistente = false;
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                $emailExistente = true;
                break;
            }
        }

        // Também verificar se o email padrão do admin está sendo usado
        if ($email === ADMIN_EMAIL) {
            $emailExistente = true;
        }

        if ($emailExistente) {
            $message = '<div class="message error">Este email já está cadastrado ou reservado.</div>';
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Todo cadastro agora é para usuário comum
            $tipo_usuario = 'user'; 
            
            $new_id = uniqid('user_'); 

            $novo_usuario = [
                'id' => $new_id,
                'email' => $email,
                'senha_hash' => $senha_hash,
                'tipo' => $tipo_usuario
            ];

            $usuarios[$new_id] = $novo_usuario;
            saveUsuarios($usuarios);

            $message = '<div class="message success">Cadastro realizado com sucesso! Você pode fazer login agora como ' . $tipo_usuario . '.</div>';
            // header('Location: login_usuario.php'); // Opcional: redirecionar
            // exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="login_usuario.php">Login Usuário</a>
    </nav>

    <div class="container">
        <h1>Cadastro de Usuário</h1>
        <?php echo $message; ?>
        <form action="cadastro.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="confirm_senha">Confirmar Senha:</label>
            <input type="password" id="confirm_senha" name="confirm_senha" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>