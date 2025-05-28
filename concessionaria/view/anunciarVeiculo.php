<?php
require_once __DIR__ . "/../model/Veiculo.php";

if (!isset($_SESSION['usuario'])) {
    $redirect = urlencode($_SERVER['REQUEST_URI']);
    header("Location: index.php?pagina=login&redirect=$redirect");
    exit;
}
?>

<h1>Anunciar Veículo</h1>
<div class="filtro-container">
    <?php if (!isset($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
<form method="POST" action="index.php?pagina=cadastrarVeiculo" enctype="multipart/form-data">
        <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario']['id'] ?>">
        <label>Tipo:</label>
        <select name="tipo">
            <option value="Novo">Novo</option>
            <option value="Usado">Usado</option>
        </select><br>
        <label>Marca:</label><input type="text" name="marca" required><br>
        <label>Modelo:</label><input type="text" name="modelo" required><br>
        <label>Ano:</label><input type="number" name="ano" required><br>
        <label>Cor:</label><input type="text" name="cor" required><br>
        <label>Portas:</label>
        <select name="portas">
            <option value="2">2</option>
            <option value="4">4</option>
        </select><br>
        <label>Preço:</label><input type="text" name="preco" step="0.01" required><br> 
        <label>Cidade:</label><input type="text" name="cidade" required><br>
        <label>Imagem:</label><input type="file" name="imagem" accept="image/*"><br>
        <input type="submit" value="Cadastrar">
    </form>
</div>