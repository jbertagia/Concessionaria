<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?pagina=login");
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<div class="filtro-container">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="hidden" name="pagina" value="cadastrarPeca">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        Marca: <input type="text" name="marca" required><br>
        Modelo: <input type="text" name="modelo" required><br>
        Nome da Peça: <input type="text" name="nome_peca" required><br>
        <label><input type="checkbox" name="tipo_peca" value="remanufaturada"> Remanufaturada</label><br>
        <input type="submit" value="Solicitar Peça">
    </form>