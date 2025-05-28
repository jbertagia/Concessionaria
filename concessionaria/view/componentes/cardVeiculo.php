<div class="cardV" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <?php if (!empty($veiculo['imagem'])): ?>
        <img src="public/imagens/<?= $veiculo['imagem'] ?>" width="200"><br>
    <?php endif; ?>

    <strong><?= $veiculo['marca'] ?> <?= $veiculo['modelo'] ?></strong><br>
    Ano: <?= $veiculo['ano'] ?> - <?= $veiculo['portas'] ?> portas - <?= $veiculo['cor'] ?><br>
    Cidade: <?= $veiculo['cidade'] ?><br>
    <strong>R$ <?= number_format($veiculo['preco'], 2, ',', '.') ?></strong><br>

    <?php if (isset($_SESSION['usuario'])): ?>
        <div class="cardInterno">
            <form method="post" action="index.php?pagina=pagamento">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <input type="hidden" name="veiculo_id" value="<?= $veiculo['id'] ?>">
                <input class="comprar" type="submit" value="Comprar">
            </form>
        </div>
    <?php else: ?>
        <p><a href="index.php?pagina=login&redirect=<?= $_SERVER['REQUEST_URI'] ?>">Faça login para comprar</a></p>
    <?php endif; ?>
</div>