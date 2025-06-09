<?php
require_once __DIR__ . "/../config/banco.php";
require_once __DIR__ . "/../model/Peca.php";

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario']) || !isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    exit("CSRF inválido");
}

$usuario_id = $_SESSION['usuario']['id'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$nome_peca = $_POST['nome_peca'];
$tipo_peca = isset($_POST['tipo_peca']) && $_POST['tipo_peca'] === 'remanufaturada' ? 'remanufaturada' : 'nova';

$banco = Banco::conectar();
$verifica = $banco->prepare("SELECT COUNT(*) FROM solicitacoes WHERE usuario_id = ? AND marca = ? AND modelo = ? AND nome_peca = ? AND tipo_peca = ?");
$verifica->execute([$usuario_id, $marca, $modelo, $nome_peca, $tipo_peca]);

if ($verifica->fetchColumn() > 0) {
    $_SESSION['mensagem'] = "Você já fez essa solicitação anteriormente.";
    header("Location: /concessionaria/index.php?pagina=minhasSolicitacoes");
    exit;
}

Peca::cadastrar($usuario_id, $marca, $modelo, $nome_peca, $tipo_peca);

$_SESSION['mensagem'] = "Solicitação realizada com sucesso!";
header("Location: /concessionaria/index.php?pagina=minhasSolicitacoes");
exit;
