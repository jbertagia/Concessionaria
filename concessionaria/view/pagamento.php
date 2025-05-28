<?php
require_once __DIR__ . "/../model/Pagamento.php";
require_once __DIR__ . "/../model/Veiculo.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

$veiculoId = $_POST['veiculo_id'] ?? null;
if (!$veiculoId) {
    echo "Veículo inválido.";
    include "footer.php";
    exit;
}
?>

<h1>Pagamento</h1>
<div class="filtro-container">
    <?php if (!isset($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
<form method="post" action="index.php?pagina=realizarCompra">
        <input type="hidden" name="veiculo_id" value="<?= $veiculoId ?>">
        <input type="hidden" name="comprador_id" value="<?= $_SESSION['usuario']['id'] ?>">

        <label>Nome Completo:</label><input type="text" name="nome" required><br>
        <label>Endereço de Entrega:</label><input type="text" name="endereco" required><br>
        <label>CPF:</label><input type="text" name="cpf" maxlength="11" pattern="\d{11}" title="Apneas números sem pontuação" required><br>

        <label>Forma de Pagamento:</label>
        <select name="forma_pagamento">
            <optgroup label="À Vista">
                <option value="Dinheiro">Dinheiro</option>
                <option value="Débito">Débito</option>
                <option value="Crédito à Vista">Crédito à Vista</option>
            </optgroup>
            <optgroup label="Parcelado">
                <option value="Boleto">Boleto</option>
                <option value="Cartão de Crédito Parcelado">Cartão de Crédito Parcelado</option>
            </optgroup>
        </select><br>

        <input type="submit" value="Confirmar Compra">
    </form>
</div>