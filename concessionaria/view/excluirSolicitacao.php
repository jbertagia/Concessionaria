<?php
require_once __DIR__ . '/../config/banco.php';
require_once __DIR__ . '/../model/Solicitacao.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario']) || !isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    exit("Acesso negado ou CSRF inválido.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['mensagem'] = "Solicitação inválida.";
    header("Location: ../index.php?pagina=minhasSolicitacoes");
    exit;
}

$idSolicitacao = (int) $_GET['id'];
$solicitacao = Solicitacao::buscarPorId($idSolicitacao);

if (!$solicitacao || $solicitacao->usuario_id != $_SESSION['usuario']['id']) {
    $_SESSION['mensagem'] = "Você não tem permissão para excluir esta solicitação.";
    header("Location: ../index.php?pagina=minhasSolicitacoes");
    exit;
}

if (Solicitacao::excluir($idSolicitacao)) {
    $_SESSION['mensagem'] = "Solicitação excluída com sucesso!";
} else {
    $_SESSION['mensagem'] = "Erro ao excluir a solicitação.";
}

header("Location: ../index.php?pagina=minhasSolicitacoes");
exit;
