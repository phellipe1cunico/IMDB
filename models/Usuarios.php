<?php
require_once __DIR__ . '/../config/banco.php';

class Usuario {
    
    // Login
    public static function autenticar($usuario, $senha) {
        session_start();
        $banco = Banco::getConn();
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' LIMIT 1";
        $resp = $banco->query($sql);

        if ($resp->num_rows <= 0) {
            return false;
        } else {
            $obj_usuario_resposta = $resp->fetch_object();

            if (password_verify($senha, $obj_usuario_resposta->senha)) {
                $_SESSION['user_id'] = $obj_usuario_resposta->id;
                $_SESSION['user'] = $obj_usuario_resposta->usuario;
                $_SESSION['email'] = $obj_usuario_resposta->email;
                return true;
            } else {
                return false;
            }
        }
    }

    // Cadastro
    public static function cadastrar($usuario, $email, $senha) {
        $banco = Banco::getConn();

        // Criptografar senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Verificar se usuário ou email já existem
        $verificar = $banco->query("SELECT * FROM usuarios WHERE usuario='$usuario' OR email='$email'");
        if ($verificar->num_rows > 0) {
            return false; // Já existe
        }

        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senhaHash')";
        return $banco->query($sql);
    }

    // Verificar se está logado
    public static function estaLogado() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    // Logout
    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    // Retorna dados do usuário logado
    public static function usuarioLogado() {
        session_start();
        if (self::estaLogado()) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }
}
?>
