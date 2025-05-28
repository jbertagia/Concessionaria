<?php
require_once __DIR__ . "/../model/Pagamento.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "Token CSRF inválido.";
    exit;
}

}

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

$dados = [
    'veiculo_id'     => $_POST['veiculo_id'] ?? null,
    'comprador_id'   => $_SESSION['usuario']['id'],
    'nome'           => $_POST['nome'] ?? '',
    'endereco'       => $_POST['endereco'] ?? '',
    'cpf'            => $_POST['cpf'] ?? '',
    'forma_pagamento'=> $_POST['forma_pagamento'] ?? ''
];
// var_dump($dados); // debug: ver o que tá sendo enviado pro banco

$dados['cpf'] = preg_replace('/\D/', '', $dados['cpf']);

if (!preg_match('/^\d{11}$/', $dados['cpf'])) {
    echo "CPF inválido. Digite exatamente 11 números.";
    exit;
}

$resultado = Pagamento::registrar($dados);

if ($resultado) {
    echo "Compra realizada com sucesso!<br>";
    echo "<a href='index.php?pagina=meusVeiculos'>Ver meus veículos</a>";
} else {
    echo "Erro ao registrar pagamento.";
}
?>