<?php
require_once __DIR__ . '/../models/Usuarios.php';

class UsuarioController {

    
    public static function novo() {
        require __DIR__ . '/../views/cadastrar_usuario.php';
    }

    
    public static function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if (empty($usuario) || empty($email) || empty($senha)) {
                die("Erro: Todos os campos são obrigatórios.");
            }
            if (strlen($senha) < 6) {
                die("Erro: A senha deve ter pelo menos 6 caracteres.");
            }
            if (Usuario::verificarExistente($usuario, $email)) {
                die("Erro: Nome de usuário ou e-mail já cadastrado.");
            }

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            if (Usuario::cadastrar($usuario, $email, $senha_hash)) {
                echo "<script>
                        alert('Usuário cadastrado com sucesso!');
                        window.location.href = '/vitor/IMDB/inicio';
                      </script>";
            } else {
                die("Ocorreu um erro inesperado ao cadastrar o usuário.");
            }
        } else {
            header('Location: /vitor/IMDB/cadastro');
        }
        exit();
    }

    public static function login() {
        require __DIR__ . '/../views/login.php';
    }

    public static function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if (Usuario::autenticar($usuario, $senha)) {
                header('Location: /vitor/IMDB/inicio');
            } else {
                die('Usuário ou senha inválidos. <a href="/vitor/IMDB/login">Tente novamente</a>');
            }
        } else {
            header('Location: /vitor/IMDB/login');
        }
        exit();
    }

    public static function logout() {
        Usuario::logout();
        header('Location: /vitor/IMDB/inicio');
        exit();
    }
}