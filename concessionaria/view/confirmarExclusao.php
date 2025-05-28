<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../model/Veiculo.php';

$id = $_GET['id'] ?? null;

if (!isset($_SESSION['usuario']) || !$id) {
    echo "Acesso negado.";
    exit;
}

$veiculo = Veiculo::buscarPorId($id);

if (!$veiculo || $veiculo['usuario_id'] != $_SESSION['usuario']['id']) {
    echo "Acesso negado ao veículo.";
    exit;
}
?>

<h1>Confirmar Exclusão</h1>

<div class="filtro-container">
    <p>Você tem certeza que deseja excluir o veículo <strong><?= $veiculo['marca'] ?> <?= $veiculo['modelo'] ?></strong>?</p>
    <br>
    <form action="index.php?pagina=excluirVeiculo" method="post">
        <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">
        <input type="submit" value="Sim, excluir">
    </form>
    <br>
    <p><a href="index.php?pagina=meusVeiculos">Cancelar</a></p>
</div>
