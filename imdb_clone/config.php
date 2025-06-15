<?php
// config.php

session_start(); // Inicia a sessão para gerenciar o login/logout

// Credenciais fixas do administrador
define('ADMIN_EMAIL', '1234@gmail.com');
define('ADMIN_SENHA', '1234'); // Não vamos hashear, pois é fixo e para demonstração. Em produção, isso seria diferente.
define('ADMIN_ID', 'admin_master_fixed'); // ID fixo para o admin

// Caminhos dos arquivos de "banco de dados"
define('USUARIOS_FILE', __DIR__ . '/data/usuarios.txt'); // Para usuários comuns
define('FILMES_FILE', __DIR__ . '/data/filmes.txt');
define('AVALIACOES_FILE', __DIR__ . '/data/avaliacoes.txt');
define('UPLOADS_DIR', __DIR__ . '/uploads/');

// Função para verificar se um usuário está logado
function estaLogado() {
    return isset($_SESSION['user_id']);
}

// Função para verificar o tipo de usuário logado
function getUserType() {
    if (estaLogado()) {
        if ($_SESSION['user_id'] === ADMIN_ID) {
            return 'master';
        }
        return $_SESSION['user_type']; // Para usuários normais cadastrados
    }
    return null;
}

// Função para obter o ID do usuário logado
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Função para ler usuários do arquivo (apenas usuários comuns)
function getUsuarios() {
    if (!file_exists(USUARIOS_FILE)) {
        return [];
    }
    $content = file_get_contents(USUARIOS_FILE);
    $lines = explode("\n", trim($content));
    $usuarios = [];
    foreach ($lines as $line) {
        if (!empty($line)) {
            @list($id, $email, $senha_hash, $tipo) = explode(';', $line);
            $usuarios[$id] = [
                'id' => $id,
                'email' => $email,
                'senha_hash' => $senha_hash,
                'tipo' => $tipo
            ];
        }
    }
    return $usuarios;
}

// Função para salvar usuários no arquivo
function saveUsuarios($usuarios) {
    $content = '';
    foreach ($usuarios as $usuario) {
        $content .= implode(';', $usuario) . "\n";
    }
    file_put_contents(USUARIOS_FILE, $content);
}

// Funções para Filmes e Avaliações (mantidas as mesmas)
function getFilmes() {
    if (!file_exists(FILMES_FILE)) {
        return [];
    }
    $content = file_get_contents(FILMES_FILE);
    $lines = explode("\n", trim($content));
    $filmes = [];
    foreach ($lines as $line) {
        if (!empty($line)) {
            @list($id, $titulo, $diretor, $ano, $sinopse, $imagem_nome) = explode(';', $line);
            $filmes[$id] = [
                'id' => $id,
                'titulo' => $titulo,
                'diretor' => $diretor,
                'ano' => $ano,
                'sinopse' => $sinopse,
                'imagem_nome' => $imagem_nome
            ];
        }
    }
    return $filmes;
}

function saveFilmes($filmes) {
    $content = '';
    foreach ($filmes as $filme) {
        $content .= implode(';', $filme) . "\n";
    }
    file_put_contents(FILMES_FILE, $content);
}

function getAvaliacoes() {
    if (!file_exists(AVALIACOES_FILE)) {
        return [];
    }
    $content = file_get_contents(AVALIACOES_FILE);
    $lines = explode("\n", trim($content));
    $avaliacoes = [];
    foreach ($lines as $line) {
        if (!empty($line)) {
            @list($id_avaliacao, $id_filme, $id_usuario, $nota) = explode(';', $line);
            if (!isset($avaliacoes[$id_filme])) {
                $avaliacoes[$id_filme] = [];
            }
            $avaliacoes[$id_filme][] = [
                'id_avaliacao' => $id_avaliacao,
                'id_filme' => $id_filme,
                'id_usuario' => $id_usuario,
                'nota' => (int)$nota
            ];
        }
    }
    return $avaliacoes;
}

function saveAvaliacoes($avaliacoes) {
    $content = '';
    foreach ($avaliacoes as $filme_id => $avaliacoes_filme) {
        foreach ($avaliacoes_filme as $avaliacao) {
            $linha = [
                $avaliacao['id_avaliacao'],
                $avaliacao['id_filme'],
                $avaliacao['id_usuario'],
                $avaliacao['nota']
            ];
            $content .= implode(';', $linha) . "\n";
        }
    }
    file_put_contents(AVALIACOES_FILE, $content);
}

function getMediaAvaliacoes($filme_id) {
    $avaliacoes = getAvaliacoes();
    if (!isset($avaliacoes[$filme_id]) || empty($avaliacoes[$filme_id])) {
        return ['media' => 0, 'total' => 0];
    }

    $total_notas = 0;
    $num_avaliacoes = 0;
    foreach ($avaliacoes[$filme_id] as $avaliacao) {
        $total_notas += $avaliacao['nota'];
        $num_avaliacoes++;
    }

    $media = ($num_avaliacoes > 0) ? round($total_notas / $num_avaliacoes, 1) : 0;
    return ['media' => $media, 'total' => $num_avaliacoes];
}

// Criação de pastas (mantidas)
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}
if (!is_dir(UPLOADS_DIR)) {
    mkdir(UPLOADS_DIR, 0777, true);
}