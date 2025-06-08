<?php
require_once "model/Usuario.php";

class UsuarioController {
    public static function login($usuario, $senha) {
        // var_dump($usuario, $senha); // debug: dados recebidos para login
        return Usuario::autenticar($usuario, $senha);
    }

    public static function cadastrar($nome, $usuario, $senha, $dtnasc) {
        // var_dump($nome, $usuario); // debug: dados recebidos para cadastro
        return Usuario::cadastrar($nome, $usuario, $senha, $dtnasc);
    }

    public static function logout() {
        session_start();
        session_destroy();
        header("Location: ../index.php");
        exit;
    }

    public static function listarTodos() {
        $usuarios = Usuario::listarTodos();
        // var_dump($usuarios); // debug: listagem de usuários
        return $usuarios;
    }

    public static function bloquear($id) {
        // var_dump($id); // debug: id do usuário a ser bloqueado
        return Usuario::bloquear($id);
    }

    public static function desbloquear($id) {
        // var_dump($id); // debug: id do usuário a ser desbloqueado
        return Usuario::desbloquear($id);
    }
}
