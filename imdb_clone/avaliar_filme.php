<?php
// avaliar_filme.php
require_once 'config.php';

// Redireciona se não estiver logado ou se for master (master não avalia)
if (!estaLogado() || getUserType() !== 'user') {
    header('Location: login_usuario.php'); // Redireciona para o login de usuário
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filme_id = $_POST['filme_id'] ?? '';
    $nota = $_POST['nota'] ?? '';
    $user_id = getUserId();

    if (empty($filme_id) || !is_numeric($nota) || $nota < 0 || $nota > 10) {
        $message = '<div class="message error">Dados de avaliação inválidos. Por favor, selecione uma nota de 0 a 10.</div>';
    } else {
        $filmes = getFilmes();
        if (!isset($filmes[$filme_id])) {
            $message = '<div class="message error">Filme não encontrado para avaliação.</div>';
        } else {
            $avaliacoes = getAvaliacoes();
            $avaliacao_existente = false;

            if (!isset($avaliacoes[$filme_id])) {
                $avaliacoes[$filme_id] = [];
            }

            foreach ($avaliacoes[$filme_id] as $key => $avaliacao) {
                if ($avaliacao['id_usuario'] === $user_id) {
                    $avaliacoes[$filme_id][$key]['nota'] = (int)$nota;
                    $avaliacao_existente = true;
                    $message = '<div class="message success">Sua avaliação para "' . htmlspecialchars($filmes[$filme_id]['titulo']) . '" foi atualizada para ' . htmlspecialchars($nota) . '!</div>';
                    break;
                }
            }
            
            if (!$avaliacao_existente) {
                $new_avaliacao_id = uniqid('aval_');
                $avaliacoes[$filme_id][] = [
                    'id_avaliacao' => $new_avaliacao_id,
                    'id_filme' => $filme_id,
                    'id_usuario' => $user_id,
                    'nota' => (int)$nota
                ];
                $message = '<div class="message success">Sua avaliação de ' . htmlspecialchars($nota) . ' para "' . htmlspecialchars($filmes[$filme_id]['titulo']) . '" foi registrada com sucesso!</div>';
            }

            saveAvaliacoes($avaliacoes);
        }
    }
}

$_SESSION['temp_message'] = $message;
header('Location: index.php');
exit;
?>