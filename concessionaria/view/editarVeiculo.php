<?php
require_once __DIR__ . '/../model/Veiculo.php';
require_once __DIR__ . '/../controller/VeiculoController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/csrf.php';

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

$id = $_GET['id'] ?? null;
$usuarioId = $_SESSION['usuario']['id'];

// var_dump($id); // debug: ID recebido via GET
// var_dump($_POST); // debug: dados enviados via POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
        echo "Token CSRF inválido.";
        exit;
    }

    $dados = $_POST;
    $dados['id'] = $_POST['id'];

    if (VeiculoController::atualizar($dados, $usuarioId)) {
        header("Location: index.php?pagina=meusVeiculos");
        exit;
    } else {
        echo "Erro ao atualizar.";
    }
} else {
    $veiculo = Veiculo::buscarPorId($id);
    if (!$veiculo || $veiculo['usuario_id'] != $usuarioId) {
        echo "Veículo não encontrado ou acesso negado.";
        exit;
    }
}
?>

<div class="filtro-container">
    <form method="POST" action="index.php?pagina=editarVeiculo">
        <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

        <label>Marca:</label><input type="text" name="marca" value="<?= $veiculo['marca'] ?>"><br>
        <label>Modelo:</label><input type="text" name="modelo" value="<?= $veiculo['modelo'] ?>"><br>
        <label>Ano:</label><input type="number" name="ano" value="<?= $veiculo['ano'] ?>"><br>
        <label>Cor:</label><input type="text" name="cor" value="<?= $veiculo['cor'] ?>"><br>
        <label>Portas:</label><input type="number" name="portas" value="<?= $veiculo['portas'] ?>"><br>
        <label>Preço:</label><input type="text" name="preco" value="<?= $veiculo['preco'] ?>"><br>
        <label>Cidade:</label><input type="text" name="cidade" value="<?= $veiculo['cidade'] ?>"><br>

        <input type="submit" value="Salvar alterações">
    </form>
</div>