<?php
require_once __DIR__ . "/../model/Veiculo.php";

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

$id = $_POST['id'] ?? null;
// var_dump($id); // debug: ID recebido para exclusão

$veiculo = Veiculo::buscarPorId($id);
// var_dump($veiculo); // debug: dados do veículo a excluir

if (!$veiculo || $veiculo['usuario_id'] != $_SESSION['usuario']['id']) {
    echo "Acesso negado ao veículo.<br>";
    echo "<a href='index.php?pagina=meusVeiculos'>Voltar para Meus Veículos</a>";
    exit;
}

$resultado = Veiculo::excluir($id);
// var_dump($resultado); // debug: resultado da exclusão

if ($resultado) {
    echo "Veículo cadastrado com sucesso!<br>";
    echo "<a href='index.php?pagina=meusVeiculos'>Ver meus veículos</a>";
} else {
    echo "Erro ao excluir o veículo.<br>";
    echo "<a href='index.php?pagina=meusVeiculos'>Ver meus veículos</a>";
}
?>
