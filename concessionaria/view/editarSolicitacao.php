<?php
require_once __DIR__ . '/../config/banco.php';
require_once __DIR__ . '/../model/Solicitacao.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?pagina=login");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "Solicitação não encontrada.";
    header("Location: index.php?pagina=minhasSolicitacoes");
    exit;
}

$idSolicitacao = $_GET['id'];
$solicitacao = Solicitacao::buscarPorId($idSolicitacao);

if (!$solicitacao || $solicitacao->usuario_id != $_SESSION['usuario']['id']) {
    $_SESSION['mensagem'] = "Você não tem permissão para editar esta solicitação.";
    header("Location: index.php?pagina=minhasSolicitacoes");
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<h1>Editar Solicitação</h1>

<div class="filtro-container">
    <form action="index.php?pagina=editarSolicitacao" method="POST" class="cardSolicitacao">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="id" value="<?= $solicitacao->id ?>">

        <label>Marca:</label>
        <input type="text" name="marca" value="<?= htmlspecialchars($solicitacao->marca) ?>" required>

        <label>Modelo:</label>
        <input type="text" name="modelo" value="<?= htmlspecialchars($solicitacao->modelo) ?>" required>

        <label>Nome da Peça:</label>
        <input type="text" name="nome_peca" value="<?= htmlspecialchars($solicitacao->nome_peca) ?>" required>

        <label>Tipo:</label>
        <select name="tipo_peca" required>
            <option value="nova" <?= $solicitacao->tipo_peca === "nova" ? "selected" : "" ?>>Nova</option>
            <option value="remanufaturada" <?= $solicitacao->tipo_peca === "remanufaturada" ? "selected" : "" ?>>Remanufaturada</option>
        </select>

        <input type="submit" value="Salvar Alterações">
        <p><a href="index.php?pagina=minhasSolicitacoes" class="botao">Voltar</a></p>
    </form>
</div>

