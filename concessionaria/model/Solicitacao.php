<?php

class Solicitacao {
    public static function buscarTodasPorUsuario($usuarioId) {
        $banco = Banco::conectar();
        $stmt = $banco->prepare("SELECT * FROM solicitacoes WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function buscarPorId($id) {
        $banco = Banco::conectar();
        $stmt = $banco->prepare("SELECT * FROM solicitacoes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject();
    }

    public static function cadastrar($usuario_id, $marca, $modelo, $nome_peca, $tipo_peca) {
        $banco = Banco::conectar();
        $stmt = $banco->prepare("INSERT INTO solicitacoes (usuario_id, marca, modelo, nome_peca, tipo_peca) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$usuario_id, $marca, $modelo, $nome_peca, $tipo_peca]);
    }

    public static function atualizar($id, $marca, $modelo, $nome_peca, $tipo_peca) {
        $banco = Banco::conectar();
        $stmt = $banco->prepare("UPDATE solicitacoes SET marca=?, modelo=?, nome_peca=?, tipo_peca=? WHERE id=?");
        return $stmt->execute([$marca, $modelo, $nome_peca, $tipo_peca, $id]);
    }

    public static function excluir($id) {
        $banco = Banco::conectar();
        $stmt = $banco->prepare("DELETE FROM solicitacoes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
