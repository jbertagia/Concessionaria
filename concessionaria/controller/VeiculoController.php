<?php
require_once "model/Veiculo.php";

class VeiculoController {
    public static function excluir($id, $usuarioId) {
        $veiculo = Veiculo::buscarPorId($id);

        if ($veiculo && $veiculo['usuario_id'] == $usuarioId) {
            return Veiculo::excluir($id);
        }
        return false;
    }

    public static function atualizar($dados, $usuarioId) {
        $veiculo = Veiculo::buscarPorId($dados['id']);

        if ($veiculo && $veiculo['usuario_id'] == $usuarioId) {
            return Veiculo::atualizar($dados);
        }
        return false;
    }
}
