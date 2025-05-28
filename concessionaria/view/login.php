<?php
require_once __DIR__ . '/../config/csrf.php';
$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;
$redirect = $_GET['redirect'] ?? 'index.php';
?>

<h1>Login</h1>

<?php if ($erro === 'invalido'): ?>
    <p style="color:red">Usuário ou senha inválidos.</p>
<?php elseif ($erro === 'bloqueado'): ?>
    <p style="color:red">Usuário bloqueado. Contate o suporte.</p>
<?php endif; ?>

<?php if ($sucesso === 'cadastro'): ?>
    <p style="color:green">Cadastro realizado com sucesso! Faça login abaixo.</p>
<?php endif; ?>

<div class="filtro-container">
    <form method="POST" action="index.php?pagina=fazerLogin">
        <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF() ?>">
        <input type="hidden" name="redirect" value="<?= $redirect ?>">
        <label>Usuário:</label><input type="text" name="usuario" required><br>
        <label>Senha:</label><input type="password" name="senha" required><br>
        <input type="submit" value="Entrar">
    </form>
    <p><a href="index.php?pagina=recuperarSenha">Recuperação de Senha</a></p>
</div>
