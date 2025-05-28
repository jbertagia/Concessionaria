<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . "/../model/Veiculo.php";
require_once __DIR__ . "/../model/Pagamento.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?pagina=login&redirect=meusVeiculos");
    exit;
}
?>

<h1>Meus Veículos Anunciados</h1>
<div class="cardV" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
<?php
$idUsuario = $_SESSION['usuario']['id'];
$meusAnuncios = Veiculo::listarMeus($idUsuario);
$minhasCompras = Pagamento::listarPorUsuario($idUsuario);

foreach ($meusAnuncios as $v): ?>
    <div class="cardInterno">
        <?php if ($v['imagem']): ?>
            <img src="public/imagens/<?= htmlspecialchars($v['imagem']) ?>" width="200" alt="Imagem do veículo"><br>
        <?php endif; ?>
        <?= $v['marca'] ?> <?= $v['modelo'] ?> (<?= $v['ano'] ?> - <?= $v['cor'] ?> - <?= $v['portas'] ?> portas)<br>
        Preço: R$ <?= number_format($v['preco'], 2, ',', '.') ?> | Cidade: <?= $v['cidade'] ?><br>
        <a href="index.php?pagina=editarVeiculo&id=<?= $v['id'] ?>">Editar</a> | 
        <a href="index.php?pagina=confirmarExclusao&id=<?= $v['id'] ?>">Excluir</a>
    </div>
    <hr>
<?php endforeach; ?>
</div>

<div class="cardV" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
<h1>Veículos Comprados</h1>
<?php foreach ($minhasCompras as $c): ?>
    <div class="cardInterno">
        <?php if (!empty($c['imagem'])): ?>
            <img src="public/imagens/<?= htmlspecialchars($c['imagem']) ?>" width="200" alt="Imagem do veículo"><br>
        <?php endif; ?>

        <?= $c['marca'] ?> <?= $c['modelo'] ?> <br>
        Cidade: <?= $c['cidade'] ?> <br>
        Valor: <strong>R$ <?= $c['forma_pagamento'] ?></strong><br>
        Entrega: <?= $c['endereco'] ?><br>
        CPF: <?= substr($c['cpf'], 0, 3) . '.***.***-**' ?><br>
    </div>
    <hr>
<?php endforeach; ?>
</div>

