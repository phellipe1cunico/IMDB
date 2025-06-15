<?php
require_once 'config.php';

if (!estaLogado() || getUserType() !== 'master') {
    header('Location: login_admin.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $ano = $_POST['ano'] ?? '';
    $sinopse = $_POST['sinopse'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $imagem_nome = '';

    if (empty($titulo) || empty($diretor) || empty($ano) || empty($sinopse) || empty($tipo)) {
        $message = '<div class="message error">Todos os campos são obrigatórios.</div>';
    } elseif (!is_numeric($ano) || strlen($ano) !== 4) {
        $message = '<div class="message error">O ano deve ser um número de 4 dígitos.</div>';
    } else {
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagem']['tmp_name'];
            $fileName = $_FILES['imagem']['name'];
            $fileSize = $_FILES['imagem']['size'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = UPLOADS_DIR . $newFileName;

            $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
            if (in_array($fileExtension, $allowedfileExtensions)) {
                if ($fileSize < 5000000) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imagem_nome = $newFileName;
                    } else {
                        $message = '<div class="message error">Erro ao mover a imagem.</div>';
                    }
                } else {
                    $message = '<div class="message error">Imagem muito grande (limite 5MB).</div>';
                }
            } else {
                $message = '<div class="message error">Tipo de arquivo não permitido.</div>';
            }
        }

        if (empty($message)) {
            $filmes = getFilmes();
            $new_id = uniqid('item_');

            $novo_item = [
                'id' => $new_id,
                'titulo' => $titulo,
                'diretor' => $diretor,
                'ano' => $ano,
                'sinopse' => $sinopse,
                'imagem_nome' => $imagem_nome,
                'tipo' => $tipo
            ];

            $filmes[$new_id] = $novo_item;
            saveFilmes($filmes);

            $message = '<div class="message success">Adicionado com sucesso!</div>';
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
    <title>Adicionar Filme ou Série</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Início</a>
        <a href="catalogo_filmes.php">Filmes</a>
        <a href="catalogo_series.php">Séries</a>
        <a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['user_email']); ?>)</a>
    </nav>

    <div class="container">
        <h1>Adicionar Filme ou Série</h1>
        <?php echo $message; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="diretor">Diretor ou Criador:</label>
            <input type="text" name="diretor" id="diretor" required>

            <label for="ano">Ano:</label>
            <input type="text" name="ano" id="ano" pattern="\d{4}" required>

            <label for="sinopse">Sinopse:</label>
            <textarea name="sinopse" id="sinopse" rows="5" required></textarea>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="">Selecione</option>
                <option value="filme">Filme</option>
                <option value="serie">Série</option>
            </select>

            <label for="imagem">Imagem (opcional):</label>
            <input type="file" name="imagem" id="imagem" accept="image/*">

            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>
