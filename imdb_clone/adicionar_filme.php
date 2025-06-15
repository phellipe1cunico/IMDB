<?php
// adicionar_filme.php
require_once 'config.php';

// Redireciona se não estiver logado ou não for master
if (!estaLogado() || getUserType() !== 'master') {
    header('Location: login_admin.php'); // Redireciona para o login do admin
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $ano = $_POST['ano'] ?? '';
    $sinopse = $_POST['sinopse'] ?? '';
    $imagem_nome = '';

    if (empty($titulo) || empty($diretor) || empty($ano) || empty($sinopse)) {
        $message = '<div class="message error">Todos os campos são obrigatórios.</div>';
    } elseif (!is_numeric($ano) || strlen($ano) !== 4) {
        $message = '<div class="message error">O ano deve ser um número de 4 dígitos.</div>';
    } else {
        // Lidar com o upload da imagem (MESMA LÓGICA ANTERIOR)
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagem']['tmp_name'];
            $fileName = $_FILES['imagem']['name'];
            $fileSize = $_FILES['imagem']['size'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = UPLOADS_DIR . $newFileName;

            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                if ($fileSize < 5000000) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imagem_nome = $newFileName;
                    } else {
                        $message = '<div class="message error">Houve um erro ao mover o arquivo de imagem. Verifique as permissões da pasta "uploads".</div>';
                    }
                } else {
                    $message = '<div class="message error">O tamanho da imagem excede o limite (5MB).</div>';
                }
            } else {
                $message = '<div class="message error">Tipo de arquivo de imagem não permitido. Apenas JPG, GIF, PNG, JPEG.</div>';
            }
        } else if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE) {
            $upload_errors = [
                UPLOAD_ERR_INI_SIZE   => 'O arquivo enviado excede a diretiva upload_max_filesize em php.ini.',
                UPLOAD_ERR_FORM_SIZE  => 'O arquivo enviado excede a diretiva MAX_FILE_SIZE que foi especificada no formulário HTML.',
                UPLOAD_ERR_PARTIAL    => 'O upload do arquivo foi feito parcialmente.',
                UPLOAD_ERR_NO_TMP_DIR => 'Faltou uma pasta temporária.',
                UPLOAD_ERR_CANT_WRITE => 'Falha ao escrever o arquivo em disco.',
                UPLOAD_ERR_EXTENSION  => 'Uma extensão PHP interrompeu o upload do arquivo.'
            ];
            $message = '<div class="message error">Erro no upload da imagem: ' . ($upload_errors[$_FILES['imagem']['error']] ?? 'Erro desconhecido.') . '</div>';
        }

        if (empty($message)) {
            $filmes = getFilmes();
            $new_id = uniqid('filme_'); 

            $novo_filme = [
                'id' => $new_id,
                'titulo' => $titulo,
                'diretor' => $diretor,
                'ano' => $ano,
                'sinopse' => $sinopse,
                'imagem_nome' => $imagem_nome
            ];

            $filmes[$new_id] = $novo_filme;
            saveFilmes($filmes);

            $message = '<div class="message success">Filme "' . htmlspecialchars($titulo) . '" adicionado com sucesso!</div>';
            $_POST = array();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['user_email']); ?>)</a>
        <a href="adicionar_filme.php">Adicionar Filme</a>
    </nav>

    <div class="container">
        <h1>Adicionar Novo Filme</h1>
        <?php echo $message; ?>
        <form action="adicionar_filme.php" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>" required>

            <label for="diretor">Diretor:</label>
            <input type="text" id="diretor" name="diretor" value="<?php echo htmlspecialchars($_POST['diretor'] ?? ''); ?>" required>

            <label for="ano">Ano:</label>
            <input type="text" id="ano" name="ano" pattern="\d{4}" title="Por favor, insira um ano de 4 dígitos." value="<?php echo htmlspecialchars($_POST['ano'] ?? ''); ?>" required>

            <label for="sinopse">Sinopse:</label>
            <textarea id="sinopse" name="sinopse" rows="5" required><?php echo htmlspecialchars($_POST['sinopse'] ?? ''); ?></textarea>

            <label for="imagem">Imagem do Filme:</label>
            <input type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif">
            <small>Tipos permitidos: JPG, PNG, GIF. Tamanho máximo: 5MB.</small>

            <button type="submit">Adicionar Filme</button>
        </form>
    </div>
</body>
</html>