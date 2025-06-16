<?php
session_start(); // Inicia a sessão para mensagens flash (opcional, mas útil)
// require_once '../config/db.php'; // Linha original com PDO
require_once __DIR__ . '/../config/banco.php'; // Assumindo que seu arquivo de conexão mysqli se chama banco.php e está em config

// Certifique-se de que seu arquivo banco.php define uma variável de conexão, por exemplo: $conn
// Exemplo: $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$username = '';
$email = '';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validações básicas
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de e-mail inválido.";
    } elseif (strlen($password) < 6) {
        $error = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        // Verificar se o username ou email já existem com mysqli
        $sql_check = "SELECT id FROM usuarios WHERE username = ? OR email = ? LIMIT 1";
        $stmt_check = $conn->prepare($sql_check);

        if ($stmt_check) {
            $stmt_check->bind_param("ss", $username, $email);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->fetch_assoc()) {
                $error = "Nome de usuário ou e-mail já cadastrado.";
            } else {
                // ATENÇÃO: Armazenando senha em texto plano (NÃO SEGURO, conforme solicitado para não se preocupar com segurança)
                // Em um cenário real, use password_hash()
                // $password_to_store = password_hash($password, PASSWORD_DEFAULT);
                $password_to_store = $password; // Armazenando a senha diretamente

                // Inserir usuário no banco de dados com mysqli
                $sql_insert = "INSERT INTO usuarios (username, email, password_hash) VALUES (?, ?, ?)"; // Mantive password_hash como nome da coluna
                $stmt_insert = $conn->prepare($sql_insert);

                if ($stmt_insert) {
                    $stmt_insert->bind_param("sss", $username, $email, $password_to_store);
                    if ($stmt_insert->execute()) {
                        $success = "Usuário cadastrado com sucesso! Você pode fazer login agora.";
                        // Limpar os campos após o sucesso
                        $username = '';
                        $email = '';
                        // Poderia redirecionar para a página de login aqui:
                        // header("Location: login.php");
                        // exit();
                    } else {
                        $error = "Erro ao cadastrar usuário: " . $stmt_insert->error;
                    }
                    $stmt_insert->close();
                } else {
                    $error = "Erro ao preparar a inserção: " . $conn->error;
                }
            }
            $stmt_check->close();
        } else {
            $error = "Erro ao preparar a verificação: " . $conn->error;
        }
    }
}

include 'header.php'; // Inclui o cabeçalho após o processamento
?>

<h2>Cadastrar</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<?php if (isset($success)): ?>
    <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Nome de Usuário:</label><br>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

    <label for="password">Senha:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>