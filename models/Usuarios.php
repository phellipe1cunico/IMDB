<?php
require_once __DIR__ . '/../config/banco.php';

class Usuario {

    public static function autenticar($usuario, $senha) {
        $banco = Banco::getConn();
        $usuario_escaped = $banco->real_escape_string($usuario);
        
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario_escaped' LIMIT 1";
        $resp = $banco->query($sql);

        if ($resp && $resp->num_rows > 0) {
            $usuario_obj = $resp->fetch_object();
            if (password_verify($senha, $usuario_obj->senha)) {
                $_SESSION['user_id'] = $usuario_obj->id;
                $_SESSION['user_nome'] = $usuario_obj->usuario;
                return true;
            }
        }
        return false;
    }

    public static function cadastrar($usuario, $email, $senha_hash) {
        $banco = Banco::getConn();
        $usuario_escaped = $banco->real_escape_string($usuario);
        $email_escaped = $banco->real_escape_string($email);
        
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario_escaped', '$email_escaped', '$senha_hash')";
        return $banco->query($sql);
    }

    public static function verificarExistente($usuario, $email) {
        $banco = Banco::getConn();
        $usuario_escaped = $banco->real_escape_string($usuario);
        $email_escaped = $banco->real_escape_string($email);

        $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario_escaped' OR email = '$email_escaped' LIMIT 1";
        $result = $banco->query($sql);
        
        return $result && $result->num_rows > 0;
    }

    /**
     * ESTA É A FUNÇÃO QUE ESTÁ FALTANDO NO SEU ARQUIVO
     * Verifica se o usuário está logado checando a variável de sessão.
     */
    public static function estaLogado() {
        return isset($_SESSION['user_id']);
    }

    public static function usuarioLogado() {
        return $_SESSION['user_nome'] ?? '';
    }

    public static function logout() {
        session_destroy();
    }
}
?>