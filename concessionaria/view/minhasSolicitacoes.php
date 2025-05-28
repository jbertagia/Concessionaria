<h1>Minhas Solicitações</h1>

<?php if (isset($_SESSION['mensagem'])): ?>
    <p class="mensagem-sucesso"><?= $_SESSION['mensagem'] ?></p>
    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>

<?php if (empty($lista)): ?>
    <p>Você ainda não possui nenhuma solicitação realizada.</p>
<?php else: ?>
    <?php foreach ($lista as $s): ?>
        <div class="filtro-container">
            <p><strong>Marca:</strong> <?= htmlspecialchars($s->marca) ?></p>
            <p><strong>Modelo:</strong> <?= htmlspecialchars($s->modelo) ?></p>
            <p><strong>Peça:</strong> <?= htmlspecialchars($s->nome_peca) ?></p>
            <p><strong>Tipo:</strong> <?= ucfirst($s->tipo_peca) ?></p>

            <a href="index.php?pagina=editarSolicitacao&id=<?= $s->id ?>" class="botao">Editar</a>

            <form action="index.php?pagina=excluirSolicitacao&id=<?= $s->id ?>" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="submit" value="Excluir">
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>