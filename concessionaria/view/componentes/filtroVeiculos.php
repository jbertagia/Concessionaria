<?php
$paginaAtual = $_GET['pagina'] ?? 'home';
?>
<div class="filtro-container">
    <form method="GET" action="index.php">
        <input type="hidden" name="pagina" value="<?= $paginaAtual ?>">

        <label>Marca:</label>
        <input type="text" name="marca" value="<?= $_GET['marca'] ?? '' ?>">

        <label>Modelo:</label>
        <input type="text" name="modelo" value="<?= $_GET['modelo'] ?? '' ?>">

        <input type="submit" value="Filtrar">
    </form>
</div>