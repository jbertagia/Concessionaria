<?php
require_once "model/Pagamento.php";

class PagamentoController {
    public static function registrarCompra($dados) {
        // var_dump($dados); // debug: dados da compra recebidos
        return Pagamento::registrar($dados);
    }

    public static function listarComprasPorUsuario($usuarioId) {
        // var_dump($usuarioId); // debug: ID do usuário para listagem de compras
        return Pagamento::listarPorUsuario($usuarioId);
    }
}