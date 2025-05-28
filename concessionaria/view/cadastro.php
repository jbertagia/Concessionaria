<?php
$erro = $_GET['erro'] ?? null;
?>

<h1>Cadastro de Usuário</h1>
<?php if ($erro === 'senhadiferente'): ?>
    <p style="color:red">As senhas não coincidem.</p>
<?php elseif ($erro === 'senhaminima'): ?>
    <p style="color:red">A senha deve ter pelo menos 6 caracteres.</p>
<?php elseif ($erro === 'cadastro'): ?>
    <p style="color:red">Erro ao cadastrar. Tente novamente.</p>
<?php endif; ?>

<div class="filtro-container">
    <?php if (!isset($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
<form method="POST" action="index.php?pagina=fazerCadastro">
        <label>Nome:</label><input type="text" name="nome" required><br>
        <label>Usuário:</label><input type="text" name="usuario" required><br>
        <label>Data de Nascimento:</label><input type="date" name="dtnasc" required><br>
        <label>Senha:</label><input type="password" name="senha" required><br>
        <label>Confirmar Senha:</label><input type="password" name="confirmar" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</div>