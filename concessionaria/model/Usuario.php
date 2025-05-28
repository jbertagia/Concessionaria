<?php
require_once __DIR__ . "/../config/banco.php";

class Usuario
{

    public static function autenticar($usuario, $senha)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($dados); // debug: dados do usuário retornado do banco

        if ($dados && password_verify($senha, $dados['senha'])) {
            if ($dados['bloqueado']) {
                return "bloqueado";
            }
            return $dados;
        }
        return false;
    }

    public static function cadastrar($nome, $usuario, $senha, $dtnasc)
    {
        $pdo = Banco::conectar();
        $sql = "INSERT INTO usuarios (nome, login, senha, dtnasc, bloqueado) VALUES (:nome, :usuario, :senha, :dtnasc, 0)";
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            ":nome" => $nome,
            ":usuario" => $usuario,
            ":senha" => password_hash($senha, PASSWORD_DEFAULT),
            ":dtnasc" => $dtnasc
        ]);
        // var_dump($resultado); // debug: resultado da execução do cadastro
        return $resultado;
    }

    public static function buscar($usuario)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM usuarios WHERE login = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function listarTodos()
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($usuarios); // debug: retorno do banco de todos os usuários
        return $usuarios;
    }

    public static function bloquear($id)
    {
        $pdo = Banco::conectar();
        $sql = "UPDATE usuarios SET bloqueado = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $resultado = $stmt->execute();
        // var_dump($resultado); // debug: resultado do bloqueio
        return $resultado;
    }

    public static function desbloquear($id)
    {
        $pdo = Banco::conectar();
        $sql = "UPDATE usuarios SET bloqueado = 0 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $resultado = $stmt->execute();
        // var_dump($resultado); // debug: resultado do desbloqueio
        return $resultado;
    }

    public static function atualizarSenha($id, $novaHash)
    {
        $pdo = Banco::conectar();
        $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ":senha" => $novaHash,
            ":id" => $id
        ]);
    }
}
