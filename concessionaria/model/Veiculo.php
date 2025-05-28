<?php
require_once __DIR__ . "/../config/banco.php";

class Veiculo
{
    public static function listar($tipo = null, $marca = null, $modelo = null)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM veiculos WHERE tipo = :tipo AND vendido = 0";
        $params = [];

        if ($tipo) {
            $sql .= " AND tipo = :tipo";
            $params[":tipo"] = $tipo;
        }
        if ($marca) {
            $sql .= " AND marca = :marca";
            $params[":marca"] = $marca;
        }
        if ($modelo) {
            $sql .= " AND modelo = :modelo";
            $params[":modelo"] = $modelo;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultado); // debug: resultado da listagem de veículos
        return $resultado;
    }

    public static function cadastrar($dados)
    {
        $pdo = Banco::conectar();
        $sql = "INSERT INTO veiculos (usuario_id, tipo, marca, modelo, ano, cor, portas, preco, cidade, imagem)
                VALUES (:usuario_id, :tipo, :marca, :modelo, :ano, :cor, :portas, :preco, :cidade, :imagem)";

        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            ":usuario_id" => $dados['usuario_id'],
            ":tipo" => $dados['tipo'],
            ":marca" => $dados['marca'],
            ":modelo" => $dados['modelo'],
            ":ano" => $dados['ano'],
            ":cor" => $dados['cor'],
            ":portas" => $dados['portas'],
            ":preco" => $dados['preco'],
            ":cidade" => $dados['cidade'],
            ":imagem" => $dados['imagem']
        ]);
        // var_dump($resultado); // debug: resultado do cadastro do veículo
        return $resultado;
    }

    public static function listarMeus($usuarioId)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM veiculos WHERE usuario_id = :usuario_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":usuario_id", $usuarioId);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultado); // debug: veículos do usuário
        return $resultado;
    }

    public static function buscarPorId($id)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM veiculos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($resultado); // debug: resultado da busca por ID
        return $resultado;
    }

    public static function excluir($id)
    {
        $pdo = Banco::conectar();
        $sql = "DELETE FROM veiculos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $resultado = $stmt->execute();
        // var_dump($resultado); // debug: resultado da exclusão do veículo
        return $resultado;
    }

    public static function atualizar($dados)
    {
        $pdo = Banco::conectar();
        $sql = "UPDATE veiculos SET marca = :marca, modelo = :modelo, ano = :ano, cor = :cor, portas = :portas, preco = :preco, cidade = :cidade
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            ":marca" => $dados['marca'],
            ":modelo" => $dados['modelo'],
            ":ano" => $dados['ano'],
            ":cor" => $dados['cor'],
            ":portas" => $dados['portas'],
            ":preco" => $dados['preco'],
            ":cidade" => $dados['cidade'],
            ":id" => $dados['id']
        ]);
        // var_dump($resultado); // debug: resultado da atualização
        return $resultado;
    }
}
