<?php
require_once __DIR__ . "/../config/banco.php";

class Pagamento
{
    public static function registrar($dados)
    {
        $pdo = Banco::conectar();
        $sql = "INSERT INTO pagamentos (veiculo_id, comprador_id, nome, endereco, cpf, forma_pagamento)
            VALUES (:veiculo_id, :comprador_id, :nome, :endereco, :cpf, :forma_pagamento)";
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            ":veiculo_id" => $dados['veiculo_id'],
            ":comprador_id" => $dados['comprador_id'],
            ":nome" => $dados['nome'],
            ":endereco" => $dados['endereco'],
            ":cpf" => $dados['cpf'],
            ":forma_pagamento" => $dados['forma_pagamento']
        ]);
        if ($resultado) {
            $sqlUpdate = "UPDATE veiculos SET vendido = 1 WHERE id = :id";
            $updateStmt = $pdo->prepare($sqlUpdate);
            $updateStmt->execute([":id" => $dados['veiculo_id']]);
        }

        return $resultado;
    }

    public static function listarPorUsuario($usuarioId)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT p.*, v.marca, v.modelo, v.cidade, v.imagem FROM pagamentos p
            JOIN veiculos v ON v.id = p.veiculo_id
            WHERE p.comprador_id = :comprador_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":comprador_id", $usuarioId);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultado); // debug: listagem de pagamentos do usuário
        return $resultado;
    }
}
