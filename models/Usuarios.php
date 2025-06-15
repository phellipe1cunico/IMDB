<?php
require_once __DIR__ . '/../config/banco.php';

class Usuario {
    
    //Login
    public static function autenticar($usuario, $senha) {
        $banco = Banco::getConn();
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' LIMIT 1";
        $resp = $banco->query($sql);

        if($resp->num_rows <= 0){
            return false;
        }else{
            
            $obj_usuario_resposta = $resp->fetch_object();

            if(password_verify($senha, $obj_usuario_resposta->senha)){
                $_SESSION['user_id'] = $obj_usuario_resposta->id;
                $_SESSION['user'] = $obj_usuario_resposta->nome_usuario;
                return true;
            }else{
                return false;
            }

        }

    }

    public static function cadastrar($usuario, $email, $senha) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";
        $resp = $banco->query($sql);   
}
?>